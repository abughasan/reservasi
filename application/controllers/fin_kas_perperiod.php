<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Fin_kas_perperiod extends CI_Controller {
	function __construct(){
		parent::__construct();
	}		function index()	{		if($this->input->post("tgl1")== "")		{			$tgl1 = 0;			$tgl2 = 0;			$data['keu_kas_period'] = $this->app_model->fin_kas_perperiod($tgl1,$tgl2);		}		else		{			//simpan session			$sess_data['mulai'] = $this->input->post("tgl1");				$sess_data['akhir'] = $this->input->post("tgl2");						$this->session->set_userdata($sess_data);			//pangggil session			$tgl1 = $this->session->userdata('mulai');			$tgl2 = $this->session->userdata('akhir');									$data['keu_kas_period'] = $this->app_model->fin_kas_perperiod($tgl1,$tgl2);		}				//KASIR		$data['pemasukan_kasir'] = $this->app_model->fin_pemasukan_kasir_p($tgl1,$tgl2);		$data['pengeluaran_kasir'] = $this->app_model->fin_pengeluaran_kasir_p($tgl1,$tgl2);				$data['pemasukan_total_kasir'] = $this->app_model->fin_pemasukan_sum_kasir_p($tgl1,$tgl2)->row()->total;		$data['pengeluaran_total_kasir'] = $this->app_model->fin_pengeluaran_sum_kasir_p($tgl1,$tgl2)->row()->total;						//PETTY		$data['pemasukan_petty'] = $this->app_model->fin_pemasukan_petty_p($tgl1,$tgl2);		$data['pemasukan_total_petty'] = $this->app_model->fin_pemasukan_sum_petty_p($tgl1,$tgl2)->row()->total;				$data['pengeluaran_petty'] = $this->app_model->fin_pengeluaran_petty_p($tgl1,$tgl2);		$data['pengeluaran_total_petty'] = $this->app_model->fin_pengeluaran_sum_petty_p($tgl1,$tgl2)->row()->total;				//BANK		$data['pemasukan_bank'] = $this->app_model->fin_pemasukan_bank_p($tgl1,$tgl2);		$data['pemasukan_total_bank'] = $this->app_model->fin_pemasukan_sum_bank_p($tgl1,$tgl2)->row()->total;				$data['pengeluaran_bank'] = $this->app_model->fin_pengeluaran_bank_p($tgl1,$tgl2);		$data['pengeluaran_total_bank'] = $this->app_model->fin_pengeluaran_sum_bank_p($tgl1,$tgl2)->row()->total;					$data['komponen_top'] = array('navbar','forcelogin');		$data['template'] = 'satucolumn';		$data['home'] = '';				$data['interface'] = array('fin_kas_perperiod');				$this->load->view('index',$data);	}			public function cetak()	{		//pangggil session		$tgl1 = $this->session->userdata('mulai');		$tgl2 = $this->session->userdata('akhir');													$data['keu_kas_period'] = $this->app_model->fin_kas_perperiod($tgl1,$tgl2);					//KASIR		$data['pemasukan_kasir'] = $this->app_model->fin_pemasukan_kasir_p($tgl1,$tgl2);		$data['pengeluaran_kasir'] = $this->app_model->fin_pengeluaran_kasir_p($tgl1,$tgl2);				$data['pemasukan_total_kasir'] = $this->app_model->fin_pemasukan_sum_kasir_p($tgl1,$tgl2)->row()->total;		$data['pengeluaran_total_kasir'] = $this->app_model->fin_pengeluaran_sum_kasir_p($tgl1,$tgl2)->row()->total;						//PETTY		$data['pemasukan_petty'] = $this->app_model->fin_pemasukan_petty_p($tgl1,$tgl2);		$data['pemasukan_total_petty'] = $this->app_model->fin_pemasukan_sum_petty_p($tgl1,$tgl2)->row()->total;				$data['pengeluaran_petty'] = $this->app_model->fin_pengeluaran_petty_p($tgl1,$tgl2);		$data['pengeluaran_total_petty'] = $this->app_model->fin_pengeluaran_sum_petty_p($tgl1,$tgl2)->row()->total;				//BANK		$data['pemasukan_bank'] = $this->app_model->fin_pemasukan_bank_p($tgl1,$tgl2);		$data['pemasukan_total_bank'] = $this->app_model->fin_pemasukan_sum_bank_p($tgl1,$tgl2)->row()->total;				$data['pengeluaran_bank'] = $this->app_model->fin_pengeluaran_bank_p($tgl1,$tgl2);		$data['pengeluaran_total_bank'] = $this->app_model->fin_pengeluaran_sum_bank_p($tgl1,$tgl2)->row()->total;						//$data['list_field'] = $this->db->list_fields($table);		$data['komponen_top'] = array('nav-print','lap_keu_kas');		$this->load->view('index',$data);	}
}

/* End of file fin_kas.php */
/* Location: ./fin_kaslication/controllers/fin_kas.php */