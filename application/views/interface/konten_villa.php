	<div class="panel-group" id="accordion">
	  <div class="panel panel-default">
		<div class="panel-heading">
		  <h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
			  <?=showicon('saved') ?> MASTER DATA VILLA 
			</a>
		  </h4>
		</div>
		<div id="collapseOne" class="panel-collapse collapse in">
		
		  <div class="panel-body">
				<!-- START DATA INPUT -->
										
			<table class="table table-bordered" border="0">				 			
			<tr	>
				<th>No.</th>
				<th>Kode Villa</th>
				<th>Nama VIlla</th>
				<th>Tarif VIlla</th>
				<th>Gambar</th>
				<th>Diskon</th>
				
				<th colspan="3"> <a href="<?=base_url()?>villa/tambah" ><div class="btn-add" align="center"><?=showicon('floppy-disk')?> Tambah Data</div></a></th>

 			</tr>
			<?php
				$no = 1;
				if($dt_villa->num_rows()>0)
				{
					foreach($dt_villa -> result_array() as $db)
					{
				?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $db['kode_villa']; ?></td>
					<td><?php echo $db['nama_villa']; ?></td>
					<td>Rp. <?php echo number_format($db['tarif_villa'],2,'.',','); ?></td>					
					<td><img src="<?php echo base_url()."upload/thumb/".$db['url']; ?>" class="img-thumbnail"/></td>					
					<td><code><?php echo $db['diskon']*100; ?> %</code></td>					
					<td align="center"><a href="<?php echo base_url(); ?>villa/edit/<?php echo $db['kode_villa']; ?>" class="cbvilla"><div class="btn-edit">
					<?=showicon('pencil')?> Edit</div></a></td>
					<td align="center"><a href="<?php echo base_url(); ?>villa/hapus/<?php echo $db['kode_villa']; ?>" onclick="return confirm('Anda yakin?');"><div class=
					"btn-delete"><?=showicon('remove')?> Hapus</div></a></td>
				</tr>
				<?php
					$no++;
					}
				}
				else
				{
					?>
					
				<tr>
					<td colspan="6">Belum ada data</td>
				</tr>
					<?php
				}
			?>
		</table>
		
		
			<tr align="center">
				<td>
					<?php
						echo $paginator;
					?>
				</td>
			</tr>
		
					<!-- END OFF DATA INPUT -->
	
		  </div>
		</div>
	  </div>		
	</div>

<!-- START MODAL -->

