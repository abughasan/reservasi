<div class="panel-group" id="accordion">
  <div class="panel panel-default">
	<div class="panel-heading">
	  <h4 class="panel-title">
		<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
		  <?=showicon('saved') ?> DATA TAMU
		</a>
	  </h4>
	</div>
	<div id="collapseOne" class="panel-collapse collapse in">		
	  <div class="panel-body">		  
	  
			<!-- START CARI TAMU -->		
			<div class="span6 pull-right">
					<?php echo form_open("tamu/cari", 'class="navbar-form pull-right"'); ?>
						
						<div class="span6 pull-right">							
							<input type="text" placeholder="Masukan Nama" class="form-control" name="cari" id="cari" />															
							<button name="submit" type="submit" class="btn btn-primary"><i class="icon-search icon-white"></i> Cari Data</button>					
						</div>
					<?php echo form_close(); ?>
			</div>		  
			
		<!-- START DATA INPUT -->		
		
		<table class="table table-bordered" border="0">				 			
			<tr >
				<th>No.</th>
				<th>Jenis Kartu ID</th>
				<th>Nomor ID</th>
				<th>Nama Tamu</th>
				<th>Alamat</th>
				<th>No. Telp</th>
				<th>Status</th>
				<th colspan="3"><a href="<?php echo base_url(); ?>tamu/tambah" ><div class="btn-add" align="center"><?=showicon('floppy-save')?> Tambah</div></a></th>
			</tr>
			<?php
				$no = 1;
				if($dt_tamu->num_rows()>0)
				{
					foreach($dt_tamu->result_array() as $db)
					{
				?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $db['jenis_kartu_id']; ?></td>
					<td><?php echo $db['no_kartu_id']; ?></td>
					<td><?php echo $db['nama_tamu']; ?></td>
					<td><?php echo $db['alamat_tamu']; ?></td>					
					<td><?php echo $db['tlp']; ?></td>					
					<td><?php echo $db['status']; ?></td>					
					<td align="center">
					<a href="<?php echo base_url(); ?>tamu/edit/<?php echo $db['id_tamu']; ?>"><div class="btn-edit">
					<?=showicon('pencil') ?> Edit</div></a></td>
					<td align="center">
					<a href="<?php echo base_url(); ?>tamu/hapus/<?php echo $db['id_tamu']; ?>" onclick="return confirm('Anda yakin?');"><div class=
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
					<td colspan="8">Belum ada data</td>
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

