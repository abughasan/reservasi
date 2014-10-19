<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Komisiguide extends CI_Controller {

	function __construct(){
		parent::__construct();			
	}	

	function index(){		
			
		$data['komponen_top'] = array('navbar','forcelogin');
		$data['template'] = 'satucolumn';
		$data['home'] = '';
		$data['interface'] = array('komisi_guide');
		$data['komisi_guide'] = $this->app_model->komisi_guide();
		$data['total_komisi'] = $this->app_model->total_komisi_guide();
		$data['peringkat'] = $this->app_model->peringkat_komisi_guide();
		$this->load->view('index',$data);
	}
	function bayar_komisi($no_transaksi,$jml_bayar) 
	{
		$d['no_transaksi'] = $no_transaksi;
		$d['pembayaran'] = $jml_bayar;
		$nama_villa = $this->app_model->detail_villa($no_transaksi)->row()->nama_villa;
		$nama_tamu = $this->app_model->detail_tamu($no_transaksi)->row()->nama_tamu;
		$lamahari = $this->app_model->getSelectedData('tbl_transaksi',array('no_transaksi'=>$no_transaksi))->row()->lama_hari;
		$insertData = $this->app_model->insertData('tbl_pembayaran_guide',$d);
		
		#------------------------------------------------
		# PENCATATAN KE APP MYFINNANCE KOMISI GUIDE (8.d & 9.b)
		#------------------------------------------------
		$nomor8d = $this->app_model->manualQuery("
		SELECT MAX(nomor) as nomor
		FROM (`transaksi`)
		WHERE `user` =  '1'
		")->row()->nomor;
		$trans_8d = $this->app_model->manualQuery("
		INSERT INTO `transaksi` (`nomor`, `transaksi`, `user`, `tanggal_catat`, 
		`tanggal_transaksi`, `keterangan`, `buku`, `kredit`, `bridge_transaksi`) 
		VALUES ({$nomor8d}+1, '27', '1', '', NOW(), '#{$no_transaksi} Bayar komisi Guide utk reservasi {$nama_villa} ({$lamahari} malam) oleh {$nama_tamu}', 
		'3', {$jml_bayar}, '{$no_transaksi}')
		");
		$nomor9b = $this->app_model->manualQuery("
		SELECT MAX(nomor) as nomor
		FROM (`transaksi`)
		WHERE `user` =  '1'
		")->row()->nomor;
		$trans_9b = $this->app_model->manualQuery("
		INSERT INTO `transaksi` (`nomor`, `transaksi`, `user`, `tanggal_catat`, 
		`tanggal_transaksi`, `keterangan`, `buku`, `kredit`, `bridge_transaksi`) 
		VALUES ({$nomor9b}+1, '27', '1', '', NOW(), '#{$no_transaksi} Pelunasan Hutang Guide utk reservasi {$nama_villa} ({$lamahari} malam) oleh {$nama_tamu}', 
		'5', {$jml_bayar}, '{$no_transaksi}')
		");
		#------------------------------------------------

		
		if ($this->db->affected_rows() > 0) {
			?><script>
				window.location='<?=base_url()?>komisiguide';
			</script><?php
		} else {
			?><script>
				alert('Pembayaran gagal');
				window.location='<?=base_url()?>komisiguide';
			</script><?php		
		}
	}
	
}

/* End of file komisiguide.php */
/* Location: ./application/controllers/komisiguide.php */