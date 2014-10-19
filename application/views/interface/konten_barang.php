	<div class="panel-group" id="accordion">
	  <div class="panel panel-default">
		<div class="panel-heading">
		  <h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
			  <?=showicon('saved') ?> MASTER DATA ASSET
			</a>
		  </h4>
		</div>
		<div id="collapseOne" class="panel-collapse collapse in">
		  <div class="panel-body">
				<!-- START DATA INPUT -->
										
					<table class="table table-bordered" border="1">				 
					<tr>				 				
						<th>No</th>
						<th>Nama Villa</th>
						<th>Nama Kamar</th>
						<th>Kode Barang</th>						
						<th>Nama Barang</th>
						<th>Jumlah</th>
						<th>Harga Satuan</th>
						<th>Kondisi</th>					
						<th colspan='3'><a href="<?php echo base_url(); ?>barang/tambah" class="cbbarang"><div class="btn-add" align="center"><?=showicon('plus') ?> Tambah Data</div></a></th>
					</tr>
					 
					<?php									 
					$no = 1;
					if(isset($dt_barang))
					{		
					foreach ($dt_barang->result_array() as $db){					
					?>		
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php if($db['nama_villa'] == "") 
								  {echo "GUDANG";} else {echo $db['nama_villa'];}							  
						; ?></td>
						<td><?php echo $db['nama_kamar']; ?></td>
						<td><?php echo $db['kode_barang']; ?></td>
						<td><?php echo $db['nama_barang']; ?></td>
						<td><?php echo $db['jumlah_barang']; ?></td>
						<td><?php echo $db['harga_satuan']; ?></td>											
						<td><?php if($db['kondisi'] == 1) 
								  {echo "Rusak";} else {echo "Baik";}							  
						; ?></td>					
						
						<td align="center"><a href="<?php echo base_url(); ?>barang/edit/<?php echo $db['kode_barang']; ?>" class="cbvilla"><div class="btn-edit">
						<?=showicon('pencil') ?> Edit</div></a></td>
						<td align="center"><a href="<?php echo base_url(); ?>barang/hapus/<?php echo $db['kode_barang']; ?>" onclick="return confirm('Anda yakin?');"><div class=
						"btn-delete"><?=showicon('remove') ?> Hapus</div></a></td>
					</tr>
					<?php
						$no++;
						}
					}	
					else
					{
					?>					
						<tr>
							<td colspan="9">Belum ada data</td>
						</tr>
					<?php	
					} 
					?>
					</table>
					
				
				<!-- END OFF DATA INPUT -->
	
		  </div>
		</div>
	  </div>		
	</div>  