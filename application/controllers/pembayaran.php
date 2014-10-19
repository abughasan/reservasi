<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// @ali
//
class Pembayaran extends CI_Controller {

	function index () 
	{
		$data['interface'] = array('pembayaran');		
		$data['template'] = 'satucolumn';
		$data['komponen_top'] = array('navbar','forcelogin');
		
		//--
		$data['trans'] = $this->app_model->getAllData('tbl_transaksi');
		$data['tunpaid'] = $this->app_model->manualQuery("
			SELECT DISTINCT(tp.no_transaksi) notrans FROM tbl_transaksi tt
			INNER JOIN tbl_pembayaran tp ON tt.no_transaksi = tp.no_transaksi
			WHERE tp.status_bayar = ''
		");
		$data['paid'] = $this->app_model->manualQuery("
			SELECT DISTINCT(tp.no_transaksi) notrans FROM tbl_transaksi tt
			INNER JOIN tbl_pembayaran tp ON tt.no_transaksi = tp.no_transaksi
			WHERE tp.status_bayar = 1
		");
		
		$this->load->view('index',$data);
	}
	
	public function bayar($no_transaksi){
		
		$table = 'tbl_pembayaran';
		$data['no_transaksi'] = $no_transaksi;
		$getno = $this->session->set_userdata('no_transaksi');
		$data['getno'] = $getno;
		
		//$data['transaksi'] = $this->app_model->getAllData('tbl_transaksi');
		//$data['bayar_cicil'] = $this->app_model->getSelectedData(tbl_pembayaran,$filter)->row();
		//$data['test'] = $this->app_model->selectdetail($id);
		
		$data['bayar'] = '';
		$data['interface'] = array('transaksi_bayar');		
		$data['template'] = 'satucolumn';
		$data['komponen_top'] = array('navbar','forcelogin');
		$data['list_field'] = $this->db->list_fields($table); 
		$data['dttrans'] = $this->app_model->getSelectedData('tbl_pembayaran',array('no_transaksi'=>$no_transaksi))->result();
		$data['totalbayar'] = $this->app_model->manualQuery("
			SELECT SUM(jml_bayar) total FROM tbl_pembayaran 
			WHERE no_transaksi = '{$no_transaksi}'
		")->row()->total;
		$harusbayar = $this->app_model->getSelectedData('tbl_transaksi',array('no_transaksi'=>$no_transaksi))->row()->dapat_harga;
		$denda = $this->app_model->getSelectedData('tbl_transaksi',array('no_transaksi'=>$no_transaksi))->row()->dapat_denda;
		$data['sisabayar_denda'] = ($harusbayar+$denda) - $data['totalbayar'];
		$data['sisabayar'] = ($harusbayar) - $data['totalbayar'];
		if ($data['sisabayar_denda']<=0):
			$this->app_model->updateData('tbl_pembayaran',array('status_bayar'=>1),array('no_transaksi'=>$no_transaksi));
		endif;
		$this->load->view('index',$data);
		
	}
	function tambahbayar($no_transaksi)
	{
		$jml_bayar = $this->input->post('jml_bayar');
		$nama_villa = $this->app_model->detail_villa($no_transaksi)->row()->nama_villa;
		$nama_tamu = $this->app_model->detail_tamu($no_transaksi)->row()->nama_tamu;
		$lamahari = $this->app_model->getSelectedData('tbl_transaksi',array('no_transaksi'=>$no_transaksi))->row()->lama_hari;
		$totalbayar = $this->app_model->manualQuery("
			SELECT SUM(jml_bayar) total FROM tbl_pembayaran 
			WHERE no_transaksi = '{$no_transaksi}'
		")->row()->total;
		$harusbayar = $this->app_model->getSelectedData('tbl_transaksi',array('no_transaksi'=>$no_transaksi))->row()->dapat_harga;
		$denda = $this->app_model->getSelectedData('tbl_transaksi',array('no_transaksi'=>$no_transaksi))->row()->dapat_denda;
		$sisabayar = ($harusbayar+$denda) - $totalbayar;
		
		if ($sisabayar<=$jml_bayar):
			$status_bayar = 1;
			$last = "terakhir ";
		else:
			$status_bayar = "";
			$last = "";
		endif;
		
		$this->app_model->manualQuery("
			INSERT INTO tbl_pembayaran (no_transaksi,tgl_bayar,jml_bayar,status_bayar) 
				VALUES ('$no_transaksi',NOW(),'$jml_bayar','$status_bayar')
		");
		
		#------------------------------------------------
		# PENCATATAN KE APP MYFINNANCE CICILAN VILLA (6.d & 10.c)
		#------------------------------------------------
		$trans_6d = $this->app_model->manualQuery("
		INSERT INTO `transaksi` (`nomor`, `transaksi`, `user`, `tanggal_catat`, 
		`tanggal_transaksi`, `keterangan`, `buku`, `debet`, `bridge_transaksi`) 
		VALUES ({$this->app_model->maxnotransfinance(1)}+1, '31', '1', '', NOW(), '#{$no_transaksi} Bayar cicilan {$last}utk reservasi {$nama_villa} ({$lamahari} malam) oleh {$nama_tamu}', 
		'1', '{$jml_bayar}', '{$no_transaksi}')
		");
		$trans_10c = $this->app_model->manualQuery("
		INSERT INTO `transaksi` (`nomor`, `transaksi`, `user`, `tanggal_catat`, 
		`tanggal_transaksi`, `keterangan`, `buku`, `kredit`, `bridge_transaksi`) 
		VALUES ({$this->app_model->maxnotransfinance(1)}+1, '29', '1', '', NOW(), '#{$no_transaksi} Pelunasan piutang {$last}utk reservasi {$nama_villa} ({$lamahari} malam) oleh {$nama_tamu}', 
		'4', {$jml_bayar}, '{$no_transaksi}')
		");
		#------------------------------------------------

		if ($this->db->affected_rows() > 0) {echo "<meta http-equiv=\"refresh\" content=\"0;url=".$_SERVER['HTTP_REFERER']."\"/>";} else {}
		
	}
	function kwitansi($no_transaksi)
	{
		$data['totalbayar'] = $this->app_model->manualQuery("
			SELECT SUM(jml_bayar) total FROM tbl_pembayaran 
			WHERE no_transaksi = '{$no_transaksi}'
		")->row()->total;
		$data['dttrans'] = $this->app_model->getSelectedData('tbl_pembayaran',array('no_transaksi'=>$no_transaksi))->result();
		$data['inv'] = $this->app_model->getSelectedData('tbl_transaksi',array('no_transaksi'=>$no_transaksi))->row();
		$data['komponen_top'] = array('nav-print','kwitansi');
		$this->load->view('index',$data);
	}
	function ceklunas($no_transaksi) {
		$data['totalbayar'] = $this->app_model->manualQuery("
			SELECT SUM(jml_bayar) total FROM tbl_pembayaran 
			WHERE no_transaksi = '{$no_transaksi}'
		")->row()->total;
		$harusbayar = $this->app_model->getSelectedData('tbl_transaksi',array('no_transaksi'=>$no_transaksi))->row()->dapat_harga;
		$denda = $this->app_model->getSelectedData('tbl_transaksi',array('no_transaksi'=>$no_transaksi))->row()->dapat_denda;
		echo $data['sisabayar'] = $harusbayar+$denda - $data['totalbayar'];
	}
	function denda($no_transaksi,$besardenda) 
	{
		$update['dapat_denda'] = $besardenda;
		$key['no_transaksi'] = $no_transaksi;
		$this->app_model->updateData('tbl_transaksi',$update,$key);
		#------------------------------------------------
		# PENCATATAN KE APP MYFINNANCE DENDA VILLA (6.b)
		#------------------------------------------------
		/* FUNCTION Deprecated
		$dkey['bridge_transaksi'] = $no_transaksi;
		$dkey['transaksi'] = 10;
		$cek_eksis = $this->app_model->getSelectedData("transaksi",$dkey);
		if ($cek_eksis->num_rows() > 0) :
		$data['debet'] = $besardenda;
		$data['tanggal_transaksi'] = date('Y-m-d');
		$update_trans = $this->app_model->updateData('transaksi',$data,$dkey);
		else:
		$trans_6b = $this->app_model->manualQuery("
		INSERT INTO `transaksi` (`nomor`, `transaksi`, `user`, `tanggal_catat`, 
		`tanggal_transaksi`, `keterangan`, `buku`, `debet`, `bridge_transaksi`) 
		VALUES ({$this->app_model->maxnotransfinance(1)}+1, '10', '1', '', NOW(), '#{$no_transaksi} Bayar denda oleh {$nama_tamu}', 
		'1', '{$besardenda}', '{$no_transaksi}')
		");
		endif;
		*/
	}
}