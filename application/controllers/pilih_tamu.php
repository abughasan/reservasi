<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// @ali
//
class Pilih_tamu extends CI_Controller {

	function index(){
		//definisikan nama table dulu biar mudah copas bikin controller
		$data['pilih_tamu'] = '';
		$data['interface'] = array('pilih_tamu');		
		$data['template'] = 'satucolumn';
		$data['komponen_top'] = array('navbar','forcelogin');
		//$data['dt_villa'] = $this->app_model->getAllData($table);
		//cari tahu nama2 kolom di table tsb.
		//$data['list_field'] = $this->db->list_fields($table);
		//$data['datein'] = $this->session->userdata(datein);
		//$data['dateout'] = $this->session->userdata(dateout);
		
		$data['dateorder'] = $this->session->userdata('dateorder');
		$data['user'] = $this->session->userdata('nama_pengguna');
			
		$this->load->view('index',$data);
	}
	
	

}