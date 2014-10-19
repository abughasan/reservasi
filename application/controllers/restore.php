<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Restore extends CI_Controller {

	public function index()
	{
		$data['restore'] = '';
		$data['interface'] = array('restore');		
		$data['template'] = 'satucolumn';
		$data['komponen_top'] = array('navbar','forcelogin');		
		$this->load->view('index',$data);		
	}
	
	public function upload()
	{
			$acak=rand(00000000000,99999999999);
			$bersih=$_FILES['userfile']['name'];
			$nm=str_replace(" ","_","$bersih");
			$pisah=explode(".",$nm);
			$nama_murni_lama = preg_replace("/^(.+?);.*$/", "\\1",$pisah[0]);
			$nama_murni=date('Ymd-His');
			$ekstensi_kotor = $pisah[1];
			
			$file_type = preg_replace("/^(.+?);.*$/", "\\1", $ekstensi_kotor);
			$file_type_baru = strtolower($file_type);
			
			$ubah=$acak; //tanpa ekstensi
			$n_baru = $ubah.'.'.$file_type_baru;
			
			$in['gbr'] = $n_baru;
		
			$config['upload_path'] = './assets/db_temp/';
			$config['allowed_types'] = 'txt';
			$config['max_size'] = '1000000';
			$config['max_width'] = '100';
			$config['max_height'] = '100';		
			$config['file_name'] = $n_baru;						
			$this->load->library('upload', $config);
			
			if(!$this->upload->do_upload())
			{
				echo $this->upload->display_errors();
			}
			else 
			{
				$this->app_model->manualQuery("TRUNCATE TABLE ci_sessions");
				$this->app_model->manualQuery("TRUNCATE TABLE tbl_barang");
				$this->app_model->manualQuery("TRUNCATE TABLE tbl_denda");
				$this->app_model->manualQuery("TRUNCATE TABLE tbl_guide");
				$this->app_model->manualQuery("TRUNCATE TABLE tbl_hadir");
				$this->app_model->manualQuery("TRUNCATE TABLE tbl_kartu");
				$this->app_model->manualQuery("TRUNCATE TABLE tbl_kategori");
				$this->app_model->manualQuery("TRUNCATE TABLE tbl_login");
				$this->app_model->manualQuery("TRUNCATE TABLE tbl_pembayaran");
				$this->app_model->manualQuery("TRUNCATE TABLE tbl_status_v");
				$this->app_model->manualQuery("TRUNCATE TABLE tbl_tamu");
				$this->app_model->manualQuery("TRUNCATE TABLE tbl_transaksi");
				$this->app_model->manualQuery("TRUNCATE TABLE tbl_villa");
				session_start();
				session_destroy();
				$direktori = "./assets/db_temp/".$config['file_name'];
				$isi_file=file_get_contents($direktori);
				$string_query=rtrim($isi_file, "\n;" );
				$array_query=explode(";", $string_query);
				foreach($array_query as $query)
				{
					$this->db->query($query);
				}
				unlink($direktori);				
				header('location:'.base_url().'app');
			}		
	}
}

/* End of file restore.php */
/* Location: ./application/controllers/restore.php */