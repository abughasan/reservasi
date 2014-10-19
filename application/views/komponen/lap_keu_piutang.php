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
			  <h1>LAPORAN PIUTANG PT. VILLA DELIMA</h1>			  
			  <strong> Berdasarkan Tanggal : <?php echo $tgl1 = $this->session->userdata('mulai') ;?> s.d <?php echo $tgl2 = $this->session->userdata('akhir') ;?></strong> <br/>
			  <small> Tanggal Cetak : <?=date('d/m/Y')?></small>
			</div>
		</div>
		<br>
		<br>
		
			<!-- START DATA INPUT -->
				<table class="table table-bordered table-hover">

					<tr  class="danger">

						<th>NO.</th>
						
						<th>Tanggal</th>

						<th>Keterangan</th>

						<th>Jumlah</th>

					</tr>

					<?php $i=0; foreach ( $keu->result() as $row ) : $i++;?>

					<tr>

						<td><?=$i?></td>
						
						<td><?=$row->tanggal_transaksi?></td>

						<td><?=$row->keterangan?></td>

						<td class="text-right">

							<?php 

								if($row->kredit==0) :

									echo number_format($row->debet,0,'','.');

								else:

									echo '('.number_format($row->kredit,0,'','.').')';

								endif;

							?>

						</td>

					</tr>

					<?php endforeach; ?>

					<?php if ($keu->num_rows() == 0): ?>

						<tr><td colspan=3>Belum ada transaksi</td></tr>

					<?php endif; ?>

					<tr>

						<td colspan=3>Total</td>

						<td class="danger text-right"><b><?=number_format($keu_total_debet-$keu_total_kredit,0,'','.')?></b></td>

					</tr>

				</table>
				
	
			<!-- END OFF DATA INPUT -->
			
		<div class="cleaner_h20"></div>

	</div>