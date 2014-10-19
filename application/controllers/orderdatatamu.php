<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orderdatatamu extends CI_Controller {

	function index() 
	{
		$data['interface'] = array('inforeservasi');		
		$data['template'] = 'satucolumn';
		$data['komponen_top'] = array('navbar','forcelogin');
		$data['villa_booked'] = $this->app_model->getSelectedData('tbl_villa',array('kode_villa'=>$_GET['kode_villa']))->row();
		$data['tamu'] = $this->app_model->getSelectedData('tbl_tamu',array('id_tamu'=>$_GET['id_tamu']))->row();
		$data['guide'] = $this->app_model->getAllData('tbl_guide')->result();
		$this->load->view('index',$data);
	}
	function submit_trans()
	{
		$no_transaksi = $this->app_model->getkodetransaksi();
		$id_tamu = $_GET['id_tamu'];
		$nama_tamu = $this->app_model->getSelectedData('tbl_tamu',array('id_tamu'=>$id_tamu))->row()->nama_tamu;
		$kode_villa = $_GET['kode_villa'];
		$nama_villa = $this->app_model->getSelectedData('tbl_villa',array('kode_villa'=>$kode_villa))->row()->nama_villa;
		$dateIn = $_GET['dateIn'];
		$dateOut = $_GET['dateOut'];
		$lamahari = $_GET['lamahari'];
		$totalbayar = $_GET['totalbayar'];
		$jumlahbayar = $_GET['jumlahbayar'];
		$sisabayar = $totalbayar - $_GET['jumlahbayar'];
		$kode_guide = $_GET['kode_guide'];
		$komisi_guide = $_GET['komisi_guide'];
		$diskon = $_GET['diskon'];
		$id_status_v = 2;
		
		#------------------------------------------------
		# PENCATATAN KE APP MYFINNANCE BAYAR LUNAS (6.a)
		#------------------------------------------------
		if ($totalbayar == $jumlahbayar) :
		$nomor = $this->app_model->manualQuery("
		SELECT MAX(nomor) as nomor
		FROM (`transaksi`)
		WHERE `user` =  '1'
		")->row()->nomor;
		$bayarlunas_6a = $this->app_model->manualQuery("
		INSERT INTO `transaksi` (`nomor`, `transaksi`, `user`, `tanggal_catat`, 
		`tanggal_transaksi`, `keterangan`, `buku`, `debet`, `bridge_transaksi`) 
		VALUES ({$nomor}+1, '3', '1', '', NOW(), '#{$no_transaksi} Pembayaran {$nama_villa} ({$lamahari} malam) oleh {$nama_tamu}', 
		'1', '{$jumlahbayar}', '{$no_transaksi}')
		");
		else:
		#------------------------------------------------
		# PENCATATAN KE APP MYFINNANCE BAYAR CICIL (6.d & 10.a)
		#------------------------------------------------
		# CATAT DP
		$nomor6d = $this->app_model->manualQuery("
		SELECT MAX(nomor) as nomor
		FROM (`transaksi`)
		WHERE `user` =  '1'
		")->row()->nomor;
		$trans_6d = $this->app_model->manualQuery("
		INSERT INTO `transaksi` (`nomor`, `transaksi`, `user`, `tanggal_catat`, 
		`tanggal_transaksi`, `keterangan`, `buku`, `debet`, `bridge_transaksi`) 
		VALUES ({$nomor6d}+1, '31', '1', '', NOW(), '#{$no_transaksi} Uang Muka {$nama_villa} ({$lamahari} malam) oleh {$nama_tamu}', 
		'1', '{$jumlahbayar}', '{$no_transaksi}')
		");
		# CATAT PIUTANG
		$nomor10a = $this->app_model->manualQuery("
		SELECT MAX(nomor) as nomor
		FROM (`transaksi`)
		WHERE `user` =  '1'
		")->row()->nomor;
		$trans_10a = $this->app_model->manualQuery("
		INSERT INTO `transaksi` (`nomor`, `transaksi`, `user`, `tanggal_catat`, 
		`tanggal_transaksi`, `keterangan`, `buku`, `debet`, `bridge_transaksi`) 
		VALUES ({$nomor10a}+1, '28', '1', '', NOW(), '#{$no_transaksi} Piutang sewa {$nama_villa} ({$lamahari} malam) oleh {$nama_tamu}', 
		'4', '{$sisabayar}', '{$no_transaksi}')
		");
		endif;
		#------------------------------------------------
		
		#------------------------------------------------
		# PENCATATAN KE APP MYFINNANCE HUTANG GUIDE (9.a)
		#------------------------------------------------
		$nomor9a = $this->app_model->manualQuery("
		SELECT MAX(nomor) as nomor
		FROM (`transaksi`)
		WHERE `user` =  '1'
		")->row()->nomor;
		$hutangkeguide_9a = $this->app_model->manualQuery("
		INSERT INTO `transaksi` (`nomor`, `transaksi`, `user`, `tanggal_catat`, 
		`tanggal_transaksi`, `keterangan`, `buku`, `debet`, `bridge_transaksi`) 
		VALUES ({$nomor9a}+1, '26', '1', '', NOW(), '#{$no_transaksi} Hutang Guide utk reservasi {$nama_villa} ({$lamahari} malam) oleh {$nama_tamu}', 
		'5', {$totalbayar}*{$komisi_guide}, '{$no_transaksi}')
		");
		#------------------------------------------------
		
		$this->app_model->manualQuery("
			INSERT INTO tbl_transaksi (no_transaksi,tgl_transaksi,id_tamu,kode_villa,tgl_cekin,tgl_cekout,lama_hari,dapat_harga,kode_guide,komisi_guide,id_status_v,dapat_diskon) 
				VALUES ('$no_transaksi',NOW(),'$id_tamu','$kode_villa','$dateIn','$dateOut','$lamahari','$totalbayar','$kode_guide','$komisi_guide','$id_status_v','$diskon')
		");
		
		
		$this->app_model->insertData('tbl_pembayaran_guide',array('no_transaksi'=>$no_transaksi)); #insert data pembayaran guide
		
		$this->app_model->manualQuery("
			INSERT INTO tbl_pembayaran (no_transaksi,tgl_bayar,jml_bayar) 
				VALUES ('$no_transaksi',NOW(),'$jumlahbayar');
		");
		
		if ($this->db->affected_rows() > 0) {echo base_url().'transaksi' ;} else {}
	}
	function invoice($no_transaksi)
	{
		$data['inv'] = $this->app_model->getSelectedData('tbl_transaksi',array('no_transaksi'=>$no_transaksi))->row();
		$data['komponen_top'] = array('nav-print','sample-invoice');
		$this->load->view('index',$data);
	}
}