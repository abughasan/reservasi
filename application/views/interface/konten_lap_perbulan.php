<div class="panel-group" id="accordion">
	<div class="panel panel-primary">
		<div class="panel-heading">
		  <h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
			  <?=showicon('book') ?> LAPORAN TRANSAKSI PERBULAN <?=$this->session->userdata("bulan_lap")?>
			</a>
		  </h4>
		</div>
		
		<div id="collapseOne" class="panel-collapse collapse in">
		<div class="panel-body">
		
		<div class="span6 pull-right">
		<?php echo form_open("laporan/perbulan", 'class="navbar-form pull-right"'); ?>
		
			Bulan  		  
			<select name="bulan_cari" class="chzn-select form-control" data-placeholder="Pilih bulan..." style="width:110px;" required>
				<option value=""></option>
				<?php for($i=1;$i<=12;$i++) {
					$i_length=strlen($i);
					if ($i_length==1)
					{
						$i="0".$i;
					}
					else
					{
						$i=$i;
					}
					if($i==$this->session->userdata("bulan_lap"))
					{
				?>
						<option value="<?php echo $i; ?>" selected="selected"><?php echo $i; ?></option>
				<?php }
					else
					{
					?>
						<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
				<?php
					}
					} ?>
			</select>
			Tahun 
			<select name="tahun_cari" class="form-control" placeholder="Pilih tahun..." style="width:110px;" required>
				<option value=""></option>
				<?php for($j=2012;$j<=date('Y');$j++) { 
					if($j==$this->session->userdata("tahun_lap"))
					{
					?>
						<option value="<?php echo $j; ?>" selected="selected"><?php echo $j; ?></option>
					<?php 
					}
					else
					{
					?>
						<option value="<?php echo $j; ?>"><?php echo $j; ?></option>
					<?php 
					}
				} ?>
			</select>	
			Status :
			<select name="status_cari" class="form-control" placeholder="Pilih tahun..." style="width:110px;">
				<option value=""></option>
				<option value="1" <?php (($this->session->userdata("status_lap")=="1") ? print 'selected' : '') ?>>LUNAS</option>
				<option value="0" <?php (($this->session->userdata("status_lap")=="0") ? print 'selected' : '') ?>> - </option>
			</select>	
			<button name="submit" type="submit" class="btn btn-primary"><i class="icon-search icon-white"></i> Cari Data</button>
			<a href="cetak_perbulan" target="_blank" class="btn btn-default"><?=showicon('print');?> Cetak </a>
		<?php echo form_close(); ?>
		</div>
		  
		  <!-- START DATA INPUT -->
		<?php echo $tahun = $this->session->userdata('tahun_lap') ;?>/<?php echo $bulan = $this->session->userdata('bulan_lap') ;?> 		
		
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
</script>
