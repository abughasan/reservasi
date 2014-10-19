<?php // CHANGE LOG : Setiap variabel di sini ane tambahin karakter '@' di depannya contoh variabel
	  // $jdl -> @$jdl . Alasan untuk menghilangkan pesan error jika ada. karena ane pinjem form ini
	  // untuk transaksi.
?>
<div class="">
  <h1><?php echo @$jdl; ?> Data - Tamu</h1>
</div>
<hr>

		<div id="body">
		<?php echo $this->session->flashdata('gagal_tamu'); ?>		
		<?php echo form_open('tamu/simpan_input'); ?>
		
			<div class="form-group">
				<label  class="col-md-2 control-label">Jenis ID</label>
				<div class="col-md-3 input-group">										
					<select name="jenis_kartu_id" class="input-read-only form-control">
						<?php
						if(@$jenis_kartu_id=="KTP") 
						{
							?>
							<option value="KTP" selected="selected">KTP</option>
							<option value="PASSPORT">PASSPORT</option>
							<?php
						}
						// else if($stts_bayar=="PASSPORT") before
						else if(@$jenis_kartu_id=="PASSPORT")
						{
							?>
							<option value="KTP">KTP</option>
							<option value="PASSPORT" selected="selected">PASSPORT</option>
							<?php
						}
						else
						{
							?>
							<option value="-" selected="selected">- Pilih -</option>
							<option value="KTP">KTP</option>
							<option value="PASSPORT">PASSPORT</option>
						<?php
						}
						?>
				</select>	
				</div>
			</div>			
			<div class="form-group">
				<label  class="col-md-2 control-label">No Kartu ID</label>
				<div class="col-md-4 input-group">										
					<input type="text" placeholder="Nomor ID Card" name="no_kartu_id" value="<?php echo @$no_kartu_id; ?>" class='form-control'>
				</div>
			</div>			
			<div class="form-group">
				<label  class="col-md-2 control-label">Nama Tamu</label>
				<div class="col-md-4 input-group">										
					<input type="text" placeholder="Nama Tamu" name="nama_tamu" value="<?php echo @$nama_tamu; ?>" class='form-control'>
				</div>
			</div>
			<div class="form-group">
				<label  class="col-md-2 control-label">Alamat Tamu</label>
				<div class="col-md-8 input-group">										
					<input type="text" placeholder="Alamat Tamu" name="alamat_tamu" value="<?php echo @$alamat_tamu; ?>" class='form-control'>
				</div>
			</div>
			<div class="form-group">
				<label  class="col-md-2 control-label">Nomor Telepon</label>
				<div class="col-md-4 input-group">										
					<input type="text" placeholder="No Telepon" name="tlp" value="<?php echo @$tlp; ?>" class='form-control'>
				</div>
			</div>
			<?php if($stts_input == "edit"){?>
			<div class="form-group">
				<label  class="col-md-2 control-label">Status</label>
				<div class="col-md-3 input-group">										
					<select name="status" class="form-control input-read-only">		
						<?php
						if($status=="") 
						{
							?>
							<option value="" selected="selected"></option>
							<option value="Blacklist">Blacklist</option>
							<?php
						}
						// else if($stts_bayar=="PASSPORT") before
						else //if($status=="Blacklist")
						{
							?>
							<option value=""></option>
							<option value="Blacklist" selected="selected">Blacklist</option>
							<?php
						}
						?>
					</select>
				</div>
			</div>
			<?php } ;?>
			
			<input type="hidden" name="stts_input" value="<?php echo @$stts_input; ?>">
			<input type="hidden" name="id_tamu" value="<?php echo @$id_tamu; ?>">
			
			<?php if ($stts_input=="tambah_from_transaksi"): ?>
			<input type="hidden" name="dateIn" value="<?=$dateIn?>" class='form-control'>
			<input type="hidden" name="dateOut" value="<?=$dateOut?>" class='form-control'>
			<input type="hidden" name="lamahari" value="<?=$lamahari?>" class='form-control'>
			<input type="hidden" name="kode_villa" value="<?=$kode_villa?>" class='form-control'>
			<?php endif; ?>
			<div class="form-group" align="">
				<label  class="col-md-2 control-label"></label>
				<div class="col-md-4 input-group">										
					<input type="submit" class="btn btn-success" value="Simpan">
					<input type="reset" class="btn btn-default" value="Reset">												
				</div>	
			</div>			
			
		<?php echo form_close(); ?>
		<div class="cleaner_h10"></div>
		</div>
</div>