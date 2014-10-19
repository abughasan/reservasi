	<div class="panel-group" id="accordion">
	  <div class="panel panel-default">
		<div class="panel-heading">
		  <h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
			  <?=showicon('saved') ?> MANAJEMEN USER 
			</a>
		  </h4>
		</div>
		<div id="collapseOne" class="panel-collapse collapse in">		
		 <div class="panel-body">
		
			<tr align="center" class="pagination">
				<td>
					<?php
						echo $paginator;
					?>
				</td>
			</tr>
		
		<!-- START DATA INPUT -->
										
			<table class="table table-bordered">				 			
			<tr>
				<th>No.</td>
				<th>Username</td>
				<th>Nama Lengkap</td>
				<th>Status</td>
				<th colspan="3"><a href="<?php echo base_url(); ?>user/tambah" class="cbuser"><div class="btn-add" align="center"><?=showicon('floppy-disk')?> Tambah Data</div></a></th>
			</tr>
			<?php
				$no = 1;
				if($dt_user->num_rows()>0)
				{
					foreach($dt_user->result_array() as $db)
					{
				?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $db['username']; ?></td>
					<td><?php echo $db['nama_pengguna']; ?></td>
					<td><?php echo $db['stts']; ?></td>
					<td align="center"><a href="<?php echo base_url(); ?>user/edit/<?php echo $db['username']; ?>" class="cbuser"><div class="btn-edit">
					Edit Data</div></a></td>
					<td align="center">
					<a href="<?php echo base_url(); ?>user/hapus/<?php echo $db['username']; ?>" onclick="return confirm('Anda yakin?');"><div class=
					"btn-delete">Hapus Data</div></a></td>
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
		
	</div>
				<!-- END OFF DATA INPUT -->
	
		  </div>
		</div>
	  </div>		
	</div>
