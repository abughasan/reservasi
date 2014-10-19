<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_barang extends CI_Controller {


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
		
		
		if($this->session->userdata('kode_villa') == "")
		{
			$data['dt_barang'] = $this->app_model->manualQuery
			("SELECT
					vl.*, tk.*, tb.*
				FROM
					tbl_barang tb
				left JOIN 
					tbl_villa vl
					ON tb.kode_villa = vl.kode_villa
				left JOIN 
					tbl_kamar tk
					ON tb.id_kamar = tk.id_kamar							
			",$limit,$offset);
				
			
			$data['villa'] = $this->app_model->getAllData('tbl_villa');
			$data['ruang'] = $this->app_model->getAllData('tbl_kamar');
			
			$data['barang'] = '';
			$data['interface'] = array('lap_barang');		
			$data['template'] = 'satucolumn';
			$data['komponen_top'] = array('navbar','forcelogin');		
			$this->load->view('index',$data);
		}
		else
		{
			$set_lap2['kode_villa'] = $this->session->userdata('kode_villa');						
			$set_lap2['id_kamar'] = $this->session->userdata('id_kamar');						
			$data['dt_barang'] = $this->app_model->manualQuery
			("SELECT
					vl.*, tk.*, tb.*
				FROM
					tbl_barang tb
				left JOIN 
					tbl_villa vl
					ON tb.kode_villa = vl.kode_villa
				left JOIN 
					tbl_kamar tk
					ON tb.id_kamar = tk.id_kamar			
				WHERE 
					tb.kode_villa='".$set_lap2['kode_villa']."' and	
					tk.id_kamar='".$set_lap2['id_kamar']."'
			",$limit,$offset);
							
			$data['villa'] = $this->app_model->getAllData('tbl_villa');
			$data['ruang'] = $this->app_model->getAllData('tbl_kamar');
			
			$data['barang'] = '';
			$data['interface'] = array('lap_barang');		
			$data['template'] = 'satucolumn';
			$data['komponen_top'] = array('navbar','forcelogin');		
			$this->load->view('index',$data);	
		}
	}
	
	public function cetak()
	{	
		$page=$this->uri->segment(3);
		$limit= 25; //$this->config->item('limit_data');
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		
		$tot_hal = $this->app_model->getAllData("tbl_barang");
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
		
		
		if($this->session->userdata('kode_villa') == "")
		{
			$data['dt_barang'] = $this->app_model->manualQuery
			("SELECT
					vl.*, tk.*, tb.*
				FROM
					tbl_barang tb
				left JOIN 
					tbl_villa vl
					ON tb.kode_villa = vl.kode_villa
				left JOIN 
					tbl_kamar tk
					ON tb.id_kamar = tk.id_kamar							
			",$limit,$offset);
				
			
			$data['villa'] = $this->app_model->getAllData('tbl_villa');
			$data['ruang'] = $this->app_model->getAllData('tbl_kamar');
			
			$data['barang'] = '';
			$data['interface'] = array('lap_barang');		
			$data['template'] = 'satucolumn';
			$data['komponen_top'] = array('nav-print','kwitansi');
			$this->load->view('index',$data);
		}
		else
		{
			$set_lap2['kode_villa'] = $this->session->userdata('kode_villa');						
			$set_lap2['id_kamar'] = $this->session->userdata('id_kamar');						
			$data['dt_barang'] = $this->app_model->manualQuery
			("SELECT
					vl.*, tk.*, tb.*
				FROM
					tbl_barang tb
				left JOIN 
					tbl_villa vl
					ON tb.kode_villa = vl.kode_villa
				left JOIN 
					tbl_kamar tk
					ON tb.id_kamar = tk.id_kamar			
				WHERE 
					tb.kode_villa='".$set_lap2['kode_villa']."' and	
					tk.id_kamar='".$set_lap2['id_kamar']."'
			",$limit,$offset);
							
			$data['villa'] = $this->app_model->getAllData('tbl_villa');
			$data['ruang'] = $this->app_model->getAllData('tbl_kamar');
			
			$data['barang'] = '';
			//$data['interface'] = array('lap_barang');		
			$data['template'] = 'satucolumn';
			$data['komponen_top'] = array('nav-print','lap_barang');
			$this->load->view('index',$data);	
		}
	}
		
	public function set()
	{
		$set_lap1['kode_villa'] = $this->input->post('kode_villa');
		$set_lap1['id_kamar'] = $this->input->post('id_kamar');
		
		$this->session->set_userdata($set_lap1);
		header('location:'.base_url().'laporan_barang');		
	}
	
}

/* End of file laporan_pegawai_unit_satuan.php */
/* Location: ./application/controllers/laporan_pegawai_unit_satuan.php */