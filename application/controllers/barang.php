<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Barang extends CI_Controller {

	function index()
	{	
		$page=$this->uri->segment(3);
		$limit= 15; //$this->config->item('limit_data');
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		
		$tot_hal = $this->app_model->getAllData("tbl_barang");
		$data['dt_barang'] = $this->app_model->manualQuery
		("  SELECT
				tb.*, vl.*, tk.*
			FROM
				tbl_barang tb
			left JOIN 
				tbl_villa vl
				ON tb.kode_villa = vl.kode_villa
			left JOIN 
				tbl_kamar tk
				ON tb.id_kamar = tk.id_kamar						
		
		",$limit,$offset);
			
		$config['base_url'] = base_url() . 'barang/index/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 3;
		$config['first_link'] = 'Awal';
		$config['last_link'] = 'Akhir';
		$config['next_link'] = 'Selanjutnya';
		$config['prev_link'] = 'Sebelumnya';
		$this->pagination->initialize($config);
		$data["paginator"] =$this->pagination->create_links();
		
		$data['barang'] = '';
		$data['interface'] = array('barang');		
		$data['template'] = 'satucolumn';
		$data['komponen_top'] = array('navbar','forcelogin');		
		$this->load->view('index',$data);
	}
	
	function tambah()
	{	
			$data['jdl'] = "Tambah";		
			$data['kode_barang'] = "";			
			$data['nama_barang'] = "";						
			$data['jumlah_barang'] = "";		
			$data['harga_satuan'] = "";		
			$data['kondisi'] = "";		
			$data['stts_input'] = "tambah";			
			
			$data['barang'] = '';
			$data['villa'] = $this->app_model->getAllData('tbl_villa');
			$data['ruang'] = $this->app_model->getAllData('tbl_kamar');
			$data['interface'] = array('barang_tambah');					
			$data['template'] = 'satucolumn';
			$data['komponen_top'] = array('navbar','forcelogin');
			$this->load->view('index',$data);
	}
	
	public function edit()
	{
		$id['kode_barang'] = $this->uri->segment(3);
		$data['villa'] = $this->app_model->getAllData('tbl_villa');
		$data['ruang'] = $this->app_model->getAllData('tbl_kamar');				
		$detail = $this->app_model->getSelectedData('tbl_barang',$id);
		
		foreach($detail->result() as $d)
		{
			$data['jdl'] = "Edit";			
			$data['kode_barang'] = $d->kode_barang;
			$data['kode_villa'] = $d->kode_villa;			
			$data['id_kamar'] = $d->id_kamar;			
			$data['nama_barang'] = $d->nama_barang;
			$data['jumlah_barang'] = $d->jumlah_barang;			
			$data['harga_satuan'] = $d->harga_satuan;
			$data['kondisi'] = $d->kondisi;
			
			$data['stts_input'] = "edit";
		}
		
		$data['barang'] = '';
		$data['interface'] = array('barang_tambah');					
		$data['template'] = 'satucolumn';
		$data['komponen_top'] = array('navbar','forcelogin');
		
		$this->load->view('index',$data);			
	}
	
	
	function simpan_input()
	{
			$st = $this->input->post('stts_input');			
			if($st=="tambah")
			{
				$ck['kode_barang'] = $this->input->post('kode_barang');				
				//$ck['nama_barang'] = $this->input->post('nama_barang');				
				$in['kode_barang'] = $this->input->post('kode_barang');				
				$in['kode_villa'] = $this->input->post('kode_villa');
				$in['id_kamar'] = $this->input->post('id_kamar');
				$in['nama_barang'] = $this->input->post('nama_barang');
				$in['jumlah_barang'] = $this->input->post('jumlah_barang');
				$in['harga_satuan'] = $this->input->post('harga_satuan');
				$in['kondisi'] = $this->input->post('kondisi');
				
				$cek = $this->app_model->getSelectedData("tbl_barang",$ck);
				if($cek->num_rows()>0)
				{
					$this->session->set_flashdata('gagal_barang', 'sudah terdaftar...!!!');
					//redirect('barang/tambah');
					header('location:'.base_url().'barang/tambah');
				}
				else
				{
					$this->app_model->insertData("tbl_barang",$in);
					redirect('barang');					
				}
			}
			else if($st=="edit")
			{
				$id['kode_barang'] = $this->input->post('kode_barang');					
				$up['kode_villa'] = $this->input->post('kode_villa');
				$up['id_kamar'] = $this->input->post('id_kamar');				
				$up['nama_barang'] = $this->input->post('nama_barang');
				$up['jumlah_barang'] = $this->input->post('jumlah_barang');
				$up['harga_satuan'] = $this->input->post('harga_satuan');
				$up['kondisi'] = $this->input->post('kondisi');
				
				$this->app_model->updateData("tbl_barang",$up,$id);
				Redirect('barang');				
			}
		
	}
		
	function hapus()
	{
		$del['kode_barang'] = $this->uri->segment(3);
		$this->app_model->deleteData("tbl_barang",$del);
		header('location:'.base_url().'barang');		
	}
	
	

}