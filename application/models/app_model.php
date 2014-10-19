<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_Model extends CI_Model {

	 
	//query otomatis dengan active record
	public function getAllData($table)
	{
		return $this->db->get($table);
	}
	
	public function getAllDataLimited($table,$limit,$offset)
	{
		return $this->db->get($table, $limit, $offset);
	}
	
	public function getAllDataVilla($limit,$offset)
	{
		return $this->db->query("select a.*, b.status_villa from tbl_villa a left join tbl_status_v b on a.id_status = b.id_status",$limit,$offset);
	}
	
	public function getSelectedDataLimited($table,$data,$limit,$offset)
	{
		return $this->db->get_where($table, $data, $limit, $offset);
	}
	
	public function getSelectedData($table,$data)
	{
		return $this->db->get_where($table, $data);
	}	
	
	function updateData($table,$data,$field_key)
	{
		$this->db->update($table,$data,$field_key);
	}
	
	function deleteData($table,$data)
	{
		$this->db->delete($table,$data);
	}
	
	function insertData($table,$data)
	{
		$this->db->insert($table,$data);
	}
	
	function manualQuery($q)
	{
		return $this->db->query($q);
	}
	
	function getCalendar($year, $mon){
		$year  = ($mon < 9 && strlen($mon) == 1) ? "$year-0$mon" : "$year-$mon";
		$query = $this->db->select('tgl_cekin')->from('tbl_transaksi')->get();
		if($query->num_rows() > 0){
			$data = array();
			foreach($query->result_array() as $row){
				$data[(int) end(explode('-',$row['tgl_cekin']))] = $row['tgl_cekin'];
			}
			return $data;
		}else{
			return false;
		}
	}
	
	public function getMaxKodeBarang()
	{
		$q = $this->db->query("select MAX(RIGHT(kode_barang,4)) as kd_max from tbl_barang");
		$kd = "";
		if($q->num_rows()>0)
		{
			foreach($q->result() as $k)
			{
				$tmp = ((int)$k->kd_max)+1;
				$kd = sprintf("%04s", $tmp);
			}
		}
		else
		{
			$kd = "0001";
		}	
		return "BR".$kd;
	}
	
	public function getMaxKodeGuide()
	{
		$q = $this->db->query("select MAX(RIGHT(kode_guide,3)) as kd_max from tbl_guide");
		$kd = "";
		if($q->num_rows()>0)
		{
			foreach($q->result() as $k)
			{
				$tmp = ((int)$k->kd_max)+1;
				$kd = sprintf("%03s", $tmp);
			}
		}
		else
		{
			$kd = "001";
		}	
		return "GU".$kd;
	}
	
	public function getMaxKodeVilla()
	{
		$q = $this->db->query("select MAX(RIGHT(kode_Villa,3)) as kd_max from tbl_villa");
		$kd = "";
		if($q->num_rows()>0)
		{
			foreach($q->result() as $k)
			{
				$tmp = ((int)$k->kd_max)+1;
				$kd = sprintf("%03s", $tmp);
			}
		}
		else
		{
			$kd = "001";
		}	
		return "VIL".$kd;
	}
	
	public function getkodetransaksi()
	{
		$q = $this->db->query("select MAX(RIGHT(no_transaksi,8)) as kd_max from tbl_transaksi");
		$kd = "";
		if($q->num_rows()>0)
		{
			foreach($q->result() as $k)
			{
				$tmp = ((int)$k->kd_max)+1;
				$kd = sprintf("%08s", $tmp);
			}
		}
		else
		{
			$kd = "00000001";
		}	
		return "TR".$kd;
	}
	
	
	public function getSisaStok($kode_barang)
	{
		$q = $this->db->query("select stok from tbl_barang where kode_barang='".$kode_barang."'");
		$stok = "";
		foreach($q->result() as $d)
		{
			$stok = $d->stok;
		}
		return $stok;
	}
	
	public function getBalancedStok($kode_barang,$kurangi)
	{
		$q = $this->db->query("select stok from tbl_barang where kode_barang='".$kode_barang."'");
		$stok = "";
		foreach($q->result() as $d)
		{
			$stok = $d->stok-$kurangi;
		}
		return $stok;
	}
	
	
	//query login
	public function getLoginData($usr,$psw)
	{
		//$u = mysql_real_escape_string($usr);
		//$p = md5(mysql_real_escape_string($psw.'appFakturDlmbg32'));
			//$p =mysql_real_escape_string($p);
		$q_cek_login = $this->db->get_where('tbl_login', array('username' => $usr, 'password' => $psw));
		if(count($q_cek_login->result())>0)
		{
			foreach($q_cek_login->result() as $qck)
			{
				if($qck->stts=='admin')
				{
					foreach($q_cek_login->result() as $qad)
					{
						$sess_data['logged_in'] = 'yesGetMeLogin';
						$sess_data['username'] = $qad->username;
						$sess_data['nama_pengguna'] = $qad->nama_pengguna;
						$sess_data['stts'] = $qad->stts;
						$this->session->set_userdata($sess_data);
					}
					header('location:'.base_url().'pemesanan/pending');
				}
			}
		}
		else
		{
			$this->session->set_flashdata('result_login', 'Username atau Password yang anda masukkan salah.');
			header('location:'.base_url().'front');
		}
	}
		function komisi_guide() 
	{
		$q = $this->db->query('
		SELECT tt.no_transaksi, 
			tt.dapat_harga nilai_transaksi, 
			tt.komisi_guide,
			(tt.dapat_harga * tt.komisi_guide) totalkomisi,
			tt.kode_guide, tpg.keterangan,
			sum(tpg.pembayaran) totalbayar,
			((tt.dapat_harga * tt.komisi_guide)-sum(tpg.pembayaran)) sisabayar
			FROM tbl_transaksi tt
			INNER JOIN tbl_pembayaran_guide tpg
			ON tt.no_transaksi = tpg.no_transaksi
			group by tt.no_transaksi
		');
		return $q;
	}
	function total_komisi_guide() 
	{
		$q = $this->db->query('
		SELECT 
		SUM(tt.dapat_harga * tt.komisi_guide) totalkomisi
		FROM tbl_transaksi tt
		INNER JOIN tbl_pembayaran_guide tpg
		ON tt.no_transaksi = tpg.no_transaksi
		');
		return $q;
	}
	function peringkat_komisi_guide()
	{
		$q = $this->db->query('
		SELECT 
		sum(tt.dapat_harga) total_transaksi,
		sum(tt.dapat_harga * tt.komisi_guide) totalkomisi,
		tt.kode_guide, tpg.keterangan
		FROM tbl_transaksi tt
		INNER JOIN tbl_pembayaran_guide tpg
		ON tt.no_transaksi = tpg.no_transaksi
		GROUP BY tt.kode_guide
		ORDER BY totalkomisi DESC
		');
		return $q;
	}
	function detail_villa($no_transaksi)
	{
		return $this->db->query("
		SELECT tv.nama_villa FROM tbl_transaksi tt
		INNER JOIN tbl_villa tv ON tt.kode_villa = tv.kode_villa
		WHERE tt.no_transaksi = '{$no_transaksi}'
		");
	}
	function detail_tamu($no_transaksi)
	{
		return $this->db->query("
		SELECT tm.nama_tamu FROM tbl_transaksi tt
		INNER JOIN tbl_tamu tm ON tt.id_tamu = tm.id_tamu
		WHERE tt.no_transaksi = '{$no_transaksi}'
		");
	}
		function maxnotransfinance($user)
	{
		$q = $this->db->query("
			SELECT MAX(nomor) as nomor
			FROM (`transaksi`)
			WHERE `user` =  '{$user}'
		")->row()->nomor;
		return $q;
	}
	function fin_pengeluaran($mon,$year)
	{
		$q = $this->db->query("
		SELECT * FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE jt.jenis = 2 and (t.buku = 1 or t.buku = 2 or t.buku = 3) 
		and MONTH(t.tanggal_transaksi) = {$mon}
		and YEAR(t.tanggal_transaksi) = {$year}
		ORDER BY t.nomor ASC
		");
		return $q;
	}
	function fin_pengeluaran_sum($mon,$year)
	{
		$q = $this->db->query("
		SELECT SUM(t.kredit) total FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE jt.jenis = 2 and (t.buku = 1 or t.buku = 2 or t.buku = 3) 
		and MONTH(t.tanggal_transaksi) = {$mon}
		and YEAR(t.tanggal_transaksi) = {$year}
		");
		return $q;
	}
	function fin_pemasukan($mon,$year)
	{
		$q = $this->db->query("
		SELECT * FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE jt.jenis = 1 and (t.buku = 1 or t.buku = 2 or t.buku = 3) 
		and MONTH(t.tanggal_transaksi) = {$mon}
		and YEAR(t.tanggal_transaksi) = {$year}
		ORDER BY t.nomor ASC
		");
		return $q;
	}
	function fin_pemasukan_sum($mon,$year)
	{
		$q = $this->db->query("
		SELECT SUM(t.debet) total FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE jt.jenis = 1 and (t.buku = 1 or t.buku = 2 or t.buku = 3) 
		and MONTH(t.tanggal_transaksi) = {$mon}
		and YEAR(t.tanggal_transaksi) = {$year}
		");
		return $q;
	}
	
	
	
	function fin_utang($mon,$year)
	{
		$q = $this->db->query("
		SELECT * FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE (t.buku = 5) 
		and MONTH(t.tanggal_transaksi) = {$mon}
		and YEAR(t.tanggal_transaksi) = {$year}
		ORDER BY t.nomor ASC
		");
		return $q;
	}
	
	function fin_piutang($mon,$year)
	{
		$q = $this->db->query("
		SELECT * FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE (t.buku = 4) 
		and MONTH(t.tanggal_transaksi) = {$mon}
		and YEAR(t.tanggal_transaksi) = {$year}
		ORDER BY t.nomor ASC
		");
		return $q;
	}
	
	function fin_sum($saldo,$buku,$mon,$year)
	{
		$q = $this->db->query("
		SELECT SUM(t.{$saldo}) total FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE (t.buku = {$buku}) 
		and MONTH(t.tanggal_transaksi) = {$mon}
		and YEAR(t.tanggal_transaksi) = {$year}
		");
		return $q;
	} 
	
	function fin_kas($mon,$year)
	{
		$q = $this->db->query("
		SELECT SUM(t.debet) total FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE jt.jenis = 1 and (t.buku = 1 or t.buku = 2 or t.buku = 3) 
		and MONTH(t.tanggal_transaksi) = {$mon}
		and YEAR(t.tanggal_transaksi) = {$year}
		");
		return $q;
	} 
	
	function fin_kas_perperiod($tgl1,$tgl2)
	{
		$q = $this->db->query("
		SELECT SUM(t.debet) total FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE jt.jenis = 1 and (t.buku = 1 or t.buku = 2 or t.buku = 3) 
		and t.tanggal_transaksi = {$tgl1}
		and t.tanggal_transaksi = {$tgl2}
		");
		return $q;
	} 
	
	//kas KASIR
	
	function fin_pengeluaran_kasir($mon,$year)
	{
		$q = $this->db->query("
		SELECT * FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE jt.jenis = 2 and (t.buku = 1) 
		and MONTH(t.tanggal_transaksi) = {$mon}
		and YEAR(t.tanggal_transaksi) = {$year}
		ORDER BY t.nomor ASC
		");
		return $q;
	}
	
	function fin_pengeluaran_sum_kasir($mon,$year)
	{
		$q = $this->db->query("
		SELECT SUM(t.kredit) total FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE jt.jenis = 2 and (t.buku = 1) 
		and MONTH(t.tanggal_transaksi) = {$mon}
		and YEAR(t.tanggal_transaksi) = {$year}
		");
		return $q;
	}
	
	function fin_pemasukan_kasir($mon,$year)
	{
		$q = $this->db->query("
		SELECT * FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE jt.jenis = 1 and (t.buku = 1 ) 
		and MONTH(t.tanggal_transaksi) = {$mon}
		and YEAR(t.tanggal_transaksi) = {$year}
		ORDER BY t.nomor ASC
		");
		return $q;
	}
	function fin_pemasukan_sum_kasir($mon,$year)
	{
		$q = $this->db->query("
		SELECT SUM(t.debet) total FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE jt.jenis = 1 and (t.buku = 1) 
		and MONTH(t.tanggal_transaksi) = {$mon}
		and YEAR(t.tanggal_transaksi) = {$year}
		");
		return $q;
	}
	
	//kas PETTY CASH
	function fin_pengeluaran_petty($mon,$year)
	{
		$q = $this->db->query("
		SELECT * FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE jt.jenis = 2 and (t.buku = 2) 
		and MONTH(t.tanggal_transaksi) = {$mon}
		and YEAR(t.tanggal_transaksi) = {$year}
		ORDER BY t.nomor ASC
		");
		return $q;
	}
	
	function fin_pengeluaran_sum_petty($mon,$year)
	{
		$q = $this->db->query("
		SELECT SUM(t.kredit) total FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE jt.jenis = 2 and (t.buku = 2) 
		and MONTH(t.tanggal_transaksi) = {$mon}
		and YEAR(t.tanggal_transaksi) = {$year}
		");
		return $q;
	}
	
	function fin_pemasukan_petty($mon,$year)
	{
		$q = $this->db->query("
		SELECT * FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE jt.jenis = 1 and (t.buku = 2) 
		and MONTH(t.tanggal_transaksi) = {$mon}
		and YEAR(t.tanggal_transaksi) = {$year}
		ORDER BY t.nomor ASC
		");
		return $q;
	}
	function fin_pemasukan_sum_petty($mon,$year)
	{
		$q = $this->db->query("
		SELECT SUM(t.debet) total FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE jt.jenis = 1 and (t.buku = 2) 
		and MONTH(t.tanggal_transaksi) = {$mon}
		and YEAR(t.tanggal_transaksi) = {$year}
		");
		return $q;
	}
	
	//kas BANK
	
	function fin_pengeluaran_bank($mon,$year)
	{
		$q = $this->db->query("
		SELECT * FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE jt.jenis = 2 and (t.buku = 3) 
		and MONTH(t.tanggal_transaksi) = {$mon}
		and YEAR(t.tanggal_transaksi) = {$year}
		ORDER BY t.nomor ASC
		");
		return $q;
	}
	
	function fin_pengeluaran_sum_bank($mon,$year)
	{
		$q = $this->db->query("
		SELECT SUM(t.kredit) total FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE jt.jenis = 2 and (t.buku = 3) 
		and MONTH(t.tanggal_transaksi) = {$mon}
		and YEAR(t.tanggal_transaksi) = {$year}
		");
		return $q;
	}
	
	function fin_pemasukan_bank($mon,$year)
	{
		$q = $this->db->query("
		SELECT * FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE jt.jenis = 1 and (t.buku = 3) 
		and MONTH(t.tanggal_transaksi) = {$mon}
		and YEAR(t.tanggal_transaksi) = {$year}
		ORDER BY t.nomor ASC
		");
		return $q;
	}
	function fin_pemasukan_sum_bank($mon,$year)
	{
		$q = $this->db->query("
		SELECT SUM(t.debet) total FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE jt.jenis = 1 and (t.buku = 3) 
		and MONTH(t.tanggal_transaksi) = {$mon}
		and YEAR(t.tanggal_transaksi) = {$year}
		");
		return $q;
	}
	
	
	
	//lap_perperiode
	//KAS KASIR
			
	function fin_pengeluaran_kasir_p($tgl1,$tgl2)
	{
		$q = $this->db->query("
		SELECT * FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE jt.jenis = 2 and (t.buku = 1) 
		and t.tanggal_transaksi >= '$tgl1'
		and t.tanggal_transaksi <= '$tgl2'
		ORDER BY t.nomor ASC
		");
		return $q;
	}
	
	function fin_pengeluaran_sum_kasir_p($tgl1,$tgl2)
	{
		$q = $this->db->query("
		SELECT SUM(t.kredit) total FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE jt.jenis = 2 and (t.buku = 1 or t.buku = 2) 
		and t.tanggal_transaksi >= '$tgl1'
		and t.tanggal_transaksi <= '$tgl2'
		");
		return $q;
	}
	
	function fin_pemasukan_kasir_p($tgl1,$tgl2)
	{
		$q = $this->db->query("
		SELECT * FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE jt.jenis = 1 and (t.buku = 1 ) 
		and t.tanggal_transaksi >= '$tgl1'
		and t.tanggal_transaksi <= '$tgl2'
		ORDER BY t.nomor ASC
		");
		return $q;
	}
	function fin_pemasukan_sum_kasir_p($tgl1,$tgl2)
	{
		$q = $this->db->query("
		SELECT SUM(t.debet) total FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE jt.jenis = 1 and (t.buku = 1) 
		and t.tanggal_transaksi >= '$tgl1'
		and t.tanggal_transaksi <= '$tgl2'
		");
		return $q;
	}	
	
	//KAS PETTY CASH
	function fin_pengeluaran_petty_p($tgl1,$tgl2)
	{
		$q = $this->db->query("
		SELECT * FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE jt.jenis = 2 and (t.buku = 3) 
		and t.tanggal_transaksi >= '$tgl1'
		and t.tanggal_transaksi <= '$tgl2'
		ORDER BY t.nomor ASC
		");
		return $q;
	}
	
	function fin_pengeluaran_sum_petty_p($tgl1,$tgl2)
	{
		$q = $this->db->query("
		SELECT SUM(t.kredit) total FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE jt.jenis = 2 and (t.buku = 3) 
		and t.tanggal_transaksi >= '$tgl1'
		and t.tanggal_transaksi <= '$tgl2'
		");
		return $q;
	}	
	function fin_pemasukan_petty_p($tgl1,$tgl2)
	{
		$q = $this->db->query("
		SELECT * FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE jt.jenis = 0 and (t.buku = 3) 
		and t.tanggal_transaksi >= '$tgl1'
		and t.tanggal_transaksi <= '$tgl2'
		ORDER BY t.nomor ASC
		");
		return $q;
	}
	function fin_pemasukan_sum_petty_p($tgl1,$tgl2)
	{
		$q = $this->db->query("
		SELECT SUM(t.debet) total FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE jt.jenis = 0 and (t.buku = 3) 
		and t.tanggal_transaksi >= '$tgl1'
		and t.tanggal_transaksi <= '$tgl2'
		");
		return $q;
	}
	
	//KAS BANK
	function fin_pengeluaran_bank_p($tgl1,$tgl2)
	{
		$q = $this->db->query("
		SELECT * FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE jt.jenis = 1 and (t.buku = 2) 
		and t.tanggal_transaksi >= '$tgl1'
		and t.tanggal_transaksi <= '$tgl2'
		ORDER BY t.nomor ASC
		");
		return $q;
	}
	
	function fin_pengeluaran_sum_bank_p($tgl1,$tgl2)
	{
		$q = $this->db->query("
		SELECT SUM(t.kredit) total FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE jt.jenis = 1 and (t.buku = 2) 
		and t.tanggal_transaksi >= '$tgl1'
		and t.tanggal_transaksi <= '$tgl2'
		");
		return $q;
	}
	
	function fin_pemasukan_bank_p($tgl1,$tgl2)
	{
		$q = $this->db->query("
		SELECT * FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE jt.jenis = 0 and (t.buku = 2) 
		and t.tanggal_transaksi >= '$tgl1'
		and t.tanggal_transaksi <= '$tgl2'
		ORDER BY t.nomor ASC
		");
		return $q;
	}
	function fin_pemasukan_sum_bank_p($tgl1,$tgl2)
	{
		$q = $this->db->query("
		SELECT SUM(t.debet) total FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE jt.jenis = 0 and (t.buku = 2) 
		and t.tanggal_transaksi >= '$tgl1'
		and t.tanggal_transaksi <= '$tgl2'
		");
		return $q;
	}
	
	//PEMASUKAN
		function fin_pemasukan_p($tgl1,$tgl2)
	{
		$q = $this->db->query("
		SELECT * FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE jt.jenis = 1 and (t.buku = 1 or t.buku = 2 or t.buku = 3) 
		and t.tanggal_transaksi >= '$tgl1'
		and t.tanggal_transaksi <= '$tgl2'
		ORDER BY t.nomor ASC
		");
		return $q;
	}
	function fin_pemasukan_sum_p($tgl1,$tgl2)
	{
		$q = $this->db->query("
		SELECT SUM(t.debet) total FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE jt.jenis = 1 and (t.buku = 1 or t.buku = 2 or t.buku = 3) 
		and t.tanggal_transaksi >= '$tgl1'
		and t.tanggal_transaksi <= '$tgl2'
		");
		return $q;
	}
	
	//PEMASUKAN BERJALAN
	function fin_pemasukan_b($tgl1,$tgl2)
	{
		$q = $this->db->query("
		SELECT t.tanggal_transaksi, t.keterangan, t.debet, t.kredit, tt.tgl_cekin, tt.tgl_cekout FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id 
		INNER JOIN tbl_transaksi tt ON tt.no_transaksi = t.bridge_transaksi
		WHERE jt.jenis = 1 and (t.buku = 1 or t.buku = 2 or t.buku = 3)
		and tt.tgl_cekin >= '$tgl1'
		and tt.tgl_cekout <= '$tgl2'
		ORDER BY t.nomor ASC
		"); 
		return $q;
	}
	function fin_pemasukan_sum_b($tgl1,$tgl2)
	{
		$q = $this->db->query("
		SELECT SUM(t.debet) total FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		INNER JOIN tbl_transaksi tt ON tt.no_transaksi = t.bridge_transaksi
		WHERE jt.jenis = 1 and (t.buku = 1 or t.buku = 2 or t.buku = 3) 
		and tt.tgl_cekin >= '$tgl1'
		and tt.tgl_cekout <= '$tgl2'
		");
		return $q;
	}
	
	//PENGELUARAN
	function fin_pengeluaran_p($tgl1,$tgl2)
	{
		$q = $this->db->query("
		SELECT * FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE jt.jenis = 2 and (t.buku = 1 or t.buku = 2 or t.buku = 3) 
		and t.tanggal_transaksi >= '$tgl1'
		and t.tanggal_transaksi <= '$tgl2'
		ORDER BY t.nomor ASC
		");
		return $q;
	}
	function fin_pengeluaran_sum_p($tgl1,$tgl2)
	{
		$q = $this->db->query("
		SELECT SUM(t.kredit) total FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE jt.jenis = 2 and (t.buku = 1 or t.buku = 2 or t.buku = 3) 
		and t.tanggal_transaksi >= '$tgl1'
		and t.tanggal_transaksi <= '$tgl2'
		");
		return $q;
	}
	
	//PIUTANG
	function fin_piutang_p($tgl1,$tgl2)
	{
		$q = $this->db->query("
		SELECT * FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE (t.buku = 4) 
		and t.tanggal_transaksi >= '$tgl1'
		and t.tanggal_transaksi <= '$tgl2'
		ORDER BY t.nomor ASC
		");
		return $q;
	}
	
	//UTANG
	function fin_utang_p($tgl1,$tgl2)
	{
		$q = $this->db->query("
		SELECT * FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE (t.buku = 5) 
		and t.tanggal_transaksi >= '$tgl1'
		and t.tanggal_transaksi <= '$tgl2'
		ORDER BY t.nomor ASC
		");
		return $q;
	}
	
	
	function fin_sum_p($saldo,$buku,$tgl1,$tgl2)
	{
		$q = $this->db->query("
		SELECT SUM(t.{$saldo}) total FROM transaksi t
		INNER JOIN jenis_transaksi jt ON t.transaksi = jt.id
		WHERE (t.buku = {$buku}) 
		and t.tanggal_transaksi >= '$tgl1'
		and t.tanggal_transaksi <= '$tgl2'
		");
		return $q;
	} 
	
	
}

/* End of file app_model.php */
/* Location: ./application/models/app_model.php */