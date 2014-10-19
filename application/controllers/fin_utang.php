<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fin_utang extends CI_Controller {

	function __construct(){
		parent::__construct();			
	}	

	function index($mon,$tahun){		
		$data['komponen_top'] = array('navbar','forcelogin');
		$data['kal_day']= $this->app_model->getSelectedData('tbl_kalender',array('id'=>$mon));
		$data['tahun'] = $tahun;
		$data['template'] = 'satucolumn';
		$data['home'] = '';		
		$data['interface'] = array('fin_utang');
		$this->load->view('index',$data);
	}
	function view($mon,$tahun,$bulantext)
	{
		$data['keu'] = $this->app_model->fin_utang($mon,$tahun);
		$data['keu_total_debet'] = $this->app_model->fin_sum('debet',5,$mon,$tahun)->row()->total;
		$data['keu_total_kredit'] = $this->app_model->fin_sum('kredit',5,$mon,$tahun)->row()->total;
		$data['mon'] = $mon;
		$data['tahun'] = $tahun;
		$data['bulantext'] = $bulantext;
		$data['kas'] = 'utang';
		$this->load->view('interface/konten_fin__view',$data);
	}
}

/* End of file fin_utang.php */
/* Location: ./fin_utanglication/controllers/fin_utang.php */