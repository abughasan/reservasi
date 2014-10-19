<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// @ali
//
class Transaksi_cancel extends CI_Controller {

	function index(){		
		
		//definisikan nama table dulu biar mudah copas bikin controller
		$table = 'tbl_transaksi';						
		
		$data['data_cancel'] = $this->db->query("select * from tbl_transaksi 
		where id_status_v = 1
		ORDER BY tgl_transaksi DESC");
		
		//QUERY DETAIL
		$data['detail_transaksi'] = $this->app_model->manualQuery
			("SELECT
				tr.*, tm.*, vl.*, byr.*
			FROM
				tbl_transaksi tr
			left JOIN 
				tbl_tamu tm
				ON tr.id_tamu = tm.id_tamu
			left JOIN 
				tbl_villa vl
				ON tr.kode_villa = vl.kode_villa
			left JOIN 
				tbl_pembayaran byr
				ON tr.no_transaksi = byr.no_transaksi
			WHERE							
				tr.id_status_v = 1
			");		
		
		// $data['interface'] = array('data_transaksi_checkout');		
		$data['template'] = 'satucolumn';
		//cari tahu nama2 kolom di table tsb.
		$data['list_field'] = $this->db->list_fields($table);
		$this->load->view('interface/konten_data_transaksi_cancel',$data);
	}
}