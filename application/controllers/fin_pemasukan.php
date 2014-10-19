<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Fin_pemasukan extends CI_Controller {
	function __construct(){
		parent::__construct();			
	}	

	function index($mon,$tahun){		
		$data['komponen_top'] = array('navbar','forcelogin');
		$data['kal_day']= $this->app_model->getSelectedData('tbl_kalender',array('id'=>$mon));
		$data['tahun'] = $tahun;
		$data['template'] = 'satucolumn';
		$data['home'] = '';		
		$data['interface'] = array('fin_pemasukan');
		$this->load->view('index',$data);
	}
	function view($mon,$tahun)
	{
		$data['keu'] = $this->app_model->fin_pemasukan($mon,$tahun);
		$data['keu_total'] = $this->app_model->fin_pemasukan_sum($mon,$tahun)->row()->total;
		$data['mon'] = $mon;
		$data['tahun'] = $tahun;
		$this->load->view('interface/konten_fin_pengeluaran_view',$data);
	}	}

/* End of file fin_pemasukan.php */
/* Location: ./fin_pemasukanlication/controllers/fin_pemasukan.php */