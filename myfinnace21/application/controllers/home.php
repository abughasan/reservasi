<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('auth');
		$this->load->model(array('trmodel'));
	}	
	function index()
	{		
		$this->load->view('home/index');	
	}
	function do_login()
	{
		$this->auth->restrict(true);
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('captcha', 'Captcha', 'trim|required|callback_valid_captcha');
		$this->form_validation->set_message('valid_captcha','%s tidak sama');
		if ($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{
			$this->load->library('auth');
			$login = array('username'=>$this->input->post('username'),
				       'password'=>$this->input->post('password')
			);
			$return = $this->auth->do_login($login);
			if($return)
			{
				echo warning('Selamat datang, '.from_session('nama'),'home');
			}
			else
			{
				echo warning('Maaf, username atau password yang Anda masukkan salah...','home');
			}
		}
	}
	function valid_captcha($str)
	{
		$expiration = time()-60;
		$this->db->query("DELETE FROM ".$this->db->dbprefix."captcha WHERE captcha_time < ".$expiration);
		$sql = "SELECT COUNT(*) AS count FROM ".$this->db->dbprefix."captcha WHERE word = ? 
			    AND ip_address = ? AND captcha_time > ?";
		$binds = array($str, $this->input->ip_address(), $expiration);
		$query = $this->db->query($sql, $binds);
		$row = $query->row();	
		if ($row->count == 0) 
		{
			return FALSE;
		}else{
			return TRUE;
		}          
	}
	function logout()
	{
		$this->auth->logout();
		echo warning('Anda berhasil logout...','home');
	}
	function front()
	{
		if(!is_logged_in())
		{
			$data = $this->auth->setChaptcha();
			$this->load->view('home/login_form',$data);
		}
		else
		{
			$chart = $this->trmodel->get_chart();
			$this->load->view('home/beranda',$chart);
		}	
	}
	function about()
	{
		$this->load->view('home/about');		
	}
}

/* End of file home.php */
/* Location: ./system/application/controllers/home.php */