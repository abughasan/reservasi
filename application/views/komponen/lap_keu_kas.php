<?php $det = $this->app_model->getSelectedData('tbl_transaksi',array('no_transaksi'=>$this->uri->segment(3)))->row(); ?>
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
			  <h1>LAPORAN KAS PT. VILLA DELIMA</h1>			  
			  <strong> Berdasarkan Tanggal : <?php echo $tgl1 = $this->session->userdata('mulai') ;?> s.d <?php echo $tgl2 = $this->session->userdata('akhir') ;?></strong> <br/>
			  <small> Tanggal Cetak : <?=date('d/m/Y')?></small>
			</div>
		</div>
		<br>
		<br>
		
		  <!-- START DATA INPUT -->
		
				<h3>KAS KASIR</h3>
				<table class="table">

					<!--start kasir-->
					
					<tr class="active">

						<td><b>a. Kas Kasir (Pemasukan)</b></td>
						
						<td></td>

						<td></td>

					</tr>

					<?php $i=0; foreach ($pemasukan_kasir->result() as $d) : $i++; ?>

					<tr>
						
						<td><?=$i?>.&ensp; <?=$d->tanggal_transaksi?> <?=$d->keterangan?></td>						
						
						<td class="text-right"><?=angka($d->debet)?></td>

						<td class="text-right"></td>

					</tr>

					<?php endforeach; ?>

					<tr>

						<td><b>Total Pemasukan</b></td>

						<td></td>

						<td class="text-right success"><?=angka($pemasukan_total_kasir)?></td>

					</tr>	
					
					<tr class="active">

						<td><b>b. Kas Kasir (Pengeluaran)</b></td>

						<td></td>

						<td></td>

					</tr>

					<?php $a=0; foreach ($pengeluaran_kasir->result() as $k) : $a++; ?>

					<tr>

						<td><?=$a?>.&ensp; <?=$d->tanggal_transaksi?> <?=$k->keterangan?></td>

						<td class="text-right"><?=angka($k->kredit)?></td>

						<td class="text-right"></td>

					</tr>

					<?php endforeach; ?>

					<tr>

						<td><b>Total Pengeluaran</b></td>

						<td></td>

						<td  class="text-right danger"><?=angka($pengeluaran_total_kasir)?></td>

					</tr>

					<?php $lr = $pemasukan_total_kasir-$pengeluaran_total_kasir; ?>

					<tr>

						<td colspan=3></td>

					</tr>

					<tr class="active">

						<td><b>Selisih Pemasukan dan Pengeluaran</b></td>

						<td class="text-right"><b><?PHP if($lr>0) : echo "SELISIH"; elseif($lr==0): echo "-"; else: echo "SELISIH"; endif; ?></b></td>

						<td class="text-right <?PHP if($lr>=0) : echo "success"; else: echo "danger"; endif; ?>"><?=angka($lr)?></td>

					</tr>
					</table>
					
					
					<div class="cleaner_h20"></div> 
					<h3>KAS PETTY CASH</h3>
					<!--star bank -->
					
					<table class="table">
					
					<tr class="active">

						<td><b>a. Petty Cash (Pemasukan)</b></td>

						<td></td>

						<td></td>

					</tr>

					<?php $i=0; foreach ($pemasukan_petty->result() as $p) : $i++; ?>

					<tr>

						<td><?=$i?>.&ensp; <?=$d->tanggal_transaksi?>  <?=$p->keterangan?></td>

						<td class="text-right"><?=angka($p->debet)?></td>

						<td class="text-right"></td>

					</tr>

					<?php endforeach; ?>

					<tr>

						<td><b>Total Pemasukan</b></td>

						<td></td>

						<td class="text-right success"><?=angka($pemasukan_total_petty)?></td>

					</tr>	
					
					<tr class="active">

						<td><b>b. Petty Cash (Pengeluaran)</b></td>

						<td></td>

						<td></td>

					</tr>

					<?php $a=0; foreach ($pengeluaran_petty->result() as $y) : $a++; ?>

					<tr>

						<td><?=$a?>.&ensp; <?=$d->tanggal_transaksi?>  <?=$y->keterangan?></td>

						<td class="text-right"><?=angka($y->kredit)?></td>

						<td class="text-right"></td>

					</tr>

					<?php endforeach; ?>

					<tr>

						<td><b>Total Pengeluaran</b></td>

						<td></td>

						<td class="text-right danger"><?=angka($pengeluaran_total_petty);?></td>

					</tr>

					<?php $pt = $pemasukan_total_petty-$pengeluaran_total_petty; ?>

					<tr>

						<td colspan=3></td>

					</tr>
					<tr class="active">

						<td><b>Selisih Pemasukan dan Pengeluaran</b></td>

						<td class="text-right"><b><?PHP if($pt>0) : echo "SELISIH"; elseif($pt==0): echo "-"; else: echo "SELISIH"; endif; ?></b></td>

						<td class="text-right <?PHP if($pt>=0) : echo "success"; else: echo "danger"; endif; ?>"><?=angka($pt)?></td>

					</tr>

				</table>


					<div class="cleaner_h20"></div> 
					<h3>KAS BANK</h3>

					<!--star BANK-->
					
					<table class="table">
					
					<tr class="active">

						<td><b>a. Kas Bank (Pemasukan)</b></td>

						<td></td>

						<td></td>

					</tr>

					<?php $i=0; foreach ($pemasukan_bank->result() as $b) : $i++; ?>

					<tr>

						<td><?=$i?>.&ensp; <?=$d->tanggal_transaksi?>  <?=$b->keterangan?></td>

						<td class="text-right"><?=angka($b->debet)?></td>

						<td class="text-right"></td>

					</tr>

					<?php endforeach; ?>

					<tr>

						<td><b>Total Pemasukan</b></td>

						<td></td>

						<td class="text-right success"><?=angka($pemasukan_total_bank)?></td>

					</tr>	
					
					<tr class="active">

						<td><b>b. Kas Bank (Pengeluaran)</b></td>

						<td></td>

						<td></td>

					</tr>

					<?php $a=0; foreach ($pengeluaran_bank->result() as $n) : $a++; ?>

					<tr>

						<td><?=$a?>.&ensp; <?=$d->tanggal_transaksi?>  <?=$n->keterangan?></td>

						<td class="text-right"><?=angka($n->kredit)?></td>

						<td class="text-right"></td>

					</tr>

					<?php endforeach; ?>

					<tr>

						<td><b>Total Pengeluaran</b></td>

						<td></td>

						<td  class="text-right danger"><?=angka($pengeluaran_total_bank)?></td>

					</tr>

					<?php $bk = $pemasukan_total_bank-$pengeluaran_total_bank; ?>

					<tr>

						<td colspan=3></td>

					</tr>
					<tr class="active">

						<td><b>Selisih Pemasukan dan Pengeluaran</b></td>

						<td class="text-right"><b><?PHP if($bk>0) : echo "SELISIH"; elseif($bk==0): echo "-"; else: echo "SELISIH"; endif; ?></b></td>

						<td class="text-right <?PHP if($bk>=0) : echo "success"; else: echo "danger"; endif; ?>"><?=angka($bk)?></td>

					</tr>

				</table>
	
			<!-- END OFF DATA INPUT -->
		<div class="cleaner_h20"></div>

	</div>