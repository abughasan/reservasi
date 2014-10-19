<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// @ali
//
class Transaksi extends CI_Controller {

	function index(){
		//definisikan nama table dulu biar mudah copas bikin controller
		//oke faham
		$table = 'tbl_transaksi';
				
		$data['villa'] = '';
		$data['interface'] = array('data_transaksi');		
		$data['template'] = 'satucolumn';
		$data['komponen_top'] = array('navbar','forcelogin');
		$data['dt_transaksi'] = $this->app_model->getAllData($table);
		//cari tahu nama2 kolom di table tsb.
		$data['list_field'] = $this->db->list_fields($table);
		$this->load->view('index',$data);
	}
	
	function go(){
		//definisikan nama table dulu biar mudah copas bikin controller
		//oke faham
				
		$data['transaksi'] = '';
		$data['interface'] = array('go_transaksi');		
		$data['template'] = 'satucolumn';
		$data['komponen_top'] = array('navbar','forcelogin');
		//query
		$data['dt_transaksi'] = $this->app_model->manualQuery("
			SELECT
				tr.no_transaksi,
				tr.tgl_transaksi,
				tm.nama_tamu,
				vl.kode_villa,
				tr.lama_hari,
				tr.dapat_harga,
				tr.sisa_bayar,
				byr.status_bayar
			FROM
				tbl_transaksi tr
			LEFT JOIN 
				tbl_tamu tm
				ON tr.id_tamu = tm.id_tamu
			LEFT JOIN 
				tbl_villa vl
				ON tr.kode_villa = vl.kode_villa
			LEFT JOIN 
				tbl_pembayaran byr
				ON tr.no_transaksi = byr.no_transaksi				
			");				
				
		$data['list_field'] = $this->db->list_fields('tbl_transaksi');
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
				//simpan session
				$sess_data['kata'] = $this->input->post("cari");
				$this->session->set_userdata($sess_data);
				//pangggil session
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
			$data['dt_transaksi'] = $this->db->query("select * from tbl_transaksi 
			where no_transaksi like '%".$kata."%' LIMIT ".$offset.",".$limit."");

			$data['villa'] = '';
			$data['interface'] = array('data_transaksi');		
			$data['template'] = 'satucolumn';
			$data['komponen_top'] = array('navbar','forcelogin');
			//$data['dt_transaksi'] = $this->app_model->getAllData($table);
			//cari tahu nama2 kolom di table tsb.
			$data['list_field'] = $this->db->list_fields($table);
			$this->load->view('index',$data);
		
	}
	
	public function detail(){
			echo "detail";	
	}

}