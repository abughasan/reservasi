<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kamar extends CI_Controller {

	function index()
	{	
		$page=$this->uri->segment(3);
		$limit= 10; //$this->config->item('limit_data');
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		
		$tot_hal = $this->app_model->getAllData("tbl_kamar");
		$data['dt_kamar'] = $this->app_model->getAllDataLimited("tbl_kamar",$limit,$offset);
		$config['base_url'] = base_url() . 'kamar/index/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 3;
		$config['first_link'] = 'Awal';
		$config['last_link'] = 'Akhir';
		$config['next_link'] = 'Selanjutnya';
		$config['prev_link'] = 'Sebelumnya';
		$this->pagination->initialize($config);
		$data["paginator"] =$this->pagination->create_links();
		
		$data['kamar'] = '';
		$data['interface'] = array('kamar');		
		$data['template'] = 'satucolumn';
		$data['komponen_top'] = array('navbar','forcelogin');
		$data['dt_kamar'] = $this->app_model->getAllData('tbl_kamar');		
		$this->load->view('index',$data);
	}
	
	function tambah()
	{	
			$data['jdl'] = "Tambah";			
			
			$data['nama_kamar'] = "";			
			$data['stts_input'] = "tambah";
			
			$data['kamar'] = '';
			$data['interface'] = array('kamar_tambah');					
			$data['template'] = 'satucolumn';
			$data['komponen_top'] = array('navbar','forcelogin');
			$this->load->view('index',$data);
	}
	
	public function edit()
	{
		$id['id_kamar'] = $this->uri->segment(3);
		$detail = $this->app_model->getSelectedData("tbl_kamar",$id);
		
		foreach($detail->result() as $d)
		{
			$data['jdl'] = "Edit";
			$data['id_kamar'] = $d->id_kamar;
			$data['nama_kamar'] = $d->nama_kamar;			
			
			$data['stts_input'] = "edit";
		}
		
		$data['kamar'] = '';
		$data['interface'] = array('kamar_tambah');					
		$data['template'] = 'satucolumn';
		$data['komponen_top'] = array('navbar','forcelogin');
		
		$this->load->view('index',$data);			
	}
	
	
	function simpan_input()
	{
			$st = $this->input->post('stts_input');			
			if($st=="tambah")
			{
				//$ck['id_kamar'] = $this->input->post('id_kamar');
				$ck['nama_kamar'] = $this->input->post('nama_kamar');
				$in['id_kamar'] = $this->input->post('id_kamar');
				$in['nama_kamar'] = $this->input->post('nama_kamar');				
				
				$cek = $this->app_model->getSelectedData("tbl_kamar",$ck);
				if($cek->num_rows()>0)
				{
					$this->session->set_flashdata('gagal_kamar', 'sudah terdaftar...!!!');
					//redirect('kamar/tambah');
					header('location:'.base_url().'kamar/tambah');
				}
				else
				{
					$this->app_model->insertData("tbl_kamar",$in);
					redirect('kamar');					
				}
			}
			else if($st=="edit")
			{
				if($this->input->post('id_kamar')!="")
				{
					$id['id_kamar'] = $this->input->post('id_kamar');
					$up['nama_kamar'] = $this->input->post('nama_kamar');					
					
					$this->app_model->updateData("tbl_kamar",$up,$id);
				}				
					redirect('kamar');				
			}
		
	}
		
	function hapus()
	{
		$del['id_kamar'] = $this->uri->segment(3);
		$this->app_model->deleteData("tbl_kamar",$del);
		header('location:'.base_url().'kamar');		
	}
	
	

}