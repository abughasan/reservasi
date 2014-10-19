<div class="">
  <h1><?php echo $jdl; ?> Data - Master Asset</h1>
</div>
<hr>
		
		<div id="body">
		<font color="red"><?php echo $this->session->flashdata('gagal_barang'); ?></font>
		
		<?php echo form_open('barang/simpan_input'); ?>			
			
			
			<div class="form-group">
				<label  class="col-md-2 control-label">Kode Barang</label>
				<div class="col-md-3 input-group">										
				<?php if($stts_input == "edit")
					{
					?>
					<input type="text" placeholder="-- Kode Barang --" name="kode_barang" maxlength="5" value="<?php echo $kode_barang; ?>" class='form-control' disabled="disabled" required>
					<?php
					}
					else
					{
					?>
					<input type="text" placeholder="-- Kode Barang --" name="kode_barang" maxlength="5" value="<?php echo $kode_barang; ?>" class='form-control' required>
					<?php
					}
					?>
				</div>
			</div>
			
			<div class="form-group">
				<label  class="col-md-2 control-label">Section</label>				
				<div class="col-md-3 input-group">																	
						<select data-placeholder="Nama Villa" class="form-control" name="kode_villa" id="kode_villa">
							<option value=""> -- Pilih Villa/Fasilitas lain -- </option>
							<?php
							foreach($villa->result_array() as $v)
							{
									if($kode_villa==$v['kode_villa'])
									{
							?>
								<option value="<?php echo $v['kode_villa']; ?>" selected="selected"><?php echo $v['nama_villa']; ?></option>
							<?php
									}
									else
									{
							?>
								<option value="<?php echo $v['kode_villa']; ?>"><?php echo $v['nama_villa']; ?></option>
							<?php
									}
							}
							?>
							<option value="gudang"> GUDANG </option>
							<?php if($kode_villa == "gudang"){?>
								<option value ="gudang" selected="selected"> GUDANG </option>
							<?php }?>
							<option value="lainnya"> LAINNYA </option>
							<?php if($kode_villa == "lainnya"){?>
								<option value ="gudang" selected="selected"> LAINNYA </option>
							<?php }?>
							
						</select>						
				</div>
			</div>
			<div class="form-group">
				<label  class="col-md-2 control-label">Kamar/Ruang</label>
				<div class="col-md-3 input-group">																
						<select data-placeholder="Nama Kamar/Ruang " class="form-control" name="id_kamar" id="id_kamar">
							<option value=""> -- Pilih Kamar/Ruang --</option>
								<?php
								foreach($ruang->result_array() as $r)
								{
									if($id_kamar==$r['id_kamar'])
									{
							?>
								<option value="<?php echo $r['id_kamar']; ?>" selected="selected"><?php echo $r['nama_kamar']; ?></option>
							<?php
									}
									else
									{
							?>
								<option value="<?php echo $r['id_kamar']; ?>"><?php echo $r['nama_kamar']; ?></option>
							<?php
									}
								}
							?>
						</select>					
				</div>
			</div>
			
			<div class="form-group">
				<label  class="col-md-2 control-label">Nama Barang</label>
				<div class="col-md-3 input-group">										
					<input type="text" placeholder="Nama Barang" name="nama_barang" value="<?php echo $nama_barang; ?>" class='form-control input-read-only' required>
				</div>
			</div>
			<div class="form-group">
				<label  class="col-md-2 control-label">Harga</label>
				<div class="col-md-4 input-group">										
					<input type="text" placeholder="Harga Satuan" name="harga_satuan" value="<?php echo $harga_satuan; ?>" class='form-control' required>
				</div>
			</div>			
			<div class="form-group">
				<label  class="col-md-2 control-label">Jumlah</label>
				<div class="col-md-1 input-group">										
					<input type="number" placeholder="Jumlah" name="jumlah_barang" value="<?php echo $jumlah_barang; ?>" class='form-control' required>
				</div>
			</div>			
			
			<!-- //data kondisi tidak diperlukan
			<div class="form-group">
				<label  class="col-md-2 control-label">Kondisi</label>
				<div class="col-md-2 input-group">														
					<select class="form-control" id="kondisi" name="kondisi">
					  <option value="">-- Pilih Kondisi --</option>					  
					  <?php if($kondisi == 1){?>
					  <option value="1" selected="selected"> Rusak </option>					  					 
					  <?php }else{?>
					  <option value="1"> Rusak </option>					  					 
					  <?php } ;?>
					</select>					
				</div>
			</div>
			-->
			
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
		<div class="cleaner_h10"></div>
		</div>
</div>

	<script>
	 function goBack()
	  {
	   window.history.back()
	  }
	</script>
