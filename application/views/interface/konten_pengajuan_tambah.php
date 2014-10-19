
<div class="">
  <h2><?php echo $jdl; ?> Data - Pengajuan </h2>
</div>
<hr>
		
		<div id="body">
		<font color="red"><?php echo $this->session->flashdata('gagal_pengajuan'); ?></font>
		
		<?php echo form_open('pengajuan/simpan_input'); ?>			
			
			<div class="form-group">
				<label  class="col-md-2 control-label">Kode Barang</label>
				<div class="col-md-4 input-group">																
					<select data-placeholder="Cari Kode Barang..." class="kdselect form-control" name="kode_barang" id="kode_barang">	
						<option value=""> </option> 
						<?php
							foreach($barang->result_array() as $br)
							{
							$pilih='';
							if($br['kode_barang']==$this->session->userdata("kd_barang"))
							{
							$pilih='selected="selected"';
						?>
							<option value="<?php echo $br['kode_barang']; ?>" <?php echo $pilih; ?>><?php echo $br['kode_barang']; ?> - <?php echo $br['nama_barang']; ?></option>
						<?php
						}
						else
						{
						?>
							<option value="<?php echo $br['kode_barang']; ?>"><?php echo $br['kode_barang']; ?> - <?php echo $br['nama_barang']; ?></option>
						<?php
						}
							}
						?>
					</select>
				</div>			
			</div>
			
			<div id="data_barang"></div>
			<!-- dipindah sementara 
			<div class="form-group">
				<label  class="col-md-2 control-label">Nama Barang</label>
				<div class="col-md-3 input-group">										
					<input type="text" placeholder="Nama Barang" name="Nama_barang" value="<?php echo $kode_barang; ?>" class='form-control' readonly="true">
				</div>
			</div>
			
			<div class="form-group">
				<label  class="col-md-2 control-label">Nama Villa</label>
				<div class="col-md-3 input-group">										
					<input type="text" placeholder="Nama Villa" name="Nama_villa" value="<?php echo $nama_villa; ?>" class='form-control' readonly="true">
				</div>
			</div>
			
			<div class="form-group">
				<label  class="col-md-2 control-label">Nama Kamar/Ruang</label>
				<div class="col-md-3 input-group">										
					<input type="text" placeholder="Nama Kamar/Ruang" name="nama_kamar" value="<?php echo $nama_kamar; ?>" class='form-control' readonly="true">
				</div>
			</div>
			-->
			
			<div class="form-group">
				<label  class="col-md-2 control-label">Kondisi Barang</label>
				<div class="col-md-3 input-group">																
						<select data-placeholder="kondisi" class="form-control" name="kondisi_b" id="kondisi_b">
							<option value=""> -- Pilih Kondisi Barang --</option>
							<option value="1">Rusak</option>
							<option value="2">Tidak Layak Pakai</option>							
						</select>					
				</div>
			</div>						
			
			<div class="form-group">
				<label  class="col-md-2 control-label">Penyebab</label>
				<div class="col-md-4 input-group">																
						<select data-placeholder="Penyebab" class="form-control" name="id_sebab" id="id_sebab">
							<option value=""> -- Pilih Sebab --</option>
								<?php
								foreach($sebab->result_array() as $r)
								{
									if($id_sebab==$r['id_sebab'])
									{
							?>
								<option value="<?php echo $r['id_sebab']; ?>" selected="selected"><?php echo $r['penyebab']; ?></option>
							<?php
									}
									else
									{
							?>
								<option value="<?php echo $r['id_sebab']; ?>"><?php echo $r['penyebab']; ?></option>
							<?php
									}
								}
							?>
						</select>					
				</div>
			</div>			
					
			<input type="hidden" name="stts_input" value="<?php echo $stts_input; ?>">						
			<input type="hidden" name="id_status_p" value="1">						
			
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


<script src="<?php echo base_url(); ?>assets/chosen.jquery.js" type="text/javascript"></script>

<script type="text/javascript">	
	$(".kdselect").chosen().change(function(){ 
		var kode_barang = $("#kode_barang").val(); 
		//alert(kode_barang);
		$.ajax({ 
			url: "<?php echo base_url(); ?>pengajuan/ambil_data_barang_ajax", 
			data: "kode_barang="+kode_barang, 
			cache: false, 
			success: function(msg){ 
				$("#data_barang").html(msg); 
			} 
		})
	});
	//$('#data_barang').load('<?php echo base_url(); ?>pengajuan/ambil_data_barang_session');
	
	function goBack()
	  {
	   window.history.back()
	  }
</script>	