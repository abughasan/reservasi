<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Guide extends CI_Controller {

	function index()
	{	
		$page=$this->uri->segment(3);
		$limit=$this->config->item('limit_data');
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		
		$tot_hal = $this->app_model->getAllData("tbl_guide");
		$data['dt_guide'] = $this->app_model->getAllDataLimited("tbl_guide",$limit,$offset);
		$config['base_url'] = base_url() . 'guide/index/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 3;
		$config['first_link'] = 'Awal';
		$config['last_link'] = 'Akhir';
		$config['next_link'] = 'Selanjutnya';
		$config['prev_link'] = 'Sebelumnya';
		$this->pagination->initialize($config);
		$data["paginator"] =$this->pagination->create_links();
		
		$data['guide'] = '';
		$data['interface'] = array('guide');		
		$data['template'] = 'satucolumn';
		$data['komponen_top'] = array('navbar','forcelogin');
		$data['dt_guide'] = $this->app_model->getAllData('tbl_guide');		
		$this->load->view('index',$data);
	}
	
	function tambah()
	{	
		$data['jdl'] = "Tambah";
		$data['kode_guide'] = $this->app_model->getMaxKodeGuide();
		$data['no_ktp'] = "";
		$data['nama_guide'] = "";
		$data['alamat'] = "";		
		$data['no_telp'] = "";		
		$data['sisa_pembayaran'] = "";
		$data['stts_guide'] = "";
		
		$data['stts_input'] = "tambah";
		
		$data['guide'] = '';
		$data['interface'] = array('guide_tambah');					
		$data['template'] = 'satucolumn';
		$data['komponen_top'] = array('navbar','forcelogin');
		$this->load->view('index',$data);
	}
	
	public function edit()
	{
		$id['kode_guide'] = $this->uri->segment(3);
		$detail = $this->app_model->getSelectedData("tbl_guide",$id);
		foreach($detail->result() as $d)
		{
			$data['jdl'] = "Edit";
			$data['kode_guide'] = $d->kode_guide;
			$data['no_ktp'] = $d->no_ktp;
			$data['nama_guide'] = $d->nama_guide;
			$data['alamat'] = $d->alamat;			
			$data['no_telp'] = $d->no_telp;
			$data['sisa_pembayaran'] = $d->sisa_pembayaran;
			$data['stts_guide'] = $d->stts_guide;
			
			$data['stts_input'] = "edit";
		}
		
		$data['guide'] = '';
		$data['interface'] = array('guide_tambah');					
		$data['template'] = 'satucolumn';
		$data['komponen_top'] = array('navbar','forcelogin');
		
		$this->load->view('index',$data);			
	}
	
	
	function simpan_input()
	{
			$st = $this->input->post('stts_input');
			if($st=="tambah")
			{
				$ck['kode_guide'] = $this->input->post('kode_guide');
				$in['kode_guide'] = $this->input->post('kode_guide');
				$in['no_ktp'] = $this->input->post('no_ktp');
				$in['nama_guide'] = $this->input->post('nama_guide');
				$in['alamat'] = $this->input->post('alamat');
				$in['no_telp'] = $this->input->post('no_telp');
				$in['sisa_pembayaran'] = $this->input->post('sisa_pembayaran');
				$in['stts_guide'] = $this->input->post('stts_guide');
				
				$cek = $this->app_model->getSelectedData("tbl_guide",$ck);
				if($cek->num_rows()>0)
				{
					$this->session->set_flashdata('gagal_guide', 'kode_guide telah terdaftar...!!!');					
					header('location:'.base_url().'guide');
				}
				else
				{
					$this->app_model->insertData("tbl_guide",$in);
					redirect('guide');
					?>
						<script>
							//window.parent.location.reload(true);
						</script>
					<?php
				}
			}
			else if($st=="edit")
			{
				if($this->input->post('kode_guide')!="")
				{
					$id['kode_guide'] = $this->input->post('kode_guide');
					$up['no_ktp'] = $this->input->post('no_ktp');
					$up['nama_guide'] = $this->input->post('nama_guide');
					$up['alamat'] = $this->input->post('alamat');
					$up['no_telp'] = $this->input->post('no_telp');
					$up['sisa_pembayaran'] = $this->input->post('sisa_pembayaran');
					$up['stts_guide'] = $this->input->post('stts_guide');
					
					$this->app_model->updateData("tbl_guide",$up,$id);
				}
				else
				{
					$id['kode_guide'] = $this->input->post('kode_guide');					
					$up['no_ktp'] = $this->input->post('no_ktp');
					$up['nama_guide'] = $this->input->post('nama_guide');
					$up['alamat'] = $this->input->post('alamat');
					$up['no_telp'] = $this->input->post('no_telp');
					$up['sisa_pembayaran'] = $this->input->post('sisa_pembayaran');
					$up['stts_guide'] = $this->input->post('stts_guide');
					$this->app_model->updateData("tbl_guide",$up,$id);
				}
					redirect('guide');
				?>
					<script>
						//window.parent.location.reload(true);
					</script>
				<?php
			}
		
	}
	
	
		
	function hapus()
	{
		$del['kode_guide'] = $this->uri->segment(3);
		$this->app_model->deleteData("tbl_guide",$del);
		header('location:'.base_url().'guide');		
	}
	
	function guide_baru_save($noktp,$nama,$alamat,$notelp)
	{
		
		$data['kode_guide']= $this->app_model->getMaxKodeGuide();
		$data['no_ktp']= $noktp;
		$data['nama_guide']=$nama;
		$data['alamat']= $alamat;
		$data['no_telp']= $notelp;
		$data['stts_guide']= 'Oke';
		$this->app_model->insertData('tbl_guide',$data);
		if($this->db->affected_rows() > 0)
		{
			$lastest = $this->app_model->manualQuery('SELECT kode_guide FROM tbl_guide ORDER BY kode_guide DESC LIMIT 1');
			echo $lastest->row()->kode_guide;
		}
	}
	

}