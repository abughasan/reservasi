<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Auth_mobile {

	var $CI = null;

	function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->database();
	}
	function do_login($login = NULL)
	{
	    	if(!isset($login))
		        return FALSE;
	    	if(count($login) != 2)
			return FALSE;
		
	     	$username = $login['username'];
	     	$password = $login['password'];
	
		$this->CI->db->from('user');
		$this->CI->db->where('user_username', $username);
		$this->CI->db->where("user_password=PASSWORD('$password')");
		$query = $this->CI->db->get();

	     	foreach ($query->result() as $row)
        	{
        		$user_id = $row->user_id;
			$username = $row->user_username;
			$namafull = $row->user_name;
			$count = $row->user_logincount;
			$level = $row->user_level;
			$count++;
        	}
	
	     	if ($query->num_rows() == 1)
	     	{
	       	 	$newdata = array(
	       	 	    'user_id'	=> $user_id,
                            'username'  => $username,
                            'nama'  	=> $namafull,
                            'logged_in' => TRUE,
                            'login_ke' 	=> $count,
			    'level'	=> $level
               		);
			// Our user exists, set session.
			$this->CI->session->set_userdata($newdata);	  
			// update counter login
			$this->CI->db->where('user_id',$user_id);
			$this->CI->db->update('user',array('user_logincount'=>$count));
			return TRUE;
		}
		else 
		{
			// No existing user.
			return FALSE;
		}
	}
    	function restrict($logged_out = FALSE)
    	{		
		if ( ! $logged_out && !is_logged_in()) 
		{
		      echo $this->CI->fungsi->warning('Anda diharuskan untuk Login bila ingin mengakses halaman ini.',site_url().'/mobile');
		      die();
		}
	}
	function logout() 
	{
		$this->CI->session->sess_destroy();	
		return TRUE;
	}
	function cek($id,$ret=false)
	{
		$menu = array(
			'data_master'=>'+admin+',
			'manajemen_user'=>'+admin+'
		);
		$allowed = explode('+',$menu[$id]);
		if(!in_array(from_session('level'),$allowed))
		{
			if($ret) return false;
			echo $this->CI->fungsi->warning('Anda tidak diijinkan mengakses halaman ini.',site_url());
			die();
		}
		else
		{
			if($ret) return true;
		}
	}
	function setChaptcha()
	{
		$this->CI->config->load('config');
		$this->CI->load->helper('string');
		$this->CI->load->helper('captcha');
		$captcha_url = $this->CI->config->item('captcha_url');
		$captcha_path = $this->CI->config->item('captcha_path');
		$vals = array(
			'img_path'      	=> $captcha_path,
			'img_url'       	=> $captcha_url,
			'expiration'    	=> 3600,// one hour
			'font_path'	 	=> './system/fonts/georgia.ttf',
			'img_width'	 	=> '170',
			'img_height' 		=> 50,
			'word'			=> random_string('numeric', 6),
        	);
		$cap = create_captcha($vals);
		$capdb = array(
			'captcha_id'      	=> '',
			'captcha_time'    	=> $cap['time'],
			'ip_address'      	=> $this->CI->input->ip_address(),
			'word'            	=> $cap['word']
		);
		$query = $this->CI->db->insert_string('captcha', $capdb);
		$this->CI->db->query($query);
		return $cap;
	}
	
}
// End of library class
// Location: system/application/libraries/Auth.php
