<div class="panel-group" id="accordion">
	<div class="panel panel-default">
		<div class="panel-heading">
		  <h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
			  <?=showicon('saved') ?> CATATAN DATA TRANSAKSI
			</a>
		  </h4>
		</div>
		
		<div id="collapseOne" class="panel-collapse collapse in">
		<div class="panel-body">
		
		<div class="span6 pull-right">
		<?php echo form_open("transaksi/cari", 'class="navbar-form pull-right"'); ?>
		  <input type="text" class="form-control" maxlength="10" name="cari" placeholder="Masukkan No Transaksi" required/>
		  <button type="submit" class="btn btn-success"><i class="icon-search icon-white"></i> Cari Data</button>
		<?php echo form_close(); ?>
		</div>
		  
		  <!-- START DATA INPUT -->
		  
		<table class="table table-bordered">				 
			<tr>
				<th>No Transaksi</td>
				<th>Tgl transaksi</td>				
				<th>Nama/ID</td>
				<th>Villa</td>
				<th>Lama Hari</td>
				<th>Total Harga</td>
				<th>Bayar</td>
				<th>Sisa Bayar</td>
				<th>Aksi</td>
			</tr>
		
		<tbody>
			<?php
				$no = 1;
				if($dt_transaksi->num_rows()>0)
				{
					foreach($dt_transaksi->result_array() as $db)
					{
				?>
				
				<tr>
				
					<td><a href="detail/<?=$db['no_transaksi']?>" target="_blank"><?=$db['no_transaksi']?></a></td>
					<td><?=$db['tgl_transaksi']?></td>
					<td>
					<?php 
					error_reporting(0);
					$tamuini = $this->app_model->getSelectedData('tbl_tamu',array('id_tamu'=>$db['id_tamu']))->row(); ?>
					<span class="namadetail" data-container="body" data-toggle="popover" data-placement="top" 
					data-content="<?=$tamuini->no_kartu_id?><br/><?=$tamuini->alamat_tamu?><br/><?=$tamuini->tlp?>"
					data-trigger="hover focus" data-html="true"
					>
					<?=$tamuini->nama_tamu?><?=$tamuini->no_kartu_id?>
					</span>
					</td>
					<td>
					<?php $villaini = $this->app_model->getSelectedData('tbl_villa',array('kode_villa'=>$db['kode_villa']))->row(); ?>
					<?=$villaini->nama_villa?></td>					
										
					<td><?php echo $db['lama_hari']; ?></td>					
					<td><?php echo $db['dapat_harga']; ?></td>					
					<td><?php echo $db['bayar']; ?></td>					
					<td><?php echo $db['sisa_bayar']; ?></td>					
					<td>
						<a href="#" class="btn btn-warning" data-toggle="modal" data-target="#myModal">Detail</div></a>
						<a href="bayar/<?=$db['no_transaksi']?>"><div class="btn btn-default">Bayar</div></a>						
					</td>
				
				</tr>
				<?php
					$no++;
					}
				}
				else
				{
				?>
					
				<tr>
					<td colspan="<?=count($list_field)?>">Tidak Ada Nomor Transaksi yang sama</td>
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

<!--modal test-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h3 class="modal-title" id="myModalLabel">DETAIL</h3>
      </div>
      <div class="modal-body">
        
		<!-- buat detail disini -->
		<div class="panel panel-warning">
		  <!-- Default panel contents -->
		  <div class="panel-heading">DATA TRANSAKSI</div>
		  <!-- pake table -->
			<table class="table asik">
				<tr>
					<!--batas kiri-->
					<td width="20%">Nomor Transaksi </td>
					<td width="3%"> : </td>
					<td width="27%">TR0001</td>
					<!--batas kanan-->
					<td width="20%">Nomor Transaksi </td>
					<td width="3%"> : </td>
					<td width="27%">TR0001</td>
				</tr>
				<tr>
					<!--batas kiri-->
					<td width="20%">Nomor Transaksi </td>
					<td width="3%"> : </td>
					<td width="27%">TR0001</td>
					<!--batas kanan-->
					<td width="20%">Nomor Transaksi </td>
					<td width="3%"> : </td>
					<td width="27%">TR0001</td>
				</tr>
				<tr>
					<!--batas kiri-->
					<td width="20%">Nomor Transaksi </td>
					<td width="3%"> : </td>
					<td width="27%">TR0001</td>
					<!--batas kanan-->
					<td width="20%">Nomor Transaksi </td>
					<td width="3%"> : </td>
					<td width="27%">TR0001</td>
				</tr>
			</table>			
		</div>
		
		<div class="panel panel-warning">
		  <!-- Default panel contents -->
		  <div class="panel-heading">DATA TAMU</div>

		  <!-- Table -->
		  <table class="table asik">
				<tr>
					<!--batas kiri-->
					<td width="20%">Nomor Transaksi </td>
					<td width="3%"> : </td>
					<td width="27%">TR0001</td>
					<!--batas kanan-->
					<td width="20%">Nomor Transaksi </td>
					<td width="3%"> : </td>
					<td width="27%">TR0001</td>
				</tr>
				<tr>
					<!--batas kiri-->
					<td width="20%">Nomor Transaksi </td>
					<td width="3%"> : </td>
					<td width="27%">TR0001</td>
					<!--batas kanan-->
					<td width="20%">Nomor Transaksi </td>
					<td width="3%"> : </td>
					<td width="27%">TR0001</td>
				</tr>
				<tr>
					<!--batas kiri-->
					<td width="20%">Nomor Transaksi </td>
					<td width="3%"> : </td>
					<td width="27%">TR0001</td>
					<!--batas kanan-->
					<td width="20%">Nomor Transaksi </td>
					<td width="3%"> : </td>
					<td width="27%">TR0001</td>
				</tr>
			</table>			
		</div>
		
		<div class="panel panel-warning">
		  <!-- Default panel contents -->
		  <div class="panel-heading">DATA VILLA</div>

		  <!-- Table -->
		  <table class="table asik">
				<tr>
					<!--batas kiri-->
					<td width="20%">Nomor Transaksi </td>
					<td width="3%"> : </td>
					<td width="27%">TR0001</td>
					<!--batas kanan-->
					<td width="20%">Nomor Transaksi </td>
					<td width="3%"> : </td>
					<td width="27%">TR0001</td>
				</tr>
				<tr>
					<!--batas kiri-->
					<td width="20%">Nomor Transaksi </td>
					<td width="3%"> : </td>
					<td width="27%">TR0001</td>
					<!--batas kanan-->
					<td width="20%">Nomor Transaksi </td>
					<td width="3%"> : </td>
					<td width="27%">TR0001</td>
				</tr>
				<tr>
					<!--batas kiri-->
					<td width="20%">Nomor Transaksi </td>
					<td width="3%"> : </td>
					<td width="27%">TR0001</td>
					<!--batas kanan-->
					<td width="20%">Nomor Transaksi </td>
					<td width="3%"> : </td>
					<td width="27%">TR0001</td>
				</tr>
			</table>
		</div>
		
		<div class="panel panel-warning">
		  <!-- Default panel contents -->
		  <div class="panel-heading">DATA GUIDE</div>

		  <!-- Table -->
		  <table class="table asik">
				<tr>
					<!--batas kiri-->
					<td width="20%">Nomor Transaksi </td>
					<td width="3%"> : </td>
					<td width="27%">TR0001</td>
					<!--batas kanan-->
					<td width="20%">Nomor Transaksi </td>
					<td width="3%"> : </td>
					<td width="27%">TR0001</td>
				</tr>
				<tr>
					<!--batas kiri-->
					<td width="20%">Nomor Transaksi </td>
					<td width="3%"> : </td>
					<td width="27%">TR0001</td>
					<!--batas kanan-->
					<td width="20%">Nomor Transaksi </td>
					<td width="3%"> : </td>
					<td width="27%">TR0001</td>
				</tr>
				<tr>
					<!--batas kiri-->
					<td width="20%">Nomor Transaksi </td>
					<td width="3%"> : </td>
					<td width="27%">TR0001</td>
					<!--batas kanan-->
					<td width="20%">Nomor Transaksi </td>
					<td width="3%"> : </td>
					<td width="27%">TR0001</td>
				</tr>
			</table>
		</div>
		
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>     
      </div>
    </div>
  </div>
</div>


<script>
$('.namadetail').popover();
</script>
