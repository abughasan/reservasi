	<div class="panel-group" id="accordion">
	  <div class="panel panel-default">
		<div class="panel-heading">
		  <h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
			  <?=showicon('saved') ?> MASTER DATA KAMAR
			</a>
		  </h4>
		</div>
		<div id="collapseOne" class="panel-collapse collapse in">
		  <div class="panel-body">
				<!-- START DATA INPUT -->
										
					<table class="table table-bordered" border="1">				 
					<tr>				 				
						<th>No</th>
						<th>Nama Kamar</th>						
						<th colspan='3'><a href="<?php echo base_url(); ?>kamar/tambah" class="cbkamar"><div class="btn-add" align="center"><?=showicon('plus') ?> Tambah Data</div></a></th>
					</tr>
					 
					<?php									 
					$no = 1;
					if(isset($dt_kamar))
					{		
					foreach ($dt_kamar->result_array() as $db){					
					?>		
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $db['nama_kamar']; ?></td>					
						
						<td align="center"><a href="<?php echo base_url(); ?>kamar/edit/<?php echo $db['id_kamar']; ?>" class="cbvilla"><div class="btn-edit">
						<?=showicon('pencil') ?> Edit</div></a></td>
						<td align="center"><a href="<?php echo base_url(); ?>kamar/hapus/<?php echo $db['id_kamar']; ?>" onclick="return confirm('Anda yakin?');"><div class=
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
							<td colspan="7">Belum ada data</td>
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