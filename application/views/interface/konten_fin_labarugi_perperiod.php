<div class="panel panel-default">	
<div class="panel panel-default">	

		<div class="panel-heading">

		  <h4 class="panel-title">			

			<?=showicon('cloud-download');?> CATATAN LABA RUGI PER PERIODE
			
		  </h4>

		</div>

		<div class="panel-body">						

			<!-- Begin-->		
			<div class="span6 pull-right">
			<?php echo form_open("fin_labarugi_perperiod", 'class="navbar-form pull-right"'); ?>
				
				<div class="span6 pull-right">
					<input type="" placeholder="Masukan Tanggal" class="form-control" name="tgl1" id="tgl1" data-provide="datepicker" data-date-autoclose="true" data-date="date(yyyy-mm-dd)" data-date-format="yyyy-mm-dd" required/>											
					<input type="" placeholder="Masukan Tanggal" class="form-control" name="tgl2" id="tgl2" data-provide="datepicker" data-date-autoclose="true" data-date="date(yyyy-mm-dd)" data-date-format="yyyy-mm-dd" required/>															
					<button name="submit" type="submit" class="btn btn-primary"><i class="icon-search icon-white"></i> Cari Data</button>
					<a href="fin_labarugi_perperiod/cetak" target="_blank" class="btn btn-default"><?=showicon('print');?> Cetak </a>
				</div>
			<?php echo form_close(); ?>
			</div>
			
			<div class="cleaner_h5"></div>	
			<hr>

			<!-- Start data input -->
			<p class="text-center"><strong><font size="5">LAPORAN LABA RUGI PT. VILLA DELIMA</font></strong><br/>Periode : <?=$this->session->userdata('mulai');?> - <?=$this->session->userdata('akhir');?></p>
			<br/>	
					<table class="table table-bordered table-hover">
					
					<tr class="active">

						<td><b>a. PEMASUKAN</b></td>
						
						<td>Tanggal</td>

												
						<td>Nilai</td>
						

					</tr>

					<?php $i=0; foreach ($pemasukan->result() as $d) : $i++; ?>

					<tr>
						

						<td><?=$i?>.  <?=$d->keterangan?></td>
						
						<td><?=$d->tanggal_transaksi;?></td>

						<td class="text-right"><?=angka($d->debet)?></td>						

					</tr>

					<?php endforeach; ?>
					

					<tr>

						<td><b>Total Pemasukan</b></td>

						<td></td>

						<td class="text-right success"><?=angka($pemasukan_total)?></td>

					</tr>	
					
					<tr>
						<td callspan='3'></td>
					</tr>
					
					<tr class="active">

						<td><b>b. PENGELUARAN</b></td>

						<td>Tanggal</td>
						
						<td>Nilai</td>

					</tr>

					<?php $a=0; foreach ($pengeluaran->result() as $k) : $a++; ?>

					<tr>

						<td>&ensp;b. <?=$a?> <?=$k->keterangan?></td>
						
						<td><?=$k->tanggal_transaksi?></td>

						<td class="text-right"><?=angka($k->kredit)?></td>

						

					</tr>

					<?php endforeach; ?>

					<tr>

						<td><b>Total Pengeluaran</b></td>

						<td></td>

						<td  class="text-right danger"><?=angka($pengeluaran_total)?></td>

					</tr>

					<?php $lr = $pemasukan_total-$pengeluaran_total; ?>

					<tr>

						<td colspan=2></td>

					</tr>

					<tr class="active">

						<td><b>Selisih Pemasukan dan Pengeluaran</b></td>

						<td class="text-right"><b><?PHP if($lr>0) : echo "LABA"; elseif($lr==0): echo "-"; else: echo "RUGI"; endif; ?></b></td>

						<td class="text-right <?PHP if($lr>=0) : echo "success"; else: echo "danger"; endif; ?>"><?=angka($lr)?></td>

					</tr>

				</table>
			
			<!--end data-->	
		</div>

	</div>

	
	
	
<script>
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