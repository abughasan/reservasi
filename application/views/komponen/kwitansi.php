<?php $det = $this->app_model->getSelectedData('tbl_transaksi',array('no_transaksi'=>$this->uri->segment(3)))->row(); ?>
<style>
	@import url(http://fonts.googleapis.com/css?family=Bree+Serif);
	body, h1, h2, h3, h4, h5, h6{
		font-family: 'calibri', arial;
	}
	</style>

	<div class="container" style="background:white;width:800px;">

		<div class="row">
			<div class="col-xs-6">
			  <h1>
			    <img style="position:absolute;"src="<?=base_url();?>assets/img/logo.png"/>
			  </h1>
			</div>
			<div class="col-xs-6 text-right">
			  <h1>KWITANSI</h1>
			  <h1><small>No Transaksi #<?=$this->uri->segment(3)?></small></h1>
			</div>
		</div>

		  <div class="row">
		    <div class="col-xs-5 ">
		      <div class="panel panel-default">
		              <div class="panel-heading">
		                From: <a href="#">PT. Villa Dalima</a>
		              </div>
		              <div class="panel-body">
		                <p>
		                  Jln. Raya Puncak KM 100 <br>
		                  Bogor <br>
		                  0254-78889999 <br>
		                </p>
		              </div>
		            </div>
		    </div>
		    <div class="col-xs-5 col-xs-offset-2 text-right">
		      <div class="panel panel-default">
		              <div class="panel-heading">
		                For : <a href="#"><?=$this->app_model->getSelectedData('tbl_tamu',array('id_tamu'=>$inv->id_tamu))->row()->nama_tamu?></a>
		              </div>
		              <div class="panel-body">
		                  <?=$this->app_model->getSelectedData('tbl_tamu',array('id_tamu'=>$inv->id_tamu))->row()->alamat_tamu?> <br>
		                  <?=$this->app_model->getSelectedData('tbl_tamu',array('id_tamu'=>$inv->id_tamu))->row()->tlp?> <br>
		                
		              </div>
		            </div>
		    </div>
		  </div> <!-- / end client details section -->

		         <table class="table table-bordered">
        <thead>
          <tr>
            <th><h4>Villa Dipesan</h4></th>
            <th><h4>Tarif</h4></th>
            <th><h4>Tgl CekIn / CekOut</h4></th>
            <th><h4>Lama Hari</h4></th>
            <th><h4>Sub Total</h4></th>
          </tr>
        </thead>
        <tbody>
          <tr>
		  <?php 
			$tarif_villa = $this->app_model->getSelectedData('tbl_villa',array('kode_villa'=>$inv->kode_villa))->row()->tarif_villa; 
			$totalbayarnya = $tarif_villa * $inv->lama_hari + $det->dapat_denda;
			$diskonnya = $totalbayarnya*$inv->dapat_diskon;
		  ?>
            <td><?=$this->app_model->getSelectedData('tbl_villa',array('kode_villa'=>$inv->kode_villa))->row()->nama_villa?></td>
            <td class="text-right"><span class="pull-left">Rp</span> <?=number_format($tarif_villa,2,',','.')?></td>
            <td class="text-center"><?=$inv->tgl_cekin?> / <?=$inv->tgl_cekout?></td>
             <td class="text-center"><?=$inv->lama_hari?></td>
              <td class="text-right"><span class="pull-left">Rp</span> <?=number_format($totalbayarnya,2,',','.')?></td>
          </tr>
        </tbody>
      </table>

	  
		<div class="row text-right">
						<div class="col-xs-6 text-left">
						<h4>History Pembayaran</h4>
							<table class="table table-condensed">
								<thead>
									<tr>
									<th>No</th>
									<th>Tanggal Bayar</th>
									<th>Jumlah Bayar</th>
									<th>Subtotal</th>
									</tr>
								</thead>
								<tbody>
								<?php $subtot = 0;$i=0;
								foreach ($dttrans as $dt) : 
								$i++; ?>
									<tr>
									<td><?=$i?></td>
									<td><?=$dt->tgl_bayar?></td>
									<td><?=number_format($dt->jml_bayar,2,',','.')?></td>
									<td class="telahbayar"><?php $subtot = $subtot + $dt->jml_bayar; echo number_format($subtot,2,',','.')?></td>									
									</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
						</div>
			<div class="col-xs-1">&nbsp;</div>
			<div class="col-xs-2">
				<p>
					<strong>
						<BR/>
						<BR/>
						Total Bayar :  <br>
						Diskon : <br>
						Denda : <br>
						Telah Bayar : <br>
						Sisa Bayar : <br>
					</strong>
				</p>
			</div>
			<div class="col-xs-3">
				<strong>
					SUMMARY<br/>
					---------------------------------------<br/>
					<span class="pull-left">Rp</span><?=number_format($totalbayarnya,2,',','.')?><br/>
					<span class="pull-left">Rp</span><?=number_format($diskonnya,2,',','.')?><br/>
					<span class="pull-left">Rp</span><?=number_format($det->dapat_denda,2,',','.')?><br/>
					<span class="pull-left">Rp</span><span id="telahbayar_sum"></span><br/>
						<span class="pull-left">Rp</span>
					<?=number_format($inv->dapat_harga-$this->app_model->manualQuery("
						SELECT SUM(jml_bayar) sum FROM tbl_pembayaran 
						WHERE no_transaksi = '{$inv->no_transaksi}'
						")->row()->sum+$det->dapat_denda,2,',','.')?> <br>
				</strong>
			</div>

		</div>
		
		<div class="row">

		</div>
		
		<div class="row">

		  <div class="col-xs-12">
		   <div class="span7">
			  <div class="panel panel-default">
			    <div class="panel-heading">
			      Transaksi Verified by 
			    </div>
			    <div class="panel-body">
		  			<div class="col-xs-4 pull-right">
				<?php if($det->dapat_harga+$det->dapat_denda == $totalbayar): ?>
						<h1><span class="label label-success">LUNAS &#x263A;</span></h1>
				<?PHP else: ?>
						<h1><span class="label label-warning">BELUM LUNAS &#x2639;</span></h1>
				<?PHP endif; ?>
					</div>
			      <p>
			        Operator : <?=$this->session->userdata('username')?> (<?=$this->app_model->getSelectedData('tbl_login',array('username'=>$this->session->userdata('username')))->row()->stts?>) <br>
			        Printed via : <?=gethostbyaddr($_SERVER['REMOTE_ADDR'])." @ IP ".$_SERVER['REMOTE_ADDR']?> <br>
			        Browser : <?=$_SERVER['HTTP_USER_AGENT']?> <br>
			      </p>
			    </div>
			  </div>
			</div>
		  </div>
		</div>

	</div>
	<script>
		$('#telahbayar_sum').html($('.telahbayar:last').html());
		// alert($('#telahbayar').val())
	</script>