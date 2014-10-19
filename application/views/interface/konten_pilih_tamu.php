<div class="">
  <h1><?php echo $jdl; ?> Data - Tamu</h1>
</div>
<hr>

		<div id="body">
		<?php echo $this->session->flashdata('gagal_tamu'); ?>		
		<?php echo form_open('tamu/simpan_input'); ?>
		
			<div class="form-group">
				<label  class="col-md-2 control-label">Jenis ID</label>
				<div class="col-md-3 input-group">										
					<select name="jenis_kartu_id" class="form-control input-read-only">		
						<option value="">--Pilih jenis Kartu ID--</option>
						<option value="KTP">KTP</option>
						<option value="PASSPORT">PASSPORT</option>
					</select>
				</div>
			</div>			
			<div class="form-group">
				<label  class="col-md-2 control-label">No Kartu ID</label>
				<div class="col-md-4 input-group">										
					<input type="text" placeholder="Nomor ID Card" name="no_kartu_id" value="<?php echo $no_kartu_id; ?>" class='form-control'>
				</div>
			</div>			
			<div class="form-group">
				<label  class="col-md-2 control-label">Nama Tamu</label>
				<div class="col-md-4 input-group">										
					<input type="text" placeholder="Nama Tamu" name="nama_tamu" value="<?php echo $nama_tamu; ?>" class='form-control'>
				</div>
			</div>
			<div class="form-group">
				<label  class="col-md-2 control-label">Alamat Tamu</label>
				<div class="col-md-8 input-group">										
					<input type="text" placeholder="Alamat Tamu" name="alamat_tamu" value="<?php echo $alamat_tamu; ?>" class='form-control'>
				</div>
			</div>
			<div class="form-group">
				<label  class="col-md-2 control-label">Nomor Telepon</label>
				<div class="col-md-4 input-group">										
					<input type="text" placeholder="No Telepon" name="tlp" value="<?php echo $tlp; ?>" class='form-control'>
				</div>
			</div>
			<div class="form-group">
				<label  class="col-md-2 control-label">Status</label>
				<div class="col-md-3 input-group">										
					<select name="status" class="form-control input-read-only">		
						<option value="">--Pilih Status--</option>
						<option value="Blacklist">Blacklist</option>						
					</select>
				</div>
			</div>
			<input type="hidden" name="stts_input" value="<?php echo $stts_input; ?>">
			<input type="hidden" name="id_tamu" value="" class='form-control'>
						
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


