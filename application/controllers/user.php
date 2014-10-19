<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	function index()
	{	
		$page=$this->uri->segment(3);
		$limit=$this->config->item('limit_data');
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		
		$tot_hal = $this->app_model->getAllData("tbl_login");
		$data['dt_user'] = $this->app_model->getAllDataLimited("tbl_login",$limit,$offset);
		$config['base_url'] = base_url() . 'user/index/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 3;
		$config['first_link'] = 'Awal';
		$config['last_link'] = 'Akhir';
		$config['next_link'] = 'Selanjutnya';
		$config['prev_link'] = 'Sebelumnya';
		$this->pagination->initialize($config);
		$data["paginator"] =$this->pagination->create_links();
		
		$data['user'] = '';
		$data['interface'] = array('user');		
		$data['template'] = 'satucolumn';
		$data['komponen_top'] = array('navbar','forcelogin');
		$data['user'] = $this->app_model->getAllData('tbl_login');		
		$this->load->view('index',$data);
	}
	
	function tambah()
	{	
			$data['jdl'] = "Tambah";
			$data['username'] = "";
			$data['password'] = "";
			$data['nama_pengguna'] = "";
			$data['stts'] = "";
			$data['stts_input'] = "tambah";
			
			$data['user'] = '';
			$data['interface'] = array('user_tambah');					
			$data['template'] = 'satucolumn';
			$data['komponen_top'] = array('navbar','forcelogin');
			$this->load->view('index',$data);
	}
	
	public function edit()
	{
		$id['username'] = $this->uri->segment(3);
		$detail = $this->app_model->getSelectedData("tbl_login",$id);
		foreach($detail->result() as $d)
		{
			$data['jdl'] = "Edit";
			$data['username'] = $d->username;
			$data['password'] = "";
			$data['nama_pengguna'] = $d->nama_pengguna;
			$data['stts'] = $d->stts;
			$data['stts_input'] = "edit";
		}
		
		$data['user'] = '';
		$data['interface'] = array('user_tambah');					
		$data['template'] = 'satucolumn';
		$data['komponen_top'] = array('navbar','forcelogin');
		
		$this->load->view('index',$data);			
	}
	
	
	function simpan_input()
	{
			$st = $this->input->post('stts_input');
			if($st=="tambah")
			{
				$ck['username'] = $this->input->post('username');
				$in['nama_pengguna'] = $this->input->post('nama_pengguna');
				$in['username'] = $this->input->post('username');
				$in['password'] = md5($this->input->post('password'));
				$in['stts'] = $this->input->post('stts');
				$cek = $this->app_model->getSelectedData("tbl_login",$ck);
				if($cek->num_rows()>0)
				{
					$this->session->set_flashdata('gagal_user', 'Username telah terdaftar...!!!');
					header('location:'.base_url().'user/tambah');
				}
				else
				{
					$this->app_model->insertData("tbl_login",$in);
					redirect('user');
					?>
						<script>
							//window.parent.location.reload(true);
						</script>
					
					<?php
				}
			}
			else if($st=="edit")
			{
				$id['username'] = $this->input->post('username');
				$up['nama_pengguna'] = $this->input->post('nama_pengguna');
				$up['password'] = md5($this->input->post('password'));
				$up['stts'] = $this->input->post('stts');
				$this->app_model->updateData("tbl_login",$up,$id);
			
				redirect('user');					
			}
		
	}
		
	function hapus()
	{
		$cek = $this->session->userdata('username');
		if(!empty($cek))
		{
			$del['username'] = $this->uri->segment(3);
			$this->app_model->deleteData("tbl_login",$del);
			header('location:'.base_url().'user');
		}		
	}
	
	

}