	<div class="">
	  <h1><?php echo $jdl; ?> Data - Master Guide</h1>
	</div>
	<hr>
	
		<div id="body">
		<?php echo $this->session->flashdata('gagal_guide'); ?>
		
		<?php echo form_open('guide/simpan_input'); ?>
			
			<div class="form-group">
				<label  class="col-md-2 control-label">Kode Guide</label>
				<div class="col-md-3 input-group">										
					<input type="text" placeholder="Kode" name="kode_guide" value="<?php echo $kode_guide; ?>" class='form-control input-read-only'>
				</div>
			</div>
			<div class="form-group">
				<label  class="col-md-2 control-label">Nomor KTP</label>
				<div class="col-md-4 input-group">										
					<input type="text" placeholder="Nomor KTP" name="no_ktp" value="<?php echo $no_ktp; ?>" class='form-control'>
				</div>
			</div>
			<div class="form-group">
				<label  class="col-md-2 control-label">Nama Guide</label>
				<div class="col-md-4 input-group">										
					<input type="text" placeholder="Nama Guide" name="nama_guide" value="<?php echo $nama_guide; ?>" class='form-control'>
				</div>
			</div>
			<div class="form-group">
				<label  class="col-md-2 control-label">Alamat</label>
				<div class="col-md-4 input-group">										
					<input type="text" placeholder="Alamat" name="alamat" value="<?php echo $alamat; ?>" class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<label  class="col-md-2 control-label">Nomor Telepon</label>
				<div class="col-md-4 input-group">										
					<input type="text" placeholder="Nomor Telepon" name="no_telp" value="<?php echo $no_telp; ?>" class="form-control" >
				</div>
			</div>
			<div class="form-group">
				<label  class="col-md-2 control-label">Sisa Pembayaran</label>
				<div class="col-md-4 input-group">										
					<input type="text" placeholder="Sisa Pembayaran" name="sisa_pembayaran" value="<?php echo $sisa_pembayaran; ?>" class="form-control" >
				</div>
			</div>
			<div class="form-group">
				<label  class="col-md-2 control-label">Status</label>
				<div class="col-md-4 input-group">										
					<input type="text" placeholder="Status Guide" name="stts_guide" value="<?php echo $stts_guide; ?>" class="form-control" >					
				</div>
			</div>
			
			<input type="hidden" name="stts_input" value="<?php echo $stts_input; ?>">
			
			<div class="form-group" align="">
				<label  class="col-md-2 control-label"></label>
				<div class="col-md-4 input-group">										
					<input type="submit" class="btn btn-success" value="Simpan">
					<input type="reset" class="btn btn-default" value="Reset">												
				</div>	
			</div>
			
		</div>
