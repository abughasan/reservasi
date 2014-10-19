	<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// @ali
//
class Transaksi extends CI_Controller {

	function index(){
	
		//definisikan nama table dulu biar mudah copas bikin controller
		$table = 'tbl_transaksi';
					
		$data['dt_booking'] = $this->db->query("select * from tbl_transaksi 
		where id_status_v = 2
		order by tgl_cekin ASC");
		
		$data['data_chekin'] = $this->db->query("select * from tbl_transaksi 
		where id_status_v = 3
		");
		
		$data['data_chekout'] = $this->db->query("select * from tbl_transaksi 
		where id_status_v = 4
		ORDER BY tgl_transaksi DESC ");
		
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
			");	
		
		$data['interface'] = array('data_transaksi');		
		$data['template'] = 'satucolumn';
		$data['komponen_top'] = array('navbar','forcelogin');
		//cari tahu nama2 kolom di table tsb.
		$data['list_field'] = $this->db->list_fields($table);
		$this->load->view('index',$data);
	}
	
	function view(){
		
		$table = 'tbl_transaksi';
					
		$data['dt_booking'] = $this->db->query("select * from tbl_transaksi 
		where id_status_v = 2
		order by tgl_cekin DESC");
		
		$data['data_chekin'] = $this->db->query("select * from tbl_transaksi 
		where id_status_v = 3
		");
		
		$data['data_chekout'] = $this->db->query("select * from tbl_transaksi 
		where id_status_v = 4
		ORDER BY tgl_transaksi DESC ");
		
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
			");	
		
		$data['interface'] = array('data_transaksi');		
		$data['template'] = 'satucolumn';
		// $data['komponen_top'] = array('navbar','forcelogin');
		//cari tahu nama2 kolom di table tsb.
		$data['list_field'] = $this->db->list_fields($table);
		$this->load->view('interface/konten_data_transaksi_booking',$data);
	}	
	
	function updatehadir($hadirval,$no_transaksi) 
	{
		echo $hadirval."->".$no_transaksi;
				
		$this->app_model->manualQuery("
		UPDATE tbl_transaksi
		SET id_status_v = '".$hadirval."'
		WHERE no_transaksi = '".$no_transaksi."'
		");
			
		$this->app_model->manualQuery("INSERT INTO tbl_hadir (no_transaksi, tgl_datang, tgl_pulang) 
		VALUES ('$no_transaksi', NOW(), '')
		");				
	}
	
	function updateOut($hadirval,$no_transaksi,$tgl_cekout_booking,$kode_villa) 
	{
		// echo $hadirval."->".$no_transaksi;
		// echo $tgl_cekout_booking;
			
		$this->app_model->manualQuery("
		UPDATE tbl_hadir
		SET tgl_pulang = NOW()
		WHERE no_transaksi = '".$no_transaksi."'
		");	
		
		if ($tgl_cekout_booking > date('Y-m-d')):
		
		$datenow = date('Y-m-d');
		$tglhadir = $this->app_model->getSelectedData('tbl_hadir',array('no_transaksi'=>$no_transaksi))->row()->tgl_datang;
		// echo $lama_hari = $datenow - $tglhadir;
		$date1=date_create($tglhadir);
		$date2=date_create($datenow);
		$diff=date_diff($date1,$date2);
		echo $lama_hari = $diff->format("%R%a");
		echo $hargavilla = $this->app_model->getSelectedData('tbl_villa',array('kode_villa'=>$kode_villa))->row()->tarif_villa;
		echo $total_harga = $lama_hari * $hargavilla;
		$this->app_model->manualQuery("
		UPDATE tbl_transaksi
		SET id_status_v = '".$hadirval."', lama_hari = '".$lama_hari."', dapat_harga = '".$total_harga."' 
		WHERE no_transaksi = '".$no_transaksi."'
		");
		
		else:
		
		$this->app_model->manualQuery("
		UPDATE tbl_transaksi
		SET id_status_v = '".$hadirval."'  
		WHERE no_transaksi = '".$no_transaksi."'
		");
		
		endif;
	}
	
	function updatecanceltrans($hadirval,$no_transaksi)
	{
		echo $hadirval."->".$no_transaksi;
		
		$this->app_model->manualQuery("
		UPDATE tbl_transaksi
		SET id_status_v = '".$hadirval."'
		WHERE no_transaksi = '".$no_transaksi."'
		");		
	}
	function updateBook_dateout($no_transaksi,$dateOut,$lama_hari)
	{
		$this->app_model->manualQuery("
		UPDATE tbl_transaksi SET tgl_cekout = '{$dateOut}', lama_hari = '{$lama_hari}'
		WHERE no_transaksi = '{$no_transaksi}'
		");
		
		if ($this->db->affected_rows() > 0 ) {
			echo "Transaksi ".$no_transaksi.", update checkout : ".$dateOut." (".$lama_hari." Hari)";
		}else{
			echo "Transaksi ".$no_transaksi.", TIDAK terupdate!";
		}
	}
	private function createDateRangeArray($strDateFrom,$strDateTo,$id_tamu)
	{
		// takes two dates formatted as YYYY-MM-DD and creates an
		// inclusive array of the dates between the from and to dates.

		// could test validity of dates here but I'm already doing
		// that in the main script

		$aryRange=array();

		$iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
		$iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

		if ($iDateTo>=$iDateFrom)
		{
			array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
			while ($iDateFrom<$iDateTo)
			{
				$iDateFrom+=86400; // add 24 hours
				array_push($aryRange,date('Y-m-d',$iDateFrom));
			}
		}
		return $aryRange;
	}
}	