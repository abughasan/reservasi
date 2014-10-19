<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// @ali
/// adin
class Laporan extends CI_Controller {
		
	function perbulan(){
		
		$table ='tbl_transaksi';
		if($this->input->post("tahun_cari")=="" AND $this->session->userdata('tahun_lap')===FALSE)
		{
		//echo "1";
			//$tahun = date('Y');
			//$bulan = date('m');
			$data['dt_transaksi'] = $this->app_model->manualQuery
			("SELECT distinct
				tr.no_transaksi,
				tr.tgl_transaksi,
				tm.nama_tamu,
				tm.no_kartu_id,
				vl.kode_villa,
				tr.tgl_cekin,
				tr.tgl_cekout,
				tr.lama_hari,
				tr.dapat_harga,		
				byr.status_bayar
			FROM
				tbl_transaksi tr
			LEFT JOIN 
				tbl_tamu tm
				ON tr.id_tamu = tm.id_tamu
			LEFT JOIN 
				tbl_villa vl
				ON tr.kode_villa = vl.kode_villa
			LEFT JOIN 
				tbl_pembayaran byr
				ON tr.no_transaksi = byr.no_transaksi			
			");
		}
		else if($this->input->post("status_cari")=="")
		{
		//ECHO 2;
			$tahun = $this->input->post('tahun_cari');
			$bulan = $this->input->post('bulan_cari');
			
			//simpan session
			$sess_data['tahun_lap'] = $this->input->post("tahun_cari");	
			$sess_data['bulan_lap'] = $this->input->post("bulan_cari");
			$this->session->set_userdata($sess_data);
			$data['dt_transaksi'] = $this->app_model->manualQuery
			("SELECT distinct
				tr.no_transaksi,
				tr.tgl_transaksi,
				tm.nama_tamu,
				tm.no_kartu_id,
				vl.kode_villa,
				tr.tgl_cekin,
				tr.tgl_cekout,
				tr.lama_hari,
				tr.dapat_harga,		
				byr.status_bayar
			FROM
				tbl_transaksi tr
			LEFT JOIN 
				tbl_tamu tm
				ON tr.id_tamu = tm.id_tamu
			LEFT JOIN 
				tbl_villa vl
				ON tr.kode_villa = vl.kode_villa
			LEFT JOIN 
				tbl_pembayaran byr
				ON tr.no_transaksi = byr.no_transaksi
			WHERE
				year(tgl_transaksi)  = ".$tahun." and month(tgl_transaksi) = ".$bulan." 								
			");
		}	
		else
		{
			//echo 3;
			//simpan session
			$sess_data['tahun_lap'] = $this->input->post("tahun_cari");	
			$sess_data['bulan_lap'] = $this->input->post("bulan_cari");
			$sess_data['status_lap'] = $this->input->post("status_cari");
			$this->session->set_userdata($sess_data);
			//pangggil session
			$tahun = $this->session->userdata('tahun_lap');
			$bulan = $this->session->userdata('bulan_lap');					
			$status = $this->session->userdata('status_lap');			
			
			$data['dt_transaksi'] = $this->app_model->manualQuery
			("SELECT distinct
				tr.no_transaksi,
				tr.tgl_transaksi,
				tm.nama_tamu,
				tm.no_kartu_id,
				vl.kode_villa,
				tr.tgl_cekin,
				tr.tgl_cekout,
				tr.lama_hari,
				tr.dapat_harga,		
				byr.status_bayar
			FROM
				tbl_transaksi tr
			LEFT JOIN 
				tbl_tamu tm
				ON tr.id_tamu = tm.id_tamu
			LEFT JOIN 
				tbl_villa vl
				ON tr.kode_villa = vl.kode_villa
			LEFT JOIN 
				tbl_pembayaran byr
				ON tr.no_transaksi = byr.no_transaksi
			WHERE
				year(tgl_transaksi)  = ".$tahun." and month(tgl_transaksi) = ".$bulan." 
				AND byr.status_bayar = ".$status." 			
			");				
		}
		
		//$data['perbulan'] = '';
		$data['interface'] = array('lap_perbulan');		
		$data['template'] = 'satucolumn';
		$data['komponen_top'] = array('navbar','forcelogin');
		//cari tahu nama2 kolom di table tsb.
		$data['list_field'] = $this->db->list_fields($table);
		$this->load->view('index',$data);	
	}
	
	
	function pertanggal(){
		
		$table ='tbl_transaksi';
		if($this->input->post("tgl1")== "")
		{
			$tgl1 = 0;
			$tgl2 = 0;
			$data['dt_transaksi'] = $this->app_model->manualQuery("SELECT *	FROM tbl_transaksi 
			where tgl_transaksi  = ".$tgl1." and tgl_transaksi = ".$tgl2."");			
		}
		else
		{
			//simpan session
			$sess_data['mulai'] = $this->input->post("tgl1");	
			$sess_data['akhir'] = $this->input->post("tgl2");			
			$this->session->set_userdata($sess_data);
			//pangggil session
			$tgl1 = $this->session->userdata('mulai');
			$tgl2 = $this->session->userdata('akhir');			
			echo $status = $this->session->userdata('status');			
						
			$data['dt_transaksi'] = $this->app_model->manualQuery
			("SELECT DISTINCT
				tr.no_transaksi,
				tr.tgl_transaksi,
				tm.nama_tamu,
				tm.no_kartu_id,
				vl.kode_villa,
				tr.tgl_cekin,
				tr.tgl_cekout,
				tr.lama_hari,
				tr.dapat_harga,				
				byr.status_bayar
			FROM
				tbl_transaksi tr
			LEFT JOIN 
				tbl_tamu tm
				ON tr.id_tamu = tm.id_tamu
			LEFT JOIN 
				tbl_villa vl
				ON tr.kode_villa = vl.kode_villa
			LEFT JOIN 
				tbl_pembayaran byr
				ON tr.no_transaksi = byr.no_transaksi
			WHERE
				tr.tgl_transaksi >= '".$tgl1."'
            AND 
				tr.tgl_transaksi <= '".$tgl2."'");
		}
		
		
		//$data['perbulan'] = '';
		$data['interface'] = array('lap_pertanggal');		
		$data['template'] = 'satucolumn';
		$data['komponen_top'] = array('navbar','forcelogin');
		//cari tahu nama2 kolom di table tsb.
		$data['list_field'] = $this->db->list_fields($table);
		$this->load->view('index',$data);
	}
		
	public function cetak_perbulan()
	{
			$table = 'tbl_transaksi';
			//pangggil session
			
			$tahun = $this->session->userdata('tahun_lap');
			$bulan = $this->session->userdata('bulan_lap');					
			$status = $this->session->userdata('status_lap');			
			
			$data['dt_transaksi'] = $this->app_model->manualQuery
			("SELECT distinct
				tr.no_transaksi,
				tr.tgl_transaksi,
				tm.nama_tamu,
				tm.no_kartu_id,
				vl.kode_villa,
				tr.tgl_cekin,
				tr.tgl_cekout,
				tr.lama_hari,
				tr.dapat_harga,		
				byr.status_bayar
			FROM
				tbl_transaksi tr
			LEFT JOIN 
				tbl_tamu tm
				ON tr.id_tamu = tm.id_tamu
			LEFT JOIN 
				tbl_villa vl
				ON tr.kode_villa = vl.kode_villa
			LEFT JOIN 
				tbl_pembayaran byr
				ON tr.no_transaksi = byr.no_transaksi
			WHERE
				year(tgl_transaksi)  = ".$tahun." and month(tgl_transaksi) = ".$bulan." 
				AND byr.status_bayar = ".$status." 			
			");				
		$data['list_field'] = $this->db->list_fields($table);
		$data['komponen_top'] = array('nav-print','lap_bulan');
		$this->load->view('index',$data);
	}
	
	public function cetak_pertanggal()
	{
			$table = 'tbl_transaksi';
			//pangggil session
			$tgl1 = $this->session->userdata('mulai');
			$tgl2 = $this->session->userdata('akhir');			
			//echo $status = $this->session->userdata('status');			
						
			$data['dt_transaksi'] = $this->app_model->manualQuery
			("SELECT DISTINCT
				tr.no_transaksi,
				tr.tgl_transaksi,
				tm.nama_tamu,
				tm.no_kartu_id,
				vl.kode_villa,
				tr.tgl_cekin,
				tr.tgl_cekout,
				tr.lama_hari,
				tr.dapat_harga,				
				byr.status_bayar
			FROM
				tbl_transaksi tr
			LEFT JOIN 
				tbl_tamu tm
				ON tr.id_tamu = tm.id_tamu
			LEFT JOIN 
				tbl_villa vl
				ON tr.kode_villa = vl.kode_villa
			LEFT JOIN 
				tbl_pembayaran byr
				ON tr.no_transaksi = byr.no_transaksi
			WHERE
				tr.tgl_transaksi >= '".$tgl1."'
            AND 
				tr.tgl_transaksi <= '".$tgl2."'");
		
		
		$data['list_field'] = $this->db->list_fields($table);
		$data['komponen_top'] = array('nav-print','lap_tanggal');
		$this->load->view('index',$data);
	}

	public function detail(){
			echo "detail";	
	}	
	
	
	
}