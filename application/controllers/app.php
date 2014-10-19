<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class app extends CI_Controller {

	function __construct(){
		parent::__construct();			
	}	

	function index()
	{					
		$data['komponen_top'] = array('login');
		$data['template'] = 'satucolumn';
		$data['home'] = '';		
		$data['interface'] = array('home');
		//$data['menu'] = array('login');
		
		$this->load->view('index',$data);
	}

	function login()
	{	
		// line 15
		// DITAMBAHKAN 1:02 AM 21 JUNI 2014 di LIGAR. 
		// taMBAH komponen_top forcelogin
		// @ali
		$data['komponen_top'] = array('login');
		$data['template'] = 'satucolumn';
		$data['home'] = '';		
		$data['interface'] = array('home');
		//$data['menu'] = array('login');		
		$this->load->view('index',$data);
	}
	
	function ceklogin()
	{
		$user = $this->input->post('username');
		$sandi = $this->input->post('password');
		$data=array(
			'username' => $user,
			//'password' => $sandi,
			'password' => md5($sandi)
		);
		$ceklogin = $this->app_model->getSelectedData('tbl_login',$data)->row();
			if(empty($ceklogin)) {			
				redirect('app','refresh');
			}else{
				$sess_array = array(
				 'username' => $ceklogin->username,
				 'password' => $ceklogin->password,
				 'nama_pengguna' => $ceklogin->nama_pengguna,
				 'stts' => $ceklogin->stts
				);
				$this->session->set_userdata($sess_array);
				redirect('dashboard','refresh');
			}
	}
	function logout()
	{
		$this->session->sess_destroy();
		redirect('app');
	}
	
	function notfound()
	{
		echo "not found";
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */