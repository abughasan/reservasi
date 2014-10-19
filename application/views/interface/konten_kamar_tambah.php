<div class="">
  <h2><?php echo $jdl; ?> Data - Master Kamar</h2>
</div>
<hr>
		
		
		<div id="body">
		<font color="red"><?php echo $this->session->flashdata('gagal_kamar'); ?></font>
		
		<?php echo form_open('kamar/simpan_input'); ?>			
			<div class="form-group">
				<label  class="col-md-2 control-label">Nama kamar</label>
				<div class="col-md-3 input-group">										
					<input type="text" placeholder="Nama kamar" name="nama_kamar" value="<?php echo $nama_kamar; ?>" class='form-control input-read-only'>
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
			
		<?php echo form_close(); ?>
		<div class="cleaner_h10"></div>
		</div>
</div>


