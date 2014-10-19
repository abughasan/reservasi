<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Fin_kas extends CI_Controller {
	function __construct(){
		parent::__construct();
	}		
	function index($mon,$tahun)
	{		
	
	$data['komponen_top'] = array('navbar','forcelogin');		
	$data['kal_day']= $this->app_model->getSelectedData('tbl_kalender',array('id'=>$mon));		
	$data['tahun'] = $tahun;		
	$data['template'] = 'satucolumn';		
	$data['home'] = '';				
	$data['interface'] = array('fin_kas');				
	$this->load->view('index',$data);	
	
	}			
	function view($mon,$tahun,$bulantext)	
	{			
	//KASIR		
	$data['pemasukan_kasir'] = $this->app_model->fin_pemasukan_kasir($mon,$tahun);		
	$data['pengeluaran_kasir'] = $this->app_model->fin_pengeluaran_kasir($mon,$tahun);				
	$data['pemasukan_total_kasir'] = $this->app_model->fin_pemasukan_sum_kasir($mon,$tahun)->row()->total;		
	$data['pengeluaran_total_kasir'] = $this->app_model->fin_pengeluaran_sum_kasir($mon,$tahun)->row()->total;						
	//PETTY		
	$data['pemasukan_petty'] = $this->app_model->fin_pemasukan_petty($mon,$tahun);		
	$data['pemasukan_total_petty'] = $this->app_model->fin_pemasukan_sum_petty($mon,$tahun)->row()->total;				
	$data['pengeluaran_petty'] = $this->app_model->fin_pengeluaran_petty($mon,$tahun);		
	$data['pengeluaran_total_petty'] = $this->app_model->fin_pengeluaran_sum_petty($mon,$tahun)->row()->total;				
	//BANK		
	$data['pemasukan_bank'] = $this->app_model->fin_pemasukan_bank($mon,$tahun);		
	$data['pemasukan_total_bank'] = $this->app_model->fin_pemasukan_sum_bank($mon,$tahun)->row()->total;				
	$data['pengeluaran_bank'] = $this->app_model->fin_pengeluaran_bank($mon,$tahun);		
	$data['pengeluaran_total_bank'] = $this->app_model->fin_pengeluaran_sum_bank($mon,$tahun)->row()->total;				
	$data['mon'] = $mon;		
	$data['tahun'] = $tahun;		
	$data['bulantext'] = $bulantext;		
	$this->load->view('interface/konten_fin_kas_view',$data);	
	}
}

/* End of file fin_kas.php */
/* Location: ./fin_kaslication/controllers/fin_kas.php */