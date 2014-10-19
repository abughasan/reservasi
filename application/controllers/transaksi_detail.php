<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// @adin
//
class Transaksi_detail extends CI_Controller {

	function index(){
		//definisikan nama table dulu biar mudah copas bikin controller
		//oke faham @adin
		$table = 'tbl_pembayaran';
		$page=$this->uri->segment(3);
		$limit=$this->config->item('limit_data');
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		
		$tot_hal = $this->app_model->getAllData($table);
		$data['dt_villa'] = $this->app_model->getAllDataLimited($table,$limit,$offset);
		$config['base_url'] = base_url() . 'transaksi_detail/index/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 3;
		$config['first_link'] = 'Awal';
		$config['last_link'] = 'Akhir';
		$config['next_link'] = 'Selanjutnya';
		$config['prev_link'] = 'Sebelumnya';
		$this->pagination->initialize($config);
		$data["paginator"] =$this->pagination->create_links();
		
		$data['villa'] = '';
		$data['interface'] = array('transaksi_detail');		
		$data['template'] = 'satucolumn';
		$data['komponen_top'] = array('navbar','forcelogin');
		$data['dt_villa'] = $this->app_model->getAllData($table);
		$data['dt_denda'] = $this->app_model->getAllData('tbl_denda');
		//cari tahu nama2 kolom di table tsb.
		$data['list_field'] = $this->db->list_fields($table);
		$this->load->view('index',$data);
	}
	function checkin($notransaksi) {		
		$tgl_cekin = date("Y-m-d");
		$this->app_model->updateData('tbl_transaksi',array('tgl_cekin'=>$tgl_cekin),array('no_transaksi'=>$notransaksi));
		echo "<meta http-equiv=\"refresh\" content=\"0;url=".$_SERVER['HTTP_REFERER']."\"/>";
	}
	function checkout($notransaksi) {		
		$tgl_cekin = date("Y-m-d");
		$this->app_model->updateData('tbl_transaksi',array('tgl_cekout'=>$tgl_cekin),array('no_transaksi'=>$notransaksi));
		echo "<meta http-equiv=\"refresh\" content=\"0;url=".$_SERVER['HTTP_REFERER']."\"/>";
	}
	
	public function cari()
	{
			$table ='tbl_transaksi';
			if($this->input->post("cari")=="")
			{
				$kata = $this->session->userdata('kata');
			}
			else
			{
				$sess_data['kata'] = $this->input->post("cari");
				$this->session->set_userdata($sess_data);
				$kata = $this->session->userdata('kata');
			}
			
			$page=$this->uri->segment(3);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$data['tot'] = $page;
			$tot_hal = $this->db->query("select * from tbl_transaksi where no_transaksi like '%".$kata."%'");
			$config['base_url'] = base_url() . 'transaksi/cari/';
			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			$config['first_link'] = 'Awal';
			$config['last_link'] = 'Akhir';
			$config['next_link'] = 'Selanjutnya';
			$config['prev_link'] = 'Sebelumnya';
			$this->pagination->initialize($config);
			
			$data["paginator"] =$this->pagination->create_links();
			$data['dt_villa'] = $this->db->query("select * from tbl_transaksi 
			where no_transaksi like '%".$kata."%' LIMIT ".$offset.",".$limit."");

			$data['villa'] = '';
			$data['interface'] = array('data_transaksi');		
			$data['template'] = 'satucolumn';
			$data['komponen_top'] = array('navbar','forcelogin');
			//$data['dt_villa'] = $this->app_model->getAllData($table);
			//cari tahu nama2 kolom di table tsb.
			$data['list_field'] = $this->db->list_fields($table);
			$this->load->view('index',$data);
		
	}

}