<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('auth');
		$this->load->model(array('trmodel'));
		$this->auth->restrict();
	}	
	function index($transaksi='1')
	{
		$uri = $this->uri->segment(3);
		$data['transaksi'] = $this->trmodel->get_jenis_transaksi_manual();
		if($uri=='')
		{
			if($transaksi != '1')
			{
				$prop = explode('_',$transaksi);
				$transaksi = $prop[0];
				$bulan = $prop[1];
				$tahun = $prop[2];
			}
			else
			{
				$bulan = date('m');
				$tahun = date('Y');
			}			
		}
		else
		{
			$prop = explode('_',$uri);
			$transaksi = $prop[0];
			$bulan = $prop[1];
			$tahun = $prop[2];
		}
		$page = $this->uri->segment(4,0);
		$data['list_transaksi'] = $this->trmodel->get_transaksi($transaksi,$bulan,$tahun,$page);
		$num = $this->trmodel->get_transaksi($transaksi,$bulan,$tahun,'',true);
		if($page==0)
		{
			$data['no_prev'] = true;
		}
		if($page==$num-1 || $num==0)
		{
			$data['no_next'] = true;
		}
		$data['next'] = "<a class='link1 blue98' href='javascript:void(0)' onclick='load_no_loading(\"transaksi/index/".$transaksi."_".$bulan."_".$tahun."/".($page+1)."\",\"#content\")' >Selanjutnya</a>";
		$data['prev'] = "<a class='link1 blue98' href='javascript:void(0)' onclick='load_no_loading(\"transaksi/index/".$transaksi."_".$bulan."_".$tahun."/".($page-1)."\",\"#content\")' >Sebelumnya</a>";	
		$data['cur_transaksi'] = $transaksi;
		$data['cur_bulan'] = $bulan;
		$data['cur_tahun'] = $tahun;
		$this->load->view('transaksi/form_transaksi',$data);	
	}
	function simpan()
	{
		$field = array_keys($_POST);
		$data = $this->fungsi->accept_data($field);
		$pref = $this->trmodel->get_preferences($data['transaksi']);
		$nominal = $data['nominal'];
		$nominal = str_replace(',','',$nominal);
		$nomor = $data['nomor'];
		$data = $this->fungsi->array_delete($data,array('nominal'));
		if(count($pref['debet'])>0)
		{
			foreach($pref['debet'] as $val)
			{
				$data['buku'] = $val;
				$data['debet'] = $nominal;
				$data = $this->fungsi->array_delete($data,'kredit');
				$nomor = $this->trmodel->simpan_transaksi($data,$nomor);
			}
		}
		if(count($pref['kredit'])>0)
		{
			foreach($pref['kredit'] as $val)
			{
				$data['buku'] = $val;
				$data = $this->fungsi->array_delete($data,'debet');
				$data['kredit'] = $nominal;
				$nomor = $this->trmodel->simpan_transaksi($data,$nomor);
			}
		}
		$tahun = substr($data['tanggal_transaksi'],0,4);
		$bulan = substr($data['tanggal_transaksi'],5,2);
		$this->index($data['transaksi'].'_'.$bulan.'_'.$tahun);
	}
	function buku_besar()
	{
		$uri = $this->uri->segment(3);
		if($uri != '')
		{
			$prop = explode('_',$uri);
			$buku = $prop[0];
			$bulan = $prop[1];
			$tahun = $prop[2];
		}
		else
		{
			$buku = 1;
			$bulan = date('m');
			$tahun = date('Y');
		}
		$data['detail'] = $this->trmodel->get_detail_buku($buku,$bulan,$tahun);
		$data['info'] = $this->trmodel->get_saldo($buku,$bulan,$tahun);
		$data['buku'] = $this->trmodel->get_buku();
		$data['cur_buku'] = $buku;
		$data['cur_bulan'] = $bulan;
		$data['cur_tahun'] = $tahun;
		$this->load->view('transaksi/buku_besar',$data);
	}
	function setup()
	{
		$this->auth->cek('data_master');
		$data['setup'] = $this->trmodel->get_setup();
		$data['buku'] = $this->trmodel->get_buku();
		$this->load->view('transaksi/setup',$data);
	}
	function simpan_setup()
	{
		$this->auth->cek('data_master');
		$field = array_keys($_POST);
		$data = $this->fungsi->accept_data($field);
		$this->trmodel->simpan_setup($data);
		$this->setup();
	}
	function hapus_setup()
	{
		$this->auth->cek('data_master');
		$id = $this->uri->segment(3);
		$this->trmodel->hapus_setup($id);
		$this->setup();
	}
	function simpan_buku()
	{
		$this->auth->cek('data_master');
		$field = array_keys($_POST);
		$data = $this->fungsi->accept_data($field);
		$this->trmodel->simpan_buku($data);
		$this->setup();
	}
	function hapus_buku()
	{
		$this->auth->cek('data_master');
		$id = $this->uri->segment(3);
		$this->trmodel->hapus_buku($id);
		$this->setup();
	}
}

/* End of file transaksi.php */
/* Location: ./system/application/controllers/transaksi.php */