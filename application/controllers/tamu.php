<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tamu extends CI_Controller {

	function index()
	{	
		$page=$this->uri->segment(3);
		$limit= 10;			//$this->config->item('limit_data');
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		
		$tot_hal = $this->app_model->getAllData("tbl_tamu");
		$config['base_url'] = base_url().'tamu/index';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 3;
		$config['first_link'] = 'Awal';
		$config['last_link'] = 'Akhir';
		$config['next_link'] = 'Selanjutnya';
		$config['prev_link'] = 'Sebelumnya';		
		$this->pagination->initialize($config);
		$data["paginator"] =$this->pagination->create_links();		
		$data['dt_tamu'] = $this->app_model->getAllDataLimited("tbl_tamu",$limit,$offset);
		$data['interface'] = array('tamu');		
		$data['template'] = 'satucolumn';
		$data['komponen_top'] = array('navbar','forcelogin');
		$this->load->view('index',$data);
	}
	
	function cari()
	{
		if($this->input->post("cari")=="")
		{
			//$kata = $this->session->userdata('kata');
			redirect('tamu');
		}
		else
		{
			$sess_data['kata'] = $this->input->post("cari");
			$this->session->set_userdata($sess_data);
			$kata = $this->session->userdata('kata');
		}
		
		$page=$this->uri->segment(3);
		$limit= 10;		//$this->config->item('limit_data');
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		
		$data['tot'] = $page;
		$tot_hal = $this->db->query("select * from tbl_tamu where nama_tamu like '%".$kata."%'");
		$config['base_url'] = base_url() . 'tamu/cari/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 3;
		$config['first_link'] = 'Awal';
		$config['last_link'] = 'Akhir';
		$config['next_link'] = 'Selanjutnya';
		$config['prev_link'] = 'Sebelumnya';
		$this->pagination->initialize($config);		
		$data["paginator"] =$this->pagination->create_links();		
		$data['dt_tamu'] = $this->db->query("select * from tbl_tamu	where 
		nama_tamu like '%".$kata."%' LIMIT ".$offset.",".$limit."");
		
		$data['tamu'] = '';
		$data['interface'] = array('tamu');					
		$data['template'] = 'satucolumn';
		$data['komponen_top'] = array('navbar','forcelogin');
		$this->load->view('index',$data);
	}
	
	function tambah()
	{	
		$data['jdl'] = "Tambah";
		//$data['dt_kartu'] = $this->app_model->getAllData('tbl_tamu');
		$data['jenis_kartu_id'] = "";
		$data['no_kartu_id'] = "";		
		$data['nama_tamu'] = "";		
		$data['alamat_tamu'] = "";		
		$data['tlp'] = "";		
		$data['status'] = "";		
		
		$data['stts_input'] = "tambah";
		
		$data['tamu'] = '';
		$data['interface'] = array('tamu_tambah');					
		$data['template'] = 'satucolumn';
		$data['komponen_top'] = array('navbar','forcelogin');
		$this->load->view('index',$data);
	}
	
	public function edit()
	{
		$id['id_tamu'] = $this->uri->segment(3);
		$detail = $this->app_model->getSelectedData("tbl_tamu",$id);
		foreach($detail->result() as $d)
		{
			$data['jdl'] = "Edit";
			$data['id_tamu'] = $d->id_tamu;
			$data['jenis_kartu_id'] = $d->jenis_kartu_id;
			$data['no_kartu_id'] = $d->no_kartu_id;
			$data['nama_tamu'] = $d->nama_tamu;
			$data['alamat_tamu'] = $d->alamat_tamu;
			$data['tlp'] = $d->tlp;
			$data['status'] = $d->status;
			
			$data['stts_input'] = "edit";
		}
		
		$data['tamu'] = '';
		$data['interface'] = array('tamu_tambah');					
		$data['template'] = 'satucolumn';
		$data['komponen_top'] = array('navbar','forcelogin');
		
		$this->load->view('index',$data);			
	}
	
	
	function simpan_input()
	{
			$st = $this->input->post('stts_input');
			if($st=="tambah")
			{
				$ck['no_kartu_id'] = $this->input->post('no_kartu_id');								
				$ck['nama_tamu'] = $this->input->post('nama_tamu');
				$in['jenis_kartu_id'] = $this->input->post('jenis_kartu_id');
				$in['no_kartu_id'] = $this->input->post('no_kartu_id');
				$in['nama_tamu'] = $this->input->post('nama_tamu');
				$in['alamat_tamu'] = $this->input->post('alamat_tamu');
				$in['tlp'] = $this->input->post('tlp');
				$in['status'] = $this->input->post('status');
				
				$cek = $this->app_model->getSelectedData("tbl_tamu",$ck);
				if($cek->num_rows()>0)
				{
					$this->session->set_flashdata('gagal_tamu', 'Data Tamu Telah Terdaftar...!!!');
					//redirect('villa/tambah');
					header('location:'.base_url().'tamu/tambah');
				}
				else
				{
					$this->app_model->insertData("tbl_tamu",$in);
					redirect('tamu');					
				}
			}
			else if($st=="edit")
			{
				if($this->input->post('id_tamu')!="")
				{
					$id['id_tamu'] = $this->input->post('id_tamu');
					$up['jenis_kartu_id'] = $this->input->post('jenis_kartu_id');
					$up['no_kartu_id'] = $this->input->post('no_kartu_id');
					$up['nama_tamu'] = $this->input->post('nama_tamu');
					$up['alamat_tamu'] = $this->input->post('alamat_tamu');
					$up['tlp'] = $this->input->post('tlp');
					$up['status'] = $this->input->post('status');
					
					$this->app_model->updateData("tbl_tamu",$up,$id);
				}				
					redirect('tamu');
			
			}
			
			if($st=="tambah_from_transaksi")
			{
				$in['jenis_kartu_id'] = $this->input->post('jenis_kartu_id');
				$in['no_kartu_id'] = $this->input->post('no_kartu_id');
				$in['nama_tamu'] = $this->input->post('nama_tamu');
				$in['alamat_tamu'] = $this->input->post('alamat_tamu');
				$in['tlp'] = $this->input->post('tlp');
				$in['status'] = $this->input->post('status');
				$this->app_model->insertData("tbl_tamu",$in);
				
				//----------- variabel untuk transaksi
				$dateIn = $this->input->post('dateIn');
				$dateOut = $this->input->post('dateOut');
				$lamahari = $this->input->post('lamahari');
				$kode_villa = $this->input->post('kode_villa');
				$id_tamu = $this->app_model->manualQuery("SELECT id_tamu from tbl_tamu ORDER BY id_tamu DESC LIMIT 1")->row()->id_tamu;
				
				header('location:'.base_url().'orderdatatamu/index/3?dateIn='.$dateIn.'&dateOut='.$dateOut.'&lamahari='.$lamahari.'&kode_villa='.$kode_villa.'&id_tamu='.$id_tamu);						
			}
			
	}
		
	function hapus()
	{
		$del['id_tamu'] = $this->uri->segment(3);
		$this->app_model->deleteData("tbl_tamu",$del);
		header('location:'.base_url().'tamu');		
	}
	
	

}