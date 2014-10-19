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
			    <img width="120" style="position:absolute;"src="<?=base_url();?>assets/img/logo.png"/>				
			  </h1>
			</div>
			<div style="margin-left:150px;">
			  <h1>DATA INVENTORI</h1>			  
			  <strong>Villa Dlima Puncak Bogor</strong> <br/>
			  <small>Tanggal Cetak : <?=date('d/m/Y')?></small>
			</div>
		</div>
		<div class="cleaner_h30"></div>
		  <!-- START DATA INPUT -->
		<table class="table table-bordered">				 
			<tr>
				<th>No</th>
				<th>Nama Villa</th>
				<th>Nama Kamar</th>
				<th>Nama Barang</th>
				<th>Jumlah</th>
				<th>Keterangan</th>				
			</tr>
		
		<tbody>
			<?php									 
					$no = 1;
					if(isset($dt_barang))
					{		
					foreach ($dt_barang->result_array() as $db){					
					?>		
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $db['kode_villa']; ?> - <?php echo $db['nama_villa']; ?></td>
						<td><?php echo $db['nama_kamar']; ?></td>
						<td><?php echo $db['nama_barang']; ?></td>
						<td><?php echo $db['jumlah_barang']; ?></td>
						<td></td>											
						
					</tr>
					<?php
						$no++;
						}
					}	
					else
					{
					?>					
						<tr>
							<td colspan="7">Belum ada data</td>
						</tr>
					<?php	
					} 
					?>
		
		
				<tr align="center">				
						<?php
							echo $paginator;
						?>
					</td>
				</tr>
			</tbody>
		</table>
	
			<!-- END OFF DATA INPUT -->
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