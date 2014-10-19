<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// @ali
//
class Pengajuan_ganti extends CI_Controller {

	function index(){
	
		//definisikan nama table dulu biar mudah copas bikin controller
		$table = 'tbl_pengajuan_barang';
					
		$data['dt_ganti'] = $this->app_model->manualQuery("
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
			Where tp.id_status_p = 2	
			ORDER BY tgl_ganti, tgl_pengajuan DESC
		");	
				
		$data['interface'] = array('data_pengajuan');		
		$data['template'] = 'satucolumn';
		// $data['komponen_top'] = array('navbar','forcelogin');
		//cari tahu nama2 kolom di table tsb.
		$data['list_field'] = $this->db->list_fields($table);
		$this->load->view('interface/konten_data_pengajuan_ganti',$data);
	}
	

}	