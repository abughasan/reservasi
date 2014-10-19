<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// @ali
//
class Pilih_Tanggal extends CI_Controller {

	function index(){
		//definisikan nama table dulu biar mudah copas bikin controller
		$data['pilih_tanggal'] = '';
		$data['interface'] = array('pilih_tanggal');		
		$data['template'] = 'satucolumn';
		$data['komponen_top'] = array('navbar','forcelogin');
		//$data['dt_villa'] = $this->app_model->getAllData($table);
		//cari tahu nama2 kolom di table tsb.
		//$data['list_field'] = $this->db->list_fields($table);
				
		$data['user'] = $this->session->userdata('nama_pengguna');			
		$this->load->view('index',$data);
	}
	
	function checkin($notransaksi) {		
		$tgl_cekin = date("Y-m-d");
		$this->app_model->updateData('tbl_transaksi',array('tgl_cekin'=>$tgl_cekin),array('no_transaksi'=>$notransaksi));
		echo "<meta http-equiv=\"refresh\" content=\"0;url=".$_SERVER['HTTP_REFERER']."\"/>";
	}
	
	function checkout($notransaksi) {		
		$tgl_cekin = date("Y-m-d");
		$this->app_model->updateData('tbl_transaksi',array('tgl_cekout'=>$tgl_cekin),array('no_transaksi'=>$notransaksi));
		echo "<meta http-equiv=\"refresh\" content=\"0;url=".$_SERVER['HTTP_REFERER']."\"/>";
	}

}