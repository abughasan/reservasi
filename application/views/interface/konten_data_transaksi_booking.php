<?PHP
	function createDateRangeArray($strDateFrom,$strDateTo,$id_tamu)
	{
		// takes two dates formatted as YYYY-MM-DD and creates an
		// inclusive array of the dates between the from and to dates.

		// could test validity of dates here but I'm already doing
		// that in the main script

		$aryRange=array();

		$iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
		$iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

		if ($iDateTo>=$iDateFrom)
		{
			array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
			while ($iDateFrom<$iDateTo)
			{
				$iDateFrom+=86400; // add 24 hours
				array_push($aryRange,date('Y-m-d',$iDateFrom));
			}
		}
		return $aryRange;
	}
?>
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
						<th>Lama</td>						
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
						<tr class="<?php (($db['tgl_cekin'] < date('Y-m-d')) ? print 'danger' : '' ); ?><?php (($db['tgl_cekin'] == date('Y-m-d')) ? print 'success' : '' ); ?>">
						
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
							<input type="text" value="<?php echo $db['tgl_cekin']; ?>" class="checkin_input form-control" id="tgl_cekin<?=$db['no_transaksi']?>" readonly>
							</td>					
							<td>
							<input type="hidden" data-no_trans="<?=$db['no_transaksi']?>" value="<?php echo $db['tgl_cekout']; ?>" class="checkout_change form-control" data-provide="datepicker" data-date-autoclose="true" data-date="date(yyyy-mm-dd)" data-date-format="yyyy-mm-dd" required>
							<input type="text" class="form-control" id="input<?=$db['no_transaksi']?>" value="<?=$db['tgl_cekout']?>" disabled>
							</td>					
							<td><?php echo $db['lama_hari']; ?> hari</td>												
							<td> 
								<div class="radiocontainer">
								<?php if($db['tgl_cekin'] > date('Y-m-d')): 
									echo '';
									else:
								?>
									<input type="radio" name="opt<?=$db['no_transaksi']?>" id="optionCekin" class="optcekin" data-notrans="<?=$db['no_transaksi']?>" value="3">
										Check In
									</input>
								<?php endif; ?>
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
						@$dateselected = $this->app_model->manualQuery("
							SELECT tgl_cekin,tgl_cekout,id_tamu FROM tbl_transaksi 
							WHERE kode_villa = '{$db['kode_villa']}'
								AND
							(
								(MONTH(tgl_cekin) = MONTH('{$db['tgl_cekin']}') and MONTH(tgl_cekout) = MONTH('{$db['tgl_cekout']}')+2 and (id_status_v = 2 or id_status_v = 3))
								or
								(MONTH(tgl_cekin) = MONTH('{$db['tgl_cekin']}') and MONTH(tgl_cekout) = MONTH('{$db['tgl_cekout']}') and (id_status_v = 2 or id_status_v = 3))
								or
								(MONTH(tgl_cekin) = MONTH('{$db['tgl_cekin']}')-2 and MONTH(tgl_cekout) = MONTH('{$db['tgl_cekout']}') and (id_status_v = 2 or id_status_v = 3))
							)
							ORDER BY tgl_cekin ASC
						");
						$datarange = array();
						$i=0;
						foreach ($dateselected->result() as $do):
							$dr = createDateRangeArray($do->tgl_cekin,$do->tgl_cekout);
							$datarange = array_merge($datarange,$dr);
							// echo $do->id_tamu;
						endforeach;
						
						?>
						<script>
						// var arrayinput<?=$db['no_transaksi']?> = ["2014-07-14","2014-07-15","2014-07-16",];
						var arrayinput<?=$db['no_transaksi']?> = [<?PHP
						foreach ($datarange as $d) {
							ECHO '"'.$d.'",';
						}
						?>]
						$('#input<?=$db['no_transaksi']?>').datepicker({
							dateFormat : 'yy-mm-dd',
							defaultDate: '<?=$db['tgl_cekout']?>',
							beforeShowDay: function(date){
								var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
								return [ arrayinput<?=$db['no_transaksi']?>.indexOf(string) == -1 ]
							},
							onClose: function(date){
								alert(date);
							}
						});
						</script>
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
	$(".checkout_change").datepicker().on('changeDate',function(){
		var tglkeluar = $(this).val();
		var no_transaksi = $(this).data('no_trans');
		var test = "#tgl_cekin"+no_transaksi;
		var tglmasuk = $(test).val();
		// alert(dateoutbefore+no_transaksi+datein);
		var dateIn = new Date(tglmasuk);
		var dateOut = new Date(tglkeluar);
		var lamahari = new Date(dateOut - dateIn);
		var daycount = lamahari/1000/60/60/24;
		// alert();
		$.ajax({
			url:'<?=base_url()?>transaksi/updateBook_dateout/'+no_transaksi+'/'+tglkeluar+'/'+daycount,cache:false,
			success: function (e){
				alert(e);
				$.ajax({
					url:'<?=base_url()?>transaksi/view/', cache: false,
					beforeSend: function(){
						$("#booking_list_content").html("<img src=<?=base_url()."assets/img/ajax-loader-small.gif"?> />")
					},
					success: function(msg){
						$("#booking_list_content").html(msg)
					}
				  });
			}
		});
	});
</script>