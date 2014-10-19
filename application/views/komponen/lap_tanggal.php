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
			  <h1>DATA RESERVASI VILLA</h1>			  
			  <strong> Berdasarkan Tanggal : <?php echo $tgl1 = $this->session->userdata('mulai') ;?> s.d <?php echo $tgl2 = $this->session->userdata('akhir') ;?></strong> <br/>
			  <small> Tanggal Cetak : <?=date('d/m/Y')?></small>
			</div>
		</div>
		<div class="cleaner_h30"></div>
		
		  <!-- START DATA INPUT -->
		
		
		<table class="table table-bordered">				 
			<tr>
				<th>No.</th>
				<th>No. Transaksi</th>
				<th>Tanggal</th>
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
					</td>
					<td><?php echo $db['tgl_transaksi']; ?></td>
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