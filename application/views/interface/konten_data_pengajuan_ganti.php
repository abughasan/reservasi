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
						<th>No.</th>
						<th>Tanggal Ganti</th>
						<th>Nama barang</th>
						<th>Jumlah</th>
						<th>kondisi</th>
						<th>Penyebab</th>						
						<th colspan='2'>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$no = 1;
						if($dt_ganti->num_rows()>0)
						{
							foreach($dt_ganti->result_array() as $db)
							{
						?>
						<tr>
						
							<td><?php echo $no ;?></td>
							<td><?=$db['tgl_ganti']?></td>
							<td><?php echo $db['nama_barang']; ?></td>														
							<td>
							<?php 
								echo "<kbd>".$db['jml']."</kbd>"; 
							?>
							</td>					
							<td><?php if($db['kondisi_b'] == 1) 
								  {echo "Rusak";} else {echo "Tidak Layak Pakai";}							  
							; ?></td>					
								
							</td>
							<td><?php echo $db['penyebab']; ?></td>												
							
							<td>					
								<a href="<?php echo base_url(); ?>pengajuan/hapus/<?php echo $db['id_pengajuan']; ?>" onclick="return confirm('Anda yakin?');"><div class=
								"btn-delete"><?=showicon('remove') ?> Hapus</div></a>
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