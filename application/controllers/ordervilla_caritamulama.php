<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// @ali
//
class Ordervilla_caritamulama extends CI_Controller {
	
	function index(){
		$nama = $this->uri->segment(3);
		$dateIn = $_GET['dateIn'];
		$dateOut = $_GET['dateOut'];
		$lamahari = $_GET['lamahari'];
		$kdvilla = $_GET['kdvilla'];
		if (isset($nama)) :
		$carinama = $this->app_model->manualQuery("
			SELECT * FROM tbl_tamu WHERE nama_tamu LIKE '%{$nama}%'
		");
		?>
		<table class="table table-bordered">
			<tr><td>Nama</td><td>Alamat</td><td>No. Telp</td><td>*</td></tr>
			<?php foreach($carinama->result() as $db): ?>
			<tr><td><?=$db->nama_tamu?></td><td><?=$db->alamat_tamu?></td><td><?=$db->tlp?></td>
			<td><a class="btn btn-default" href="<?php echo base_url().'orderdatatamu/index/3?dateIn='.$dateIn.'&dateOut='.$dateOut.'&lamahari='.$lamahari.'&kode_villa='.$kdvilla.'&id_tamu='.$db->id_tamu ?>">pilih</a></td></tr>
			<?php endforeach; ?>
		</table>
		<?php
		endif;
	}

}