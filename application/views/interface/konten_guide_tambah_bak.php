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
			
			<?php if($stts_input == 'edit'){  ?>
			<div class="form-group">
				
				<label  class="col-md-2 control-label">Status</label>
				<div class="col-md-2 input-group">														
					<select class="form-control" id="stts_guide" name="stts_guide">
					  <option value="">-- Pilih Status Guide --</option>					  
					  <?php if($stts_guide == 1){?>
					  <option value="1" selected="selected"> Blacklist </option>					  					 
					  <?php }else{?>
					  <option value="1"> Blacklist </option>					  					 
					  <?php } ;?>
					</select>					
				</div>
			</div>
			<?php } ?>
			<input type="hidden" name="stts_input" value="<?php echo $stts_input; ?>">
			
			<div class="form-group" align="">
				<label  class="col-md-2 control-label"></label>
				<div class="col-md-4 input-group">										
					<input type="submit" class="btn btn-success" value="Simpan">
					<input type="reset" class="btn btn-default" value="Reset">												
				</div>	
			</div>
			
		<?php echo form_close(); ?>
		</div>
