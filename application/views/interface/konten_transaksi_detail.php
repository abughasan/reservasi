<div class="panel-group" id="accordion">
	<div class="panel panel-default">
		<div class="panel-heading">
		  <h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
			  <?=showicon('saved') ?> CATATAN DATA TRANSAKSI
			</a>
		  </h4>
		</div>
		
		<div id="collapseOne" class="panel-collapse collapse in">
		<div class="panel-body">
		
		<div class="span6 pull-right">
		<?php echo form_open("transaksi/cari", 'class="navbar-form pull-right"'); ?>
		  <input type="text" class="form-control" maxlength="10" name="cari" placeholder="Masukkan No Transaksi" required/>
		  <button type="submit" class="btn btn-success"><i class="icon-search icon-white"></i> Cari Data</button>
		<?php echo form_close(); ?>
		</div>
		  
		  <!-- START DATA INPUT -->
		  
		<table class="table table-bordered">				 
			<tr>
				<th>No Trans</th>
				<th>Tgl Transaksi</th>
				<th>Tamu</th>
				<th>Villa</th>
				<th>Check-In</th>
				<th>Check-Out</th>
				<th>Lama Hari</th>
				<th>Harga</th>
				<th>Bayar</th>
				<th>Sisa Bayar</th>
				<th>Guide</th>
				
				
			</tr>
		
		<tbody>
			<?php
				$no = 1;
				if($dt_villa->num_rows()>0)
				{
					foreach($dt_villa->result_array() as $db)
					{
				?>
				
				<tr>
				
					<td><a href="transaksi_detail"><?=$db['no_transaksi']?></a></td>
					<td><?php echo $db['tgl_transaksi']; ?></td>
					<td>
					<?php 
					error_reporting(0);
					$tamuini = $this->app_model->getSelectedData('tbl_tamu',array('id_tamu'=>$db['id_tamu']))->row(); ?>
					<span class="namadetail" data-container="body" data-toggle="popover" data-placement="top" 
					data-content="<?=$tamuini->no_kartu_id?><br/><?=$tamuini->alamat_tamu?><br/><?=$tamuini->tlp?>"
					data-trigger="hover focus" data-html="true"
					>
					<?=$tamuini->nama_tamu?>
					</span>
					</td>
					<td>
					<?php $villaini = $this->app_model->getSelectedData('tbl_villa',array('kode_villa'=>$db['kode_villa']))->row(); ?>
					<?=$villaini->nama_villa?></td>					
					<td>
					<?php 
						echo "<kbd>".$db['tgl_cekin']."</kbd>"; 
					?>
					</td>					
					<td>
					<?php 
						echo "<code>".$db['tgl_cekin']."<code>"; 
					?>
					</td>					
					<td><?php echo $db['lama_hari']; ?></td>					
					<td><?php echo $db['dapat_harga']; ?></td>					
					<td><?php echo $db['bayar']; ?></td>					
					<td><?php echo $db['sisa_bayar']; ?></td>					
					<td><?php echo $db['id_guide']; ?></td>
				
				</tr>
				<?php
					$no++;
					}
				}
				else
				{
				?>
					
				<tr>
					<td colspan="<?=count($list_field)?>">Tidak Ada Nomor Transaksi yang sama</td>
				</tr>
						<?php
					}
				?>
		
		
				<tr align="center">
					<td colspan="<?=count($list_field)?>">
						<?php
							echo $paginator;
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
