<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('auth');
		$this->load->model(array('usermodel'));
		$this->auth->restrict();
		$this->auth->cek('manajemen_user');
	}	
	function index()
	{
		$data['user'] = $this->usermodel->get_list_user();
		$this->load->view('user/panel',$data);
	}
	function simpan()
	{
		$data = $this->fungsi->accept_data(array_keys($_POST));
		$this->usermodel->simpan($data);
		$this->index();
	}
	function hapus()
	{
		$id = $this->uri->segment(3);
		$this->usermodel->hapus_user($id);
		$this->index();
	}
}

/* End of file user.php */
/* Location: ./system/application/controllers/user.php */