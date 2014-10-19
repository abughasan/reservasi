<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Villa extends CI_Controller {

	function index()
	{	
		$page=$this->uri->segment(3);
		$limit=$this->config->item('limit_data');
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		
		$tot_hal = $this->app_model->getAllData("tbl_villa");
		$data['dt_villa'] = $this->app_model->getAllDataLimited("tbl_villa",$limit,$offset);
		$config['base_url'] = base_url() . 'villa/index/';
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 3;
		$config['first_link'] = 'Awal';
		$config['last_link'] = 'Akhir';
		$config['next_link'] = 'Selanjutnya';
		$config['prev_link'] = 'Sebelumnya';
		$this->pagination->initialize($config);
		$data["paginator"] =$this->pagination->create_links();
		
		$data['villa'] = '';
		$data['interface'] = array('villa');		
		$data['template'] = 'satucolumn';
		$data['komponen_top'] = array('navbar','forcelogin');
		$data['dt_villa'] = $this->app_model->getAllData('tbl_villa');		
				
		$this->load->view('index',$data);
	}
	
	function tambah()
	{	
			$data['jdl'] = "Tambah";
			$data['kode_villa'] = $this->app_model->getMaxKodeVilla();
			$data['nama_villa'] = "";
			$data['tarif_villa'] = "";
			$data['diskon_villa'] = "";
			$data['url'] = "";
			
			$data['stts_input'] = "tambah";
			
			$data['villa'] = '';
			$data['interface'] = array('villa_tambah');					
			$data['template'] = 'satucolumn';
			$data['komponen_top'] = array('navbar','forcelogin');
			
			$this->load->view('index',$data);
	}
	
	public function edit()
	{
		$id['kode_villa'] = $this->uri->segment(3);
		$detail = $this->app_model->getSelectedData("tbl_villa",$id);
		foreach($detail->result() as $d)
		{
			$data['jdl'] = "Edit";
			$data['kode_villa'] = $d->kode_villa;
			$data['nama_villa'] = $d->nama_villa;
			$data['tarif_villa'] = $d->tarif_villa;
			$data['diskon_villa'] = $d->diskon;
			$data['url'] = $d->url;
			
			$data['stts_input'] = "edit";
		}
		
		$data['villa'] = '';
		$data['interface'] = array('villa_tambah');					
		$data['template'] = 'satucolumn';
		$data['komponen_top'] = array('navbar','forcelogin');
		
		$this->load->view('index',$data);			
	}
	
	
	function simpan_input()
	{
			$st = $this->input->post('stts_input');
			if($st=="tambah")
			{
				$ck['kode_villa'] = $this->input->post('kode_villa');								
				$cek = $this->app_model->getSelectedData("tbl_villa",$ck);
				if($cek->num_rows()>0)
				{
					$this->session->set_flashdata('gagal_villa', 'kode_villa telah terdaftar...!!!');					
					$this->tambah();
					//header('location:'.base_url().'villa');
				}
				else
				{
					$config['upload_path'] = './upload/';
					$config['allowed_types']= 'gif|jpg|png|jpeg';
					$config['encrypt_name']	= FALSE;
					$config['remove_spaces']	= TRUE;	
					//$config['max_size']     = '10000';
					$config['max_width']  	= '3000';
					$config['max_height']  	= '3000';
			 
					$this->load->library('upload', $config);
	 
					if ($this->upload->do_upload("userfile")) {
						$data = $this->upload->data();
			 
						/* PATH */
						$source             = "./upload/".$data['file_name'] ;
						$destination_thumb	= "./upload/thumb/" ;
						$destination_medium	= "./upload/medium/" ;
			 
						// Permission Configuration
						chmod($source, 0777) ;
			 
						/* Resizing Processing */
						// Configuration Of Image Manipulation :: Static
						$this->load->library('image_lib') ;
						$img['image_library'] = 'GD2';
						$img['create_thumb']  = TRUE;
						$img['maintain_ratio']= TRUE;
			 
						/// Limit Width Resize
						$limit_medium   = 600 ;
						$limit_thumb    = 300 ;
			 
						// Size Image Limit was using (LIMIT TOP)
						$limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;
			 
						// Percentase Resize
						if ($limit_use > $limit_thumb) {
							$percent_medium = $limit_medium/$limit_use ;
							$percent_thumb  = $limit_thumb/$limit_use ;
						}
			 
						//// Making THUMBNAIL ///////
						$img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
						$img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;
			 
						// Configuration Of Image Manipulation :: Dynamic
						$img['thumb_marker'] = '';
						$img['quality']      = '100%' ;
						$img['source_image'] = $source ;
						$img['new_image']    = $destination_thumb ;
			 
						// Do Resizing
						$this->image_lib->initialize($img);
						$this->image_lib->resize();
						$this->image_lib->clear() ;
	 
						////// Making MEDIUM /////////////
						$img['width']   = $limit_use > $limit_medium ?  $data['image_width'] * $percent_medium : $data['image_width'] ;
						$img['height']  = $limit_use > $limit_medium ?  $data['image_height'] * $percent_medium : $data['image_height'] ;
			 
						// Configuration Of Image Manipulation :: Dynamic
						$img['thumb_marker'] = '';
						$img['quality']      = '100%' ;
						$img['source_image'] = $source ;
						$img['new_image']    = $destination_medium ;
			 
						// Do Resizing
						$this->image_lib->initialize($img);
						$this->image_lib->resize();
						$this->image_lib->clear() ;				
					
						$in['url'] = $data['file_name'];		
						$in['kode_villa'] = $this->input->post('kode_villa');
						$in['nama_villa'] = $this->input->post('nama_villa');
						$in['tarif_villa'] = $this->input->post('tarif_villa');
					
						$this->app_model->insertData("tbl_villa",$in);
						unlink($source);
						redirect("villa");
						
					}
					else 
					{
						echo $this->upload->display_errors('<p>','</p>');
					}						
				}	
			}
			else if($st=="edit")
			{
				if(empty($_FILES['userfile']['name']))
				{				
					$id['kode_villa'] = $this->input->post('kode_villa');
					$up['nama_villa'] = $this->input->post('nama_villa');
					$up['tarif_villa'] = $this->input->post('tarif_villa');		
					$up['diskon'] = $this->input->post('diskon_villa')/100;		
					
					$this->app_model->updateData("tbl_villa",$up,$id);
					redirect('villa');
				}
				else
				{
					$config['upload_path'] = './upload/';
					$config['allowed_types']= 'gif|jpg|png|jpeg';
					$config['encrypt_name']	= FALSE;
					$config['remove_spaces'] = TRUE;	
					//$config['max_size']     = '3000';
					$config['max_width']  	= '3000';
					$config['max_height']  	= '3000';
			 
					$this->load->library('upload', $config);
	 
					if ($this->upload->do_upload("userfile")) 
					{
						$data	 	= $this->upload->data();
			 
						/* PATH */
						$source             = "./upload/".$data['file_name'] ;
						$destination_thumb	= "./upload/thumb/" ;
						$destination_medium	= "./upload/medium/" ;
			 
						// Permission Configuration
						chmod($source, 0777) ;
			 
						/* Resizing Processing */
						// Configuration Of Image Manipulation :: Static
						$this->load->library('image_lib') ;
						$img['image_library'] = 'GD2';
						$img['create_thumb']  = TRUE;
						$img['maintain_ratio']= TRUE;
			 
						/// Limit Width Resize
						$limit_medium   = 600 ;
						$limit_thumb    = 300 ;
			 
						// Size Image Limit was using (LIMIT TOP)
						$limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;
			 
						// Percentase Resize
						if ($limit_use > $limit_thumb) {
							$percent_medium = $limit_medium/$limit_use ;
							$percent_thumb  = $limit_thumb/$limit_use ;
						}
			 
						//// Making THUMBNAIL ///////
						$img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
						$img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;
			 
						// Configuration Of Image Manipulation :: Dynamic
						$img['thumb_marker'] = '';
						$img['quality']      = '100%' ;
						$img['source_image'] = $source ;
						$img['new_image']    = $destination_thumb ;
			 
						// Do Resizing
						$this->image_lib->initialize($img);
						$this->image_lib->resize();
						$this->image_lib->clear() ;
	 
						////// Making MEDIUM /////////////
						$img['width']   = $limit_use > $limit_medium ?  $data['image_width'] * $percent_medium : $data['image_width'] ;
						$img['height']  = $limit_use > $limit_medium ?  $data['image_height'] * $percent_medium : $data['image_height'] ;
			 
						// Configuration Of Image Manipulation :: Dynamic
						$img['thumb_marker'] = '';
						$img['quality']      = '100%' ;
						$img['source_image'] = $source ;
						$img['new_image']    = $destination_medium ;
			 
						// Do Resizing
						$this->image_lib->initialize($img);
						$this->image_lib->resize();
						$this->image_lib->clear() ;
						
						$up['url'] = $data['file_name'];
						$id['kode_villa'] = $this->input->post('kode_villa');
						$up['nama_villa'] = $this->input->post('nama_villa');
						$up['tarif_villa'] = $this->input->post('tarif_villa');				
						$this->app_model->updateData("tbl_villa",$up,$id);
				
						$old_thumb	= "./upload/thumb/".$this->input->post("url")."" ;
						$old_medium	= "./upload/medium/".$this->input->post("url")."" ;
						unlink($source);
						unlink($old_thumb);
						unlink($old_medium);
												
						redirect("villa");
					}
					else 
					{
						echo $this->upload->display_errors('<p>','</p>');
					}
				}					
			}
			
	}
		
	function hapus()
	{
		$del['kode_villa'] = $this->uri->segment(3);
		$this->app_model->deleteData("tbl_villa",$del);		
		header('location:'.base_url().'villa');		
	}
	
	

}