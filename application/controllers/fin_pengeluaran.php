<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fin_pengeluaran extends CI_Controller {

	function __construct(){
		parent::__construct();			
	}	

	function index($mon,$tahun){
		$data['komponen_top'] = array('navbar','forcelogin');
		$data['kal_day']= $this->app_model->getSelectedData('tbl_kalender',array('id'=>$mon));
		$data['tahun'] = $tahun;
		$data['template'] = 'satucolumn';
		$data['home'] = '';		
		$data['interface'] = array('fin_pengeluaran');
		
		$this->load->view('index',$data);
	}
	function view($mon,$tahun)	{
		$data['keu'] = $this->app_model->fin_pengeluaran($mon,$tahun);
		$data['keu_total'] = $this->app_model->fin_pengeluaran_sum($mon,$tahun)->row()->total;
		$data['mon'] = $mon;
		$data['tahun'] = $tahun;
		$this->load->view('interface/konten_fin_pengeluaran_view',$data);
	}
}

/* End of file fin_pengeluaran.php */
/* Location: ./fin_pengeluaranlication/controllers/fin_pengeluaran.php */