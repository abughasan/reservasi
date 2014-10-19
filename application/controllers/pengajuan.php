<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// @ali
//
class Pengajuan extends CI_Controller {

	function index(){
	
		//definisikan nama table dulu biar mudah copas bikin controller
		$table = 'tbl_pengajuan_barang';
					
		$data['dt_rusak'] = $this->db->query("select * from tbl_pengajuan_barang
		where id_status_p = 1
		ORDER BY tgl_pengajuan DESC ");	
		
		
		$data['interface'] = array('data_pengajuan');		
		$data['template'] = 'satucolumn';
		$data['komponen_top'] = array('navbar','forcelogin');
		//cari tahu nama2 kolom di table tsb.
		$data['list_field'] = $this->db->list_fields($table);
		$this->load->view('index',$data);
	}
	
	function view(){
		
		$table = 'tbl_transaksi';
					
		$data['dt_rusak'] = $this->app_model->manualQuery("
			SELECT
				tp.*, tb.*, ts.penyebab
			FROM
				tbl_pengajuan_barang tp
			left JOIN 
				tbl_barang tb
				ON tp.kode_barang = tb.kode_barang			
			left JOIN 
				tbl_sebab ts
				ON ts.id_sebab = tp.id_sebab				
			Where tp.id_status_p = 1	
			ORDER BY tgl_pengajuan DESC
		");	
		
		$data['interface'] = array('data_pengajuan');		
		$data['template'] = 'satucolumn';
		// $data['komponen_top'] = array('navbar','forcelogin');
		//cari tahu nama2 kolom di table tsb.
		$data['list_field'] = $this->db->list_fields($table);
		$this->load->view('interface/konten_data_pengajuan_add',$data);
	}	
	
	function tambah(){
		$data['jdl'] = "Tambah";		
		$data['tgl_pengajuan'] = "";			
		$data['kode_barang'] = "";						
		$data['nama_villa'] = "";						
		$data['nama_kamar'] = "";								
		$data['jml'] = "";				
		$data['kondisi_b'] = "";		
		$data['id_sebab'] = "";			
		
		$data['stts_input'] = "tambah";			
		
		$data['barang'] = $this->app_model->manualQuery('select * from tbl_barang where jumlah_barang > 0');
		$data['villa'] = $this->app_model->getAllData('tbl_villa');
		$data['ruang'] = $this->app_model->getAllData('tbl_kamar');
		$data['sebab'] = $this->app_model->getAllData('tbl_sebab');		
		$data['interface'] = array('pengajuan_tambah');					
		$data['template'] = 'satucolumn';
		$data['komponen_top'] = array('navbar','forcelogin');
		$this->load->view('index',$data);
	}
	
	public function edit()
	{
		$id['id_pengajuan'] = $this->uri->segment(3);
		$data['barang'] = $this->app_model->manualQuery('select * from tbl_barang where jumlah_barang > 0');
		//$data['villa'] = $this->app_model->getAllData('tbl_villa');
		//$data['ruang'] = $this->app_model->getAllData('tbl_kamar');
		//$data['sebab'] = $this->app_model->getAllData('tbl_sebab');		
		$detail = $this->app_model->getSelectedData('tbl_pengajuan_barang',$id);
		
		foreach($detail->result() as $d)
		{
			$data['jdl'] = "Edit";			
			$data['kode_barang'] = $d->kode_barang;
			$data['jml'] = $d->jml;			
			$data['kondisi_b'] = $d->kondisi_b;			
			$data['id_sebab'] = $d->id_sebab;
			$data['id_status_p'] = $d->id_status_p;
			
			$data['stts_input'] = "edit";
		}
		
		//$data['barang'] = '';
		$data['interface'] = array('pengajuan_edit');					
		$data['template'] = 'satucolumn';
		$data['komponen_top'] = array('navbar','forcelogin');
		
		$this->load->view('index',$data);			
	}
	
	function simpan_input()
	{
			$st = $this->input->post('stts_input');			
			if($st=="tambah")
			{
				$ck['id_pengajuan'] = $this->input->post('id_pengajuan');				
				//$ck['nama_barang'] = $this->input->post('nama_barang');				
				$in['kode_barang'] = $this->input->post('kode_barang');				
				$in['jml'] = $this->input->post('jml');
				$in['kondisi_b'] = $this->input->post('kondisi_b');
				$in['id_sebab'] = $this->input->post('id_sebab');				
				$in['id_status_p'] = $this->input->post('id_status_p');
				
				$cek = $this->app_model->getSelectedData("tbl_pengajuan_barang",$ck);
				if($cek->num_rows()>0)
				{
					$this->session->set_flashdata('gagal_barang', 'sudah terdaftar...!!!');
					//redirect('barang/tambah');
					header('location:'.base_url().'pengajuan/tambah');
				}
				else
				{
					$this->app_model->insertData("tbl_pengajuan_barang",$in);
					
					$kon['kode_barang'] = $this->input->post('kode_barang');
					$key['kode_barang'] = $this->input->post('kode_barang');				
					$un['jumlah_barang'] = $this->app_model->getSelectedData('tbl_barang',$kon)->row()->jumlah_barang - $this->input->post('jml');
					$this->app_model->updateData("tbl_barang",$un,$key);
					
					redirect('pengajuan');					
				}
			}
			else if($st=="edit")
			{
				$id['kode_barang'] = $this->input->post('kode_barang');				
				$up['jml'] = $this->input->post('jml');
				$up['kondisi_b'] = $this->input->post('kondisi_b');
				$up['id_sebab'] = $this->input->post('id_sebab');				
				$up['id_status_p'] = $this->input->post('id_status_p');
				
				$this->app_model->updateData("tbl_barang",$up,$id);
				Redirect('barang');				
			}
		
	}
	
	public function ambil_data_barang_ajax()
	{
		$data["kode_barang"] = $_GET["kode_barang"];
		$sess_data['kd_barang'] = $data["kode_barang"];
		$this->session->set_userdata($sess_data);
		$q = $this->app_model->getSelectedData("tbl_barang",$data);
		foreach($q->result() as $d)
		{
		?>
			<div class="form-group">
				<label  class="col-md-2 control-label">Villa</label>
				<div class="col-md-3 input-group">										
					<input type="text" name="kode_villa" value="<?php echo $d->kode_villa; ?>" class='form-control' readonly="true">
				</div>
			</div>
			
			<div class="form-group">
				<label  class="col-md-2 control-label">Kamar/Ruang</label>
				<div class="col-md-3 input-group">										
					<input type="text" name="id_kamar" value="<?php echo $d->id_kamar; ?>" class='form-control' readonly="true">
				</div>
			</div>
			
			<div class="form-group">
				<label  class="col-md-2 control-label">Nama barang</label>
				<div class="col-md-3 input-group">										
					<input type="text" name="nama_barang" value="<?php echo $d->nama_barang; ?>" class='form-control' readonly="true">
				</div>
			</div>
			
			<div class="form-group">
				<label  class="col-md-2 control-label">Jumlah</label>
				<div class="col-md-1 input-group">																
					<input type="number" name="jml" value="<?php echo $d->jumlah_barang; ?>" class='form-control'>	
				</div>
			</div>			
		<?php
		}				
	}
	
	public function ambil_data_barang_session()
	{
		if($this->session->userdata("kd_barang")!== "")
			{
				$data["kode_barang"] = $this->session->userdata("kd_barang");
				$q = $this->app_model->getSelectedData("tbl_barang",$data);
				foreach($q->result() as $d)
				{
					$kode_villa = $d->kode_villa;
					$id_kamar = $d->id_kamar;
					$nama_barang = $d->nama_barang;
					$jumlah_barang = $d->jumlah_barang;
				}
			}
			else
			{
				$kode_villa = "";
				$id_kamar = "";
				$nama_barang = "";
				$jumlah_barang = "";
			}
			
			?>
			<div class="form-group">
				<label  class="col-md-2 control-label">Villa</label>
				<div class="col-md-3 input-group">										
					<input type="text" name="kode_villa" value="<?php echo $d->kode_villa; ?>" class='form-control' readonly="true">
				</div>
			</div>
			
			<div class="form-group">
				<label  class="col-md-2 control-label">Kamar/Ruang</label>
				<div class="col-md-3 input-group">										
					<input type="text"  name="id_kamar" value="<?php echo $d->id_kamar; ?>" class='form-control' readonly="true">
				</div>
			</div>
			
			<div class="form-group">
				<label  class="col-md-2 control-label">Nama barang</label>
				<div class="col-md-3 input-group">										
					<input type="text" name="nama_barang" value="<?php echo $d->nama_barang; ?>" class='form-control' readonly="true">
				</div>
			</div>
			
			<div class="form-group">
				<label  class="col-md-2 control-label">Jumlah</label>
				<div class="col-md-1 input-group">																
					<input type="number" name="jml" value="<?php echo $d->jumlah_barang; ?>" class='form-control'>	
				</div>
			</div>			
			<?php				
	}
		
	function update($ajuval,$jml,$kdbrng,$id_pengajuan) 
	{
		//echo $ajuval."->".$id_pengajuan;
				
		$this->app_model->manualQuery("
		UPDATE tbl_pengajuan_barang
		SET id_status_p = '".$ajuval."', tgl_ganti = NOW()
		WHERE id_pengajuan = '".$id_pengajuan."'
		");	
		
		$jml_barang = $this->app_model->getSelectedData('tbl_barang',array('kode_barang'=>$kdbrng))->row()->jumlah_barang;
		
		$this->app_model->manualQuery("
		UPDATE tbl_barang
		SET jumlah_barang = {$jml_barang} + ".$jml."
		WHERE kode_barang = '".$kdbrng."'
		");	
	
	}
	
	function updatejml($jml,$id_pengajuan){
		$this->app_model->manualQuery("
		UPDATE tbl_pengajuan_barang
		SET jml = '".$jml."'
		WHERE id_pengajuan = '".$id_pengajuan."'		
		");
	}
		
	function hapus()
	{
		$del['id_pengajuan'] = $this->uri->segment(3);
		$this->app_model->deleteData("tbl_pengajuan_barang",$del);
		header('location:'.base_url().'pengajuan');		
	} 
	

}	