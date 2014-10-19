<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// @ali
//
class villa_booked extends CI_Controller {

	function index(){
		$data['filter'] = explode("_",$this->uri->segment(4));
		$data['interface'] = array('villa_booked');		
		$data['template'] = 'satucolumn';
		$data['komponen_top'] = array('navbar','forcelogin');
		$data['dt_villa'] = $this->app_model->getAllData('tbl_villa');
		
		if ( (@$data['filter'][0] != "") AND (@$data['filter'][1] == "") ) : 
			$data['dt_villa_v'] = $data['dt_villa'];
			$data['status_booking'] = "";
			$data['dateSelected'] = $data['filter'][0];
		endif;
		
		if ( (@$data['filter'][1] != "") AND (@$data['filter'][0] == "") ) ;
		if ( (@$data['filter'][1] != "") AND (@$data['filter'][0] != "") ) ;
		

		$this->load->view('index',$data);
	}

}