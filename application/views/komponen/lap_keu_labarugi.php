
	<style>
	@import url(http://fonts.googleapis.com/css?family=Bree+Serif);
	body, h1, h2, h3, h4, h5, h6{
		font-family: 'calibri', arial;
	}
	</style>

	<div class="container" style="background:white;width:900px;">
				
		<div class="row">
			<div class="col-xs-6">
			  <h1>
			    <img width="120" style="position:absolute;"src="<?=base_url();?>assets/img/logo.png"/>				
			  </h1>
			</div>
			<div style="margin-left:150px;">
			  <h1>LAPORAN LABA RUGI PT. VILLA DELIMA</h1>			  
			  <strong> Berdasarkan Tanggal : <?php echo $tgl1 = $this->session->userdata('mulai') ;?> s.d <?php echo $tgl2 = $this->session->userdata('akhir') ;?></strong> <br/>
			  <small> Tanggal Cetak : <?=date('d/m/Y')?></small>
			</div>
		</div>
		<br>
		<br>
		
			<!-- START DATA INPUT -->
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
				
	
			<!-- END OFF DATA INPUT -->
			
		<div class="cleaner_h20"></div>

	</div>