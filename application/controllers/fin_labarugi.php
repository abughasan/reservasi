<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Fin_labarugi extends CI_Controller {
	function __construct(){
		parent::__construct();			
	}	
	function index($mon,$tahun){
		$data['komponen_top'] = array('navbar','forcelogin');
		$data['kal_day']= $this->app_model->getSelectedData('tbl_kalender',array('id'=>$mon));
		$data['tahun'] = $tahun;
		$data['template'] = 'satucolumn';
		$data['home'] = '';		
		$data['interface'] = array('fin_labarugi');
				$this->load->view('index',$data);
	}
	function view($mon,$tahun,$bulantext)
	{
		$data['pemasukan'] = $this->app_model->fin_pemasukan($mon,$tahun);
		$data['pemasukan_total'] = $this->app_model->fin_pemasukan_sum($mon,$tahun)->row()->total;
		$data['pengeluaran'] = $this->app_model->fin_pengeluaran($mon,$tahun);
		$data['pengeluaran_total'] = $this->app_model->fin_pengeluaran_sum($mon,$tahun)->row()->total;
		$data['mon'] = $mon;
		$data['tahun'] = $tahun;
		$data['bulantext'] = $bulantext;
		$this->load->view('interface/konten_fin_labarugi_view',$data);
	}		/** 	function perperiod($tgl1,$tgl2)	{		$data['pemasukan'] = $this->app_model->fin_pemasukan($tgl1,$tgl2);		$data['pemasukan_total'] = $this->app_model->fin_pemasukan_sum(($tgl1, $tgl2)->row()->total;		$data['pengeluaran'] = $this->app_model->fin_pengeluaran($tgl1,$tgl2);		$data['pengeluaran_total'] = $this->app_model->fin_pengeluaran_sum($tgl1,$tgl2)->row()->total;		$data['tgl1'] = $tgl1;		$data['tgl2'] = $tgl2;		$data['bulantext'] = $bulantext;		$this->load->view('interface/konten_fin_labarugi_pertanggal',$data);				}	*/	
}
/* End of file fin_labarugi.php */
/* Location: ./fin_labarugilication/controllers/fin_labarugi.php */