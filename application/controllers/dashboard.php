<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	//ditambahkan 11:05 di kotabumi
	//tambah dashboard 
	//@adin
	
	function index(){				
		
		$data['dashboard'] = '';		
		$data['interface'] = array('dashboard');
		$data['template'] = 'satucolumn';
		$data['komponen_top'] = array('navbar','forcelogin');
		$this->load->view('index',$data);
	}	
	

	function notfound()
	{
		ECHO "not found";
	}
}