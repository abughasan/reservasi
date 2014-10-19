<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// @ali
//
class Order extends CI_Controller {

	function index(){
		//definisikan nama table dulu biar mudah copas bikin controller
		$data['transaksi'] = '';
		$data['interface'] = array('transaksi');		
		$data['template'] = 'satucolumn';
		$data['komponen_top'] = array('navbar','forcelogin');
		$data['dt_tamu'] = $this->app_model->getAllData('tbl_tamu');
		//cari tahu nama2 kolom di table tsb.
		//$data['list_field'] = $this->db->list_fields($table);
		$this->load->view('index',$data);
	}
	

}