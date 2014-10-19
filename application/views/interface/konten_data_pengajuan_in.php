<!--content data input-->
				<div class="cleaner_h10"></div>	
					<!--START DATA CARI
					<div class="span6 pull-right">
					<?php echo form_open("transaksi/pertanggal", 'class="navbar-form pull-right"'); ?>
						
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
						if($dt_booking->num_rows()>0)
						{
							foreach($dt_booking->result_array() as $db)
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
							<?=$villaini->nama_villa?></td>					
							<td>
							<?php 
								echo "<kbd>".$db['tgl_cekin']."</kbd>"; 
							?>
							</td>					
							<td>
							<?php 
								echo "<code>".$db['tgl_cekout']."<code>"; 
							?>
							</td>					
							<td><?php echo $db['lama_hari']; ?> hari</td>												
							<td> 
								<div class="radiocontainer">
									<input type="radio" name="opt<?=$db['no_transaksi']?>" id="optionCekin" class="optcekin" data-notrans="<?=$db['no_transaksi']?>" value="3">
										Check In
									</input>
								<div class="radio">
									<input type="radio" name="opt<?=$db['no_transaksi']?>" id="optionCekcancel" class="optcancel" data-notrans="<?=$db['no_transaksi']?>" value="1">
										Cancel	
									</input>								  
								</div>
								 
							</td>					
							<td><a href="#" class="btn btn-warning" data-toggle="modal" data-target="#myModal<?=$db['no_transaksi']?>"><?=showicon('eye-open');?> Detail</div></a>					
							    <a href="orderdatatamu/invoice/<?=$db['no_transaksi']?>" target="_blank" class="btn btn-default"><?=showicon('print');?> Cetak </a></td>
							
						
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
$('.namadetail').popover();


$('.optcekin').change(function(){		
	var test = $(this).closest('.radiocontainer');
	var hadirval = $(test).find('input:radio:checked').val();
	var no_trans = $(test).find('input:radio:checked').data('notrans');
	if (confirm("Anda Yakin Tamu sudah datang?")){
		$.ajax({
			url:'<?=base_url()?>transaksi/updatehadir/'+hadirval+'/'+no_trans, cache:false,
			success: function(msg){		
				//location.reload();
				$('#myTab a[href="#checkin_list"]').tab('show')
			}
		});
	}
	else
	{
		this.checked = false;	
	}	
});


$('.optcancel').change(function(){	
	var test = $(this).closest('.radiocontainer');
	var hadirval = $(test).find('input:radio:checked').val();
	var no_trans = $(test).find('input:radio:checked').data('notrans');
	if (confirm("Transaksi dicancel?")){
		$.ajax({
			url:'<?=base_url()?>transaksi/updatecanceltrans/'+hadirval+'/'+no_trans, cache:false,
			success: function(msg){		
				//location.reload();
				$('#myTab a[href="#cancel_list"]').tab('show')
			}
		});
	}
	else
	{
		this.checked = false;	
	}	
});
</script>