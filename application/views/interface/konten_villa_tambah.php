<div class="">
  <h1><?php echo $jdl; ?> Data - Master Villa</h1>
</div>
<hr>
		
		<div id="body">
		<?php echo $this->session->flashdata('gagal_villa'); ?>
		<?php echo form_open_multipart('villa/simpan_input'); ?>
			
			<div class="form-group">
				<label  class="col-md-2 control-label">Kode Villa</label>
				<div class="col-md-3 input-group">										
					<input type="text" placeholder="Kode" name="kode_villa" value="<?php echo $kode_villa; ?>" class='form-control input-read-only' readonly="true">
				</div>
			</div>
			<div class="form-group">
				<label  class="col-md-2 control-label">Nama Villa</label>
				<div class="col-md-4 input-group">										
					<input type="text" placeholder="Nama Villa" name="nama_villa" value="<?php echo $nama_villa; ?>" class='form-control'>
				</div>
			</div>			
			<div class="form-group">
				<label  class="col-md-2 control-label">Tarif Villa</label>
				<div class="col-md-4 input-group">										
					<input type="text" placeholder="Tarif Villa" name="tarif_villa" value="<?php echo $tarif_villa; ?>" class='form-control'>
				</div>
			</div>
			<div class="form-group">
				<label  class="col-md-2 control-label">Diskon</label>
				<div class="col-md-4 input-group">										
					<input type="text" placeholder="Diskon Villa" name="diskon_villa" value="<?php echo $diskon_villa*100; ?>" class='form-control'>
					<span class="input-group-addon">%</span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label" for="userfile">Pilih File</label>				
				<div class="col-md-4 input-group">					
					<input type="file" name="userfile" id="userfile" value="<?php (( isset($_GET['filename']) ) ? print $_GET['filename'] : print $url ) ?>" />									
					<div class="cleaner_h10"></div>							
				<p style="background-color:#fff999; padding:5px; margin:0px; color:red;">File yang diperbolehkan hanya dalam format <strong>gif,jpg,png,jpeg</strong>
				resolusi file gambar <strong>3000PX x 3000PX</strong> dan ukuran maksimal file sebesar <strong>3 MB</strong></p>					
				</div>				
			</div>
			<input type="hidden" name="stts_input" value="<?php echo $stts_input; ?>">
			
			<div class="form-group" align="">
				<label  class="col-md-2 control-label"></label>
				<div class="col-md-4 input-group">										
					<input type="submit" class="btn btn-success" value="Simpan">
					<input type="reset" class="btn btn-default" value="Reset">												
					<input type="button" class="btn btn-default" value="Kembali" onclick="goBack()">
				</div>	
			</div>
		<?php echo form_close(); ?>

		</div>
	</div>

	<script>
	 function goBack()
	  {
	   window.history.back()
	  }
	</script>