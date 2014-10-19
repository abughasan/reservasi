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
						<th>Tanggal</th>
						<th>Nama barang</th>
						<th>Jumlah</th>
						<th>kondisi</th>
						<th>Penyebab</th>						
						<th colspan='2'><a href="<?php echo base_url(); ?>pengajuan/tambah" class="cbbarang"><div class="btn-add" align="center"><?=showicon('plus') ?> Tambah Data</div></a></th>
					</tr>
				</thead>
				<tbody>
					<?php
						$no = 1;
						if($dt_rusak->num_rows()>0)
						{
							foreach($dt_rusak->result_array() as $db)
							{
						?>
						<tr>
						
							<td><?php echo $no ;?></td>
							<td><?=$db['tgl_pengajuan']?></td>
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
								<div class="radiocontainer">
									<input type="radio" name="opt<?=$db['id_pengajuan']?>" id="optionaju" class="optaju" data-notrans="<?=$db['id_pengajuan']?>" data-kdbrng="<?=$db['kode_barang']?>" data-jml="<?=$db['jml']?>" value="2">
										Ajukan
									</input>		
								 </div>
							</td>					
							<td>					
								<a onclick="editjml('<?=$db['id_pengajuan']?>')"><div class="btn-delete"><?=showicon('pencil') ?> Edit</div></a>
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

$('.optaju').change(function(){		
	var test = $(this).closest('.radiocontainer');
	var ajuval = $(test).find('input:radio:checked').val();	
	var kdbrng = $(test).find('input:radio:checked').data('kdbrng');	
	var jml = $(test).find('input:radio:checked').data('jml');	
	var id_pengajuan = $(test).find('input:radio:checked').data('notrans');	
	//alert(kdbrng);
	if (confirm("Sudah diganti/diperbaharui?")){
		$.ajax({
			url:'<?=base_url()?>pengajuan/update/'+ajuval+'/'+jml+'/'+kdbrng+'/'+id_pengajuan, cache:false,
			success: function(msg){		
				//location.reload();
				$('#myTab a[href="#ganti_list"]').tab('show')
			}
		});
	}
	else
	{
		this.checked = false;	
	}	
});

function editjml(id_pengajuan) {
    var jml = prompt("Edit Jumlah yang diajukan");
	//alert(id_pengajuan);
	 if (jml != null){
	  $.ajax({
		url:'<?=base_url()?>pengajuan/updatejml/'+jml+'/'+id_pengajuan, cache:false,
		success: function(e){
		location.reload();
		}		
	  });
	}	
}

</script>