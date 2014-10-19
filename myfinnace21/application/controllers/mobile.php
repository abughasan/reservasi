<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mobile extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('auth_mobile');
		$this->load->model(array('trmodel'));
	}	
	function index()
	{
		if(from_session('user_id') == '')
		{
			$this->login();
		}
		else
		{
			$this->auth_mobile->restrict();
			$transaksi = $this->trmodel->get_jenis_transaksi();
			$data = array(
				'content'	=>$this->load->view('mobile/index_menu',array('transaksi'=>$transaksi),true)	
			);			
			$this->load->view('mobile/index',$data);
		}
	}
	function login()
	{
		$cap = $this->auth_mobile->setChaptcha();
		$data = array(
				'content'	=>$this->load->view('mobile/login_form',array('cap'=>$cap),true)	
			);
		$this->load->view('mobile/index',$data);
	}
	function do_login()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('captcha', 'Captcha', 'trim|required|callback_valid_captcha');
		$this->form_validation->set_message('valid_captcha','%s tidak sama');
		if ($this->form_validation->run() == FALSE)
		{
			echo "<span class='error'>Semua input harus diisi dengan benar.</span>";
		}
		else
		{
			$login = array('username'=>$this->input->post('username'),
				       'password'=>$this->input->post('password')
			);
			$return = $this->auth_mobile->do_login($login);
			if($return)
			{
				echo "";
			}
			else
			{
				echo "<span class='error'>Username/password salah.</span>";
			}
		}
	}
	function valid_captcha($str)
	{
		$expiration = time()-60;
		$this->db->query("DELETE FROM ".$this->db->dbprefix."captcha WHERE captcha_time < ".$expiration);
		$sql = "SELECT COUNT(*) AS count FROM ".$this->db->dbprefix."captcha WHERE word = ? 
			    AND ip_address = ? AND captcha_time > ?";
		$binds = array($str, $this->input->ip_address(), $expiration);
		$query = $this->db->query($sql, $binds);
		$row = $query->row();	
		if ($row->count == 0) 
		{
			return FALSE;
		}else{
			return TRUE;
		}          
	}
	function logout()
	{
		$this->auth_mobile->logout();
		echo warning('Anda berhasil Logout!','mobile');
	}
	function save_transaksi()
	{
		$this->auth_mobile->restrict();
		$field = array_keys($_POST);
		$data = $this->fungsi->accept_data($field);
		$pref = $this->trmodel->get_preferences($data['transaksi']);
		$nominal = $data['nominal'];
		$nominal = str_replace(',','',$nominal);
		$nomor = $data['nomor'];
		$data['tanggal_transaksi'] = $data['tahun'].'-'.$data['bulan'].'-'.$data['tanggal'];
		$data['tanggal_catat'] = time();
		$data['user'] = from_session('user_id');
		$data = $this->fungsi->array_delete($data,array('nominal','tanggal','bulan','tahun'));
		if(count($pref['debet'])>0)
		{
			foreach($pref['debet'] as $val)
			{
				$data['buku'] = $val;
				$data['debet'] = $nominal;
				$data = $this->fungsi->array_delete($data,'kredit');
				$nomor = $this->trmodel->simpan_transaksi($data,$nomor);
			}
		}
		if(count($pref['kredit'])>0)
		{
			foreach($pref['kredit'] as $val)
			{
				$data['buku'] = $val;
				$data = $this->fungsi->array_delete($data,'debet');
				$data['kredit'] = $nominal;
				$nomor = $this->trmodel->simpan_transaksi($data,$nomor);
			}
		}
		$tahun = substr($data['tanggal_transaksi'],0,4);
		$bulan = substr($data['tanggal_transaksi'],5,2);
	}
	function get_transaksi_terakhir()
	{
		$this->auth_mobile->restrict();
		$latest = $this->trmodel->get_latest_transaksi();
		echo '<ul data-role="listview" data-theme="c">';
		foreach($latest->result() as $row)
		{
			$nom = $row->debet;
			if($nom==0) $nom = $row->kredit;
			echo '<li>';
			?>
				<input type='hidden' class='transaksi_<?php echo $row->id;?>' value='<?php echo $row->transaksi;?>' />
				<input type='hidden' class='nomor_<?php echo $row->id;?>' value='<?php echo $row->nomor;?>' />
				<input type='hidden' class='tanggal_<?php echo $row->id;?>' value='<?php echo $row->tanggal_transaksi;?>' />
				<input type='hidden' class='keterangan_<?php echo $row->id;?>' value='<?php echo $row->keterangan;?>' />
				<input type='hidden' class='nominal_<?php echo $row->id;?>' value='<?php echo $this->fungsi->pecah($nom,',');?>' />
				<input type='hidden' class='id_piutang_<?php echo $row->id;?>' value='<?php echo $row->id_piutang;?>' />
				<?php
			echo '<a href="javascript:void(0)" onclick="edit('.$row->id.')">
				<h3>'.$row->keterangan.'</h3>
				<p>Rp. '.$this->fungsi->pecah($nom).'</p>
				</a>
			</li>';

		}
		echo '</ul>';
	}
	function get_buku_besar()
	{
		$this->auth_mobile->restrict();
		$buku = $this->trmodel->get_buku();
		echo '<ul data-role="listview" data-theme="c">';
		foreach($buku->result() as $row)
		{
		    $detail = $this->trmodel->get_saldo($row->id,date('m'),date('Y'),true);
		    $saldo_awal = $detail[0];
		    $debet = $detail[1];
		    $kredit = $detail[2];
		    $saldo = $this->trmodel->get_saldo_akhir($saldo_awal,$debet,$kredit,1);
		    ?>
		    <li>
			<h3><?php echo $row->nama;?></h3>
			<p>Saldo bulan lalu : Rp. <?php echo $this->fungsi->pecah($saldo_awal,'.',true);?></p>
			<p>Debet : Rp. <?php echo $this->fungsi->pecah($debet);?></p>
			<p>Kredit : Rp. <?php echo $this->fungsi->pecah($kredit);?></p>
			<p><strong>Saldo : Rp. <?php echo $this->fungsi->pecah($saldo,'.',true);?></strong></p>
		    </tr>
		    <?php
		}
	}
	function get_surplus_defisit()
	{
		$this->auth_mobile->restrict();
		for($b=date('m');$b>0;$b--)
		{
			$first = date('Y').'-'.$b.'-01';
			if($b == date('m'))
			{
				$second = date('Y-m-d');
			}
			else
			{
				$second = date('Y-').'-'.$b.'-31';
			}
			$surdef_bulan = $this->trmodel->get_surdef($first,$second);
			echo '<ul data-role="listview" data-theme="c">';
			foreach($surdef_bulan->result() as $row)
			{
			    $pemasukan = $row->pemasukan;
			    $pengeluaran = $row->pengeluaran;
			    $saldo = $pemasukan-$pengeluaran;
			    $ket = '<span class="green">(surplus)</span>';
			    if($saldo < 0) $ket = '<span class="red">(defisit)</span>';
			    ?>
			    <li>
				<h3>Surplus Defisit Bulan <?php echo $this->fungsi->bulan($b);?></h3>
				<p>Pemasukan : Rp. <?php echo $this->fungsi->pecah($pemasukan);?></p>
				<p>Pengeluaran : Rp. <?php echo $this->fungsi->pecah($pengeluaran);?></p>
				<p><strong>Saldo : Rp. <?php echo $this->fungsi->pecah($saldo,'.',true);?> <?php echo $ket;?></strong></p>
			    </li>
			    <?php
			}
			echo '</ul>';
		}
	}
}

/* End of file mobile.php */
/* Location: ./system/application/controllers/mobile.php */