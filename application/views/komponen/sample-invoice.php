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
			  <h1>INVOICE</h1>
			  <h1><small>No Transaksi #<?=$this->uri->segment(3)?></small></h1>
			</div>
		</div>

		  <div class="row">
		    <div class="col-xs-5 ">
		      <div class="panel panel-default hide">
		              <div class="panel-heading">
		                <h4>From: <a href="#">Your Name</a></h4>
		              </div>
		              <div class="panel-body">
		                <p>
		                  Address <br>
		                  details <br>
		                  more <br>
		                </p>
		              </div>
		            </div>
		    </div>
		    <div class="col-xs-5 col-xs-offset-2 text-right">
		      <div class="panel panel-default">
		              <div class="panel-heading">
		                To : <a href="#"><?=$this->app_model->getSelectedData('tbl_tamu',array('id_tamu'=>$inv->id_tamu))->row()->nama_tamu?></a>
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
            <td><?=$this->app_model->getSelectedData('tbl_villa',array('kode_villa'=>$inv->kode_villa))->row()->nama_villa?></td>
            <td class="text-right"><span class="pull-left">Rp</span> <?=number_format($this->app_model->getSelectedData('tbl_villa',array('kode_villa'=>$inv->kode_villa))->row()->tarif_villa,2,',','.')?></td>
            <td class="text-center"><?=$inv->tgl_cekin?> / <?=$inv->tgl_cekout?></td>
             <td class="text-center"><?=$inv->lama_hari?></td>
              <td class="text-right"><span class="pull-left">Rp</span> <?=number_format($inv->dapat_harga,2,',','.')?></td>
          </tr>
        </tbody>
      </table>

		<div class="row text-right">
			<div class="col-xs-2 col-xs-offset-8">
				<p>
					<strong>
						Uang Muka : <br>
						Sisa Bayar : <br>
					</strong>
				</p>
			</div>
			<div class="col-xs-2">
				<strong><span class="pull-left">Rp</span>
					<?=number_format($this->app_model->manualQuery("
						SELECT jml_bayar FROM tbl_pembayaran 
						WHERE no_transaksi = '{$inv->no_transaksi}'
						ORDER BY id_bayar ASC LIMIT 1
						")->row()->jml_bayar,2,',','.')?> <br>
						<span class="pull-left">Rp</span>
					<?=number_format($inv->dapat_harga-$this->app_model->manualQuery("
						SELECT SUM(jml_bayar) sum FROM tbl_pembayaran 
						WHERE no_transaksi = '{$inv->no_transaksi}'
						")->row()->sum,2,',','.')?> <br>
				</strong>
			</div>
		</div>
		
		<div class="cleaner_h20"></div>

<!--
		<div class="row">
		  <div class="col-xs-5">
		    <div class="panel panel-info">
			  <div class="panel-heading">
			    <h4>Bank details</h4>
			  </div>
			  <div class="panel-body">
			    <p>Your Name</p>
			    <p>Bank Name</p>
			    <p>SWIFT : --------</p>
			    <p>Account Number : --------</p>
			    <p>IBAN : --------</p>
			  </div>
			</div>
		  </div>
		  <div class="col-xs-7">
		   <div class="span7">
			  <div class="panel panel-info">
			    <div class="panel-heading">
			      <h4>Contact Details</h4>
			    </div>
			    <div class="panel-body">
			      <p>
			        Email : you@example.com <br><br>
			        Mobile : -------- <br> <br>
			        Twitter  : <a href="https://twitter.com/tahirtaous">@TahirTaous</a>
			      </p>
			      <h4>Payment should be mabe by Bank Transfer</h4>
			    </div>
			  </div>
			</div>
		  </div>
		</div>
-->
	</div>
	