<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backup extends CI_Controller {

		
	public function index()
	{
		$cek = $this->session->userdata('username');
		if(!empty($cek))
		{
			$this->app_model->manualQuery("TRUNCATE TABLE ci_sessions");
			$nama_file = 'backup-'.date('Y-m-d').'.txt.zip';
			$this->load->dbutil();
			$backup = $this->dbutil->backup();
			force_download($nama_file,$backup);
		}
		else
		{
			$st = $this->session->userdata('stts');
			if($st=='admin')
			{
				header('location:'.base_url().'app');
			}
			else
			{
				header('location:'.base_url().'app');
			}
		
		}
	}
}

/* End of file backup.php */
/* Location: ./application/controllers/backup.php */