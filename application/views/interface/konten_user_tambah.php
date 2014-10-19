<div class="">
  <h1><?php echo $jdl; ?> Data - User</h1>
</div>
<hr>

		<div id="body">
		<?php echo $this->session->flashdata('gagal_user'); ?>
		
		<?php echo form_open('user/simpan_input'); ?>
			<div class="form-group">
				<label  class="col-md-2 control-label">Username</label>
				<div class="col-md-4 input-group">										
					<input type="text" placeholder="Username" name="username" value="<?php echo $username; ?>" class='form-control input-read-only'>
				</div>
			</div>
			<div class="form-group">
				<label  class="col-md-2 control-label">Password</label>
				<div class="col-md-4 input-group">										
					<input type="text" placeholder="Password" name="password" value="<?php echo $password; ?>" class='form-control'>
				</div>
			</div>			
			<div class="form-group">
				<label  class="col-md-2 control-label">Nama Pengguna</label>
				<div class="col-md-4 input-group">										
					<input type="text" placeholder="Nama Pengguna" name="nama_pengguna" value="<?php echo $nama_pengguna; ?>" class='form-control'>
				</div>
			</div>
			<input type="hidden" name="stts_input" value="<?php echo $stts_input; ?>">
			
			<div class="form-group">
				<label  class="col-md-2 control-label">Status</label>
					<div class="col-md-2 input-group">
					<select class="form-control input-read-only" name="stts" id="stts">		
						<option value=""> -- Pilih -- </option>
						<option value="operator">Operator</option>
						<option value="admin">Admin</option>
						<?php (($stts=="admin"))? '.<option value="admin" selected="selected">Admin</option>.' : '';?>
						<?php (($stts=="operator"))? '.<option value="operator" selected="selected">Operator</option>.' : '';?>				
					</select>
					</div>
			</div>	
			
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
