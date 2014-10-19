<div class="panel-group" id="accordion">
	<div class="panel panel-primary">
		<div class="panel-heading">
		  <h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
			  <?=showicon('book') ?> LAPORAN BARANG <?=$this->session->userdata("bulan_lap")?>
			</a>
		  </h4>
		</div>
		
		<div id="collapseOne" class="panel-collapse collapse in">
		<div class="panel-body">
		
		<div class="span6 pull-right">
		<?php echo form_open("laporan_barang/set", 'class="navbar-form pull-right"'); ?>
		
			VILLA  		  
			<select data-placeholder="Pilih Villa... " class="form-control" name="kode_villa" id="kode_villa" required>
				<option value=""> -- Pilih Villa -- </option>
								
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
				<option value="GUDANG"> GUDANG </option>		
			</select>
			KAMAR  
			<select data-placeholder="Nama Kamar/Ruang " class="form-control" name="id_kamar" id="id_kamar" required>
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
				
			<button name="submit" type="submit" class="btn btn-primary"><i class="icon-search icon-white"></i> Lihat Data</button>
			<a href="laporan_barang/cetak" target="_blank" class="btn btn-default"><?=showicon('print');?> Cetak </a>
		<?php echo form_close(); ?>
		</div>
		  
		  <!-- START DATA INPUT -->		
		
		<table class="table table-bordered">				 
			<tr>
				<th>No</th>
						<th>Nama Villa</th>
						<th>Nama Kamar</th>
						<th>Nama Barang</th>
						<th>Jumlah</th>
						<th>Harga Satuan</th>
						<th>Kondisi</th>											
			</tr>
		
		<tbody>
			<?php									 
					$no = 1;
					if(isset($dt_barang))
					{		
					foreach ($dt_barang->result_array() as $db){					
					?>		
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $db['kode_villa']; ?> - <?php echo $db['nama_villa']; ?></td>
						<td><?php echo $db['nama_kamar']; ?></td>
						<td><?php echo $db['nama_barang']; ?></td>
						<td><?php echo $db['jumlah_barang']; ?></td>
						<td><?php echo $db['harga_satuan']; ?></td>											
						<td><?php if($db['kondisi'] == 1) 
								  {echo "Rusak";} else {echo "Baik";}							  
						; ?></td>										
					</tr>
					<?php
						$no++;
						}
					}	
					else
					{
					?>					
						<tr>
							<td colspan="7">Belum ada data</td>
						</tr>
					<?php	
					} 
					?>
		
		
				<tr align="center">				
						<?php
							//echo $paginator;
						?>
					</td>
				</tr>
			</tbody>
		</table>
	
			<!-- END OFF DATA INPUT -->
	
		  </div>
		</div>
	</div>		
</div>  
	
	
<script>
$('.namadetail').popover();
</script>
