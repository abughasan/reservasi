<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// @ali
//
class Ordervilla extends CI_Controller {

	function index(){
		// $manualdate = $this->uri->segment(6);
		// if ( $manualdate == 'manual' ) {$datein = $this->uri->segment(7);$dateout = $this->uri->segment(8)}
		$datein = $this->input->post('tglcekin');
		$dateout = $this->input->post('tglcekout');
		$lamahari = explode(" ",$this->input->post('lamahari'));
		//definisikan nama table dulu biar mudah copas bikin controller
		$table = 'tbl_villa';
		$page=$this->uri->segment(3);
		$limit=$this->config->item('limit_data');
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		
		$tot_hal = $this->app_model->getAllData($table);
		$data['dt_transaksi'] = $this->app_model->getAllDataLimited($table,$limit,$offset);
		$config['base_url'] = base_url() . 'villa/index/';
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
		$data['interface'] = array('browse_villa');		
		$data['template'] = 'satucolumn';
		$data['komponen_top'] = array('navbar','forcelogin');
		$data['dt_villa'] = $this->app_model->getAllData($table);
		$data['villa_tersedia'] = $this->app_model->manualQuery("
			SELECT * FROM tbl_villa tv
			WHERE tv.kode_villa NOT IN	
			(
				SELECT tt.kode_villa FROM tbl_transaksi tt
				WHERE 
					(tt.tgl_cekin <= '{$datein}' AND tt.tgl_cekout >= '{$dateout}')
				 OR 
					(tt.tgl_cekin < '{$dateout}' AND tt.tgl_cekout >= '{$datein}')
				 OR
					(tt.tgl_cekin >= '{$datein}' AND tt.tgl_cekout < '{$dateout}')
			)
		");
		
		// $data['villa_tersedia'] = $this->app_model->manualQuery("SELECT `cek_villa_tersedia`('2014-06-20', '2014-06-30') as villa");
		//cari tahu nama2 kolom di table tsb.
		$data['list_field'] = $this->db->list_fields($table);
		$data['datein'] = $datein;
		$data['dateout'] = $dateout;
		$sess_array = array(
		 'dateorder' => explode("_",$datein."_".$dateout),
		);
		$this->session->set_userdata($sess_array);
		$data['dateorder'] = $this->session->userdata('dateorder');
		$data['lamahari'] = $lamahari[0];
		if ( EMPTY($data['dateorder'][0]) )
		{
			echo "<script>alert('Silahkan pilih tanggal terlebih dahulu');</script>";
			echo "<script>window.location='".base_url()."pilih_tanggal';</script>";
		}
		$data['istime'] = $this->app_model->manualQuery("SELECT IF((CURTIME() > '12:00:00'),'PM','AM') ISTIME")->row()->ISTIME;
		$this->load->view('index',$data);
	}

}