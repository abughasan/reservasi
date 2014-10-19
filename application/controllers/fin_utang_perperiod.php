<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fin_utang_perperiod extends CI_Controller {

	function __construct(){
		parent::__construct();			
	}	
	public function index()
	{		if($this->input->post("tgl1")== "")		{			$tgl1 = 0;			$tgl2 = 0;			$data['keu'] = $this->app_model->fin_piutang_p($tgl1,$tgl2);			//$data['keu_total'] = $this->app_model->fin_piutang_sum_p($tgl1,$tgl2)->row()->total;			$data['keu_total_debet'] = $this->app_model->fin_sum_p('debet',4,$tgl1,$tgl2)->row()->total;			$data['keu_total_kredit'] = $this->app_model->fin_sum_p('kredit',4,$tgl1,$tgl2)->row()->total;		}		else		{			//simpan session			$sess_data['mulai'] = $this->input->post("tgl1");				$sess_data['akhir'] = $this->input->post("tgl2");						$this->session->set_userdata($sess_data);			//pangggil session			$tgl1 = $this->session->userdata('mulai');			$tgl2 = $this->session->userdata('akhir');									$data['keu'] = $this->app_model->fin_utang_p($tgl1,$tgl2);			$data['keu_total_debet'] = $this->app_model->fin_sum_p('debet',5,$tgl1,$tgl2)->row()->total;			$data['keu_total_kredit'] = $this->app_model->fin_sum_p('kredit',5,$tgl1,$tgl2)->row()->total;			//$data['keu_total'] = $this->app_model->fin_piutang_sum_p($tgl1,$tgl2)->row()->total;		}				//$data['keu'] = $this->app_model->fin_pemasukan_p($tgl1,$tgl2);		//$data['keu'] = $this->app_model->fin_pemasukan($mon,$tahun);						$data['komponen_top'] = array('navbar','forcelogin');		$data['template'] = 'satucolumn';		$data['home'] = '';				$data['interface'] = array('fin_utang_perperiod');				$this->load->view('index',$data);	}		public function cetak()	{		//pangggil session		$tgl1 = $this->session->userdata('mulai');		$tgl2 = $this->session->userdata('akhir');													$data['keu'] = $this->app_model->fin_utang_p($tgl1,$tgl2);		$data['keu_total_debet'] = $this->app_model->fin_sum_p('debet',5,$tgl1,$tgl2)->row()->total;		$data['keu_total_kredit'] = $this->app_model->fin_sum_p('kredit',5,$tgl1,$tgl2)->row()->total;				//$data['list_field'] = $this->db->list_fields($table);		$data['komponen_top'] = array('nav-print','lap_keu_piutang');		$this->load->view('index',$data);	}
	
}

/* End of file fin_utang.php */
/* Location: ./fin_utanglication/controllers/fin_utang.php */