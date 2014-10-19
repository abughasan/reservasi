<div class="panel-group" id="accordion">
	<div class="panel panel-primary">
		<div class="panel-heading">
		  <h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
			  <?=showicon('book') ?> LAPORAN TRANSAKSI PERPERIOD
			</a>
		  </h4>
		</div>
		
		<div id="collapseOne" class="panel-collapse collapse in">
		<div class="panel-body">
		
		<div class="span6 pull-right">
		<?php echo form_open("laporan/pertanggal", 'class="navbar-form pull-right"'); ?>
			
			<div class="span6 pull-right">
				<input type="" placeholder="Tanggal Pertama" class="form-control" name="tgl1" id="tgl1" data-provide="datepicker" data-date-autoclose="true" data-date="date(yyyy-mm-dd)" data-date-format="yyyy-mm-dd" required/>											
				<input type="" placeholder="Tanggal Kedua" class="form-control" name="tgl2" id="tgl2" data-provide="datepicker" data-date-autoclose="true" data-date="date(yyyy-mm-dd)" data-date-format="yyyy-mm-dd" required/>															
				<button name="submit" type="submit" class="btn btn-primary"><i class="icon-search icon-white"></i> Cari Data</button>
				<a href="cetak_pertanggal" target="_blank" class="btn btn-default"><?=showicon('print');?> Cetak </a>
			</div>
		<?php echo form_close(); ?>
		</div>
		  
		  <!-- START DATA INPUT -->
		<?php echo $tgl1 = $this->session->userdata('mulai') ;?>/<?php echo $tgl2 = $this->session->userdata('akhir') ;?> 		
		
		<table class="table table-bordered">				 
			<tr>
				<th>No.</th>
				<th>No. Transaksi </th>
				<th>Tanggal</td>
				<th>Nama / No KTP</th>
				<th>Villa</th>
				<th>Check In/Out</th>
				<th>Lama hari</th>
				<th>Total Bayar</th>				
				<th>Status</th>				
			</tr>
		
		<tbody>
			<?php
				$i=1;
				if($dt_transaksi->num_rows()>0)
				{
					foreach($dt_transaksi->result_array() as $db)
					{
				?>
				
				<tr>
					<td><?php echo $i; ?></td>
					<td>
						<a href="detail/<?=$db['no_transaksi']?>" target="_blank"><?=$db['no_transaksi']?></a>
					<td><?php echo $db['tgl_transaksi']; ?></td>
					</td>
					<td>
						<?php echo $db['nama_tamu']; ?>	/
						<?php echo $db['no_kartu_id']; ?>					
					</td>
					<td>						
						<?php $villaini = $this->app_model->getSelectedData('tbl_villa',array('kode_villa'=>$db['kode_villa']))->row(); ?>
						<?=$villaini->kode_villa?>
					</td>
					<td>
						<?php echo "<kbd>".$db['tgl_cekin']."</kbd>";?>
						<?php echo "<code>".$db['tgl_cekout']."<code>";?>
					</td>					
					<td><?php echo $db['lama_hari']; ?></td>					
					<td><?php echo $db['dapat_harga']; ?></td>										
					<td><?php if($db['status_bayar'] == 1)
						{echo "LUNAS";} else {echo " - ";}
						; ?>
					</td>
					
				</tr>
				<?php
					$i++;
					}
				}
				else
				{
				?>
					
				<tr>
					<td colspan="<?=count($list_field)?>">Belum Ada Data</td>
				</tr>
						<?php
					}
				?>
		
		
				<tr align="center">
					<td colspan="<?=count($list_field)?>">
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


	$(function() {
		$( "#tgl1" ).datepicker({
			defaultDate: "+1w",
			dateFormat: "yy-mm-dd",
			// changeMonth: true,
			numberOfMonths: 1,
			onClose: function( selectedDate ) {
				$( "#tgl2" ).datepicker( "option", "minDate", selectedDate );
			}
		});
		$( "#tgl2" ).datepicker({
			defaultDate: "+1w",
			dateFormat: "yy-mm-dd",
			// changeMonth: true,
			numberOfMonths: 1,
			onClose: function( selectedDate ) {
				$( "#tgl1" ).datepicker( "option", "maxDate", selectedDate );				
			}
		});
	});

</script>
