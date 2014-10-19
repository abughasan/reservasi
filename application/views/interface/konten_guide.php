	<div class="panel-group" id="accordion">
	  <div class="panel panel-default">
		<div class="panel-heading">
		  <h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
			  <?=showicon('saved') ?> MASTER DATA GUIDE
			</a>
		  </h4>
		</div>
		<div id="collapseOne" class="panel-collapse collapse in">
		  <div class="panel-body">
				<!-- START DATA INPUT -->
										
			<table class="table table-bordered">				 
			
			<tr >
				<th>No.</th>
				<th>Kode Guide</th>
				<th>No. KTP</th>
				<th>Nama Guide</th>
				<th>Alamat</th>
				<th>No. Telepon</th>
				<th>Sisa Pembayaran</th>
				<th>Status Guide</th>
				
				<th colspan="3"><a href="<?php echo base_url(); ?>guide/tambah" ><div class="btn-ad" align="center"><?=showicon('floppy-disk')?> Tambah Data</div></a></th>
			</tr>
			<?php
				$no = 1;
				if($dt_guide->num_rows()>0)
				{
					foreach($dt_guide -> result_array() as $db)
					{
				?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $db['kode_guide']; ?></td>
					<td><?php echo $db['no_ktp']; ?></td>
					<td><?php echo $db['nama_guide']; ?></td>
					<td><?php echo $db['alamat']; ?></td>
					<td><?php echo $db['no_telp']; ?></td>
					<td><?php echo $db['sisa_pembayaran']; ?></td>
					<td><?php if($db['stts_guide'] == "1"){ 
						echo "Blacklist";
						} else { 
						echo "-";
					 }?></td>
					
					<td align="center"><a href="<?php echo base_url(); ?>guide/edit/<?php echo $db['kode_guide']; ?>" class="cbguide"><div class="btn-edit">
					<?=showicon('pencil') ?> Edit</div></a></td>
					<td align="center"><a href="<?php echo base_url(); ?>guide/hapus/<?php echo $db['kode_guide']; ?>" onclick="return confirm('Anda yakin?');"><div class=
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
	
<!--<div class="panel panel-default">
   Default panel contents 
  <div class="panel-heading">Panel heading</div>
  <div class="panel-body">
    <p>...</p>
  </div>

  <!-- Table -->
  
	
