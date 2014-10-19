<?php echo $this->session->userdata('level');?>

<form role="form" action="<?=base_url();?>pengajuan/post" method="post">  

	
  <div class="form-group">
    <label for="tgl_cekin">Tanggal Cekin</label>
    <input type="date" class="form-control" id="tgl_cekin" name="tgl_cekin" placeholder="Tanggal Chek In" data-provide="datepicker" data-date-autoclose="true" data-date-format="yyyy-mm-dd" >
  </div>
  
  <div class="form-group">
    <label for="tgl_cekout">Tanggal Cekout</label>
    <input type="date" class="form-control" id="tgl_cekout" name="tgl_cekout" placeholder="Tanggal Check Out" data-provide="datepicker" data-date-autoclose="true" data-date-format="yyyy-mm-dd" >
  </div>
  
  <div class="form-group">
    <label for="no_transaksi">No Transaksi</label>
    <input type="date" class="form-control" id="no_transaksi" name="no_transaksi" placeholder="Nomor Transaksi" data-provide="datepicker" data-date-autoclose="true" data-date-format="yyyy-mm-dd" >
  </div>
  
  <div class="form-group">
    <label for="judul_pengajuan">Kode Tamu</label>
    <select id="kode_tamu" name="kode_tamu" class="form-control">
		<option value="">-pilih-</option>
		<?php foreach($dt_tamu->result() as $rows): ?>
			<option value="<?=$rows->kode_tamu?>"><?=$rows->kode_tamu?></option>
		<?php endforeach; ?>
	</select>
  </div>
  
  <div class="form-group">
    <label for="judul_pengajuan">Pilih Villa</label>
    <select id="divisi" name="divisi" class="form-control">
		<option value="">-pilih-</option>
		<?php foreach($divisi->result() as $rows): ?>
			<option value="<?=$rows->id_divisi?>"><?=$rows->divisi?></option>
		<?php endforeach; ?>
	</select>
  </div>
  
  <div class="form-group">
    <label for="judul_pengajuan">Pilih Guide</label>
    <select id="divisi" name="divisi" class="form-control" required>
		<option value="">-pilih-</option>
		<?php foreach($divisi->result() as $rows): ?>
			<option value="<?=$rows->id_divisi?>"><?=$rows->divisi?></option>
			<?php endforeach; ?>
	</select>
  </div>
  
    
  <div class="form-group">
    <label for="lama_hari">Lama Hari</label>
    <input type="text" class="form-control" id="lama_hari" name="lama_hari" placeholder="Lama hari" required>
  </div>
    
    
  <div class="form-group">
    <label for="dapat_harga">Total Biaya Menginap</label>
	  <div class="input-group">
		  <span class="input-group-addon">Rp</span>
		  <input type="number" class="form-control" id="jumlah_pengajuan" name="jumlah_pengajuan" placeholder="Jumlah Pengajuan" required>
		  <span class="input-group-addon">,00</span>
	  </div>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

