		<div class="cleaner_h10"></div>	
					<!--START DATA CARI
					<div class="span6 pull-right">
					<?php echo form_open("transaksi_checkin/pertanggal", 'class="navbar-form pull-right"'); ?>
						
						<div class="span6 pull-right">
							<input type="" placeholder="Tanggal Transaksi Awal" class="form-control" name="tgl1" id="tgl1" data-provide="datepicker" data-date-autoclose="true" data-date="date(yyyy-mm-dd)" data-date-format="yyyy-mm-dd" required/>											
							<input type="" placeholder="Tanggal Transaksi Akhir" class="form-control" name="tgl2" id="tgl2" data-provide="datepicker" data-date-autoclose="true" data-date="date(yyyy-mm-dd)" data-date-format="yyyy-mm-dd" required/>															
							<button name="submit" type="submit" class="btn btn-primary"><i class="icon-search icon-white"></i> Cari Data</button>					
						</div>
					<?php echo form_close(); ?>
					</div>
					<div class="cleaner_h10"></div>	
					<!-- END DATA CARI-->
				<table class="table table-bordered">				 			
				<thead>
					<tr >
						<th>No.</td>
						<th>No. Trans</td>
						<th>Tgl Transaksi</td>
						<th>Tamu</td>
						<th>Villa</td>
						<th>Check-In</td>
						<th>Check-Out</td>
						<th>Jumlah</td>						
						<th colspan="2">Aksi</td>						
					</tr>
				</thead>
				<tbody>
					<?php
						$no = 1;
						if($detail_transaksi->num_rows()>0)
						{
							foreach($detail_transaksi->result_array() as $db)
							{
						?>
						<tr>
						
							<td><?php echo $no ;?></td>
							<td><?=$db['no_transaksi']?></td>
							<td><?php echo $db['tgl_transaksi']; ?></td>
							<td>
							<?php 
							error_reporting(0);
							$tamuini = $this->app_model->getSelectedData('tbl_tamu',array('id_tamu'=>$db['id_tamu']))->row(); ?>
							<span class="namadetail" data-container="body" data-toggle="popover" data-placement="top" 
							data-content="<?=$tamuini->no_kartu_id?><br/><?=$tamuini->alamat_tamu?><br/><?=$tamuini->tlp?>"
							data-trigger="hover focus" data-html="true"
							>
							<?=$tamuini->nama_tamu?>
							</span>
							</td>
							<td>
							<?php $villaini = $this->app_model->getSelectedData('tbl_villa',array('kode_villa'=>$db['kode_villa']))->row(); ?>
							<span id="nm_<?=$db['no_transaksi']?>" data-kode_villa="<?=$db['kode_villa']?>"><?=$villaini->nama_villa?></span></td>					
							<td>
							<?php 
								echo "<kbd>".$db['tgl_cekin']."</kbd>"; 
							?>
							</td>					
							<td>
							<?php 
								echo "<span id='co_".$db['no_transaksi']."' data-no_trans='".$db['tgl_cekout']."'><code>".$db['tgl_cekout']."<code></span>"; 
							?>
							</td>					
							<td><?php echo $db['lama_hari']; ?> hari</td>												
							<td> 
								<div class="radiocontainer">
									<input type="radio" name="opt<?=$db['no_transaksi']?>" id="optionCekout" class="optcekout" data-notrans="<?=$db['no_transaksi']?>" value="4">
										Check Out
									</input>
								</div>	
							</td>					
							<td><a href="#" class="btn btn-warning" data-toggle="modal" data-target="#myModal<?=$db['no_transaksi']?>"><?=showicon('eye-open');?> Detail</div></a>					
							    <a href="orderdatatamu/invoice/<?=$db['no_transaksi']?>" target="_blank" class="btn btn-default"><?=showicon('print');?> Bukti Pembayaran </a></td>
							
						
						</tr>
						<?php
							$no++;
							}
						}
						else
						{
							?>
							
						<tr>
							<td colspan="<?=count($list_field)?>">Belum ada data
							
							</td>
						</tr>
							<?php
						}
					?>
				
				
					<tr align="center">
						<td colspan="<?=count($list_field)?>">
							<div class="cleaner_h5"></div>
							<?php
								//echo $paginator;
							?>
							<div class="cleaner_h5"></div>
						</td>
					</tr>
					</tbody>
				</table>
				

<script> 

$('.optcekout').change(function(){
	
	var test = $(this).closest('.radiocontainer');
	var hadirval = $(test).find('input:radio:checked').val();
	var no_trans = $(test).find('input:radio:checked').data('notrans');
	var datenow = '<?=date('Y-m-d')?>';
	var tgl_cekout = $('#co_'+no_trans).data('no_trans');
	var kode_villa = $('#nm_'+no_trans).data('kode_villa');
	
	if (confirm("Anda Yakin Tamu Sudah Check Out?")){
		$.ajax({
			url:'<?=base_url()?>transaksi/updateOut/'+hadirval+'/'+no_trans+'/'+tgl_cekout+'/'+kode_villa, cache:false,			
			success: function(msg){
				alert(msg);
				//location.reload();				
				$('#myTab a[href="#checkout_list"]').tab('show')
			}
		});

	
	}
	else
	{
		this.checked = false;
	}
});


</script>