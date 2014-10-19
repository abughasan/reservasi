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
						<th>No. Trans</th>
						<th>Tgl Transaksi</th>
						<th>Tamu</th>
						<th>Villa</th>
						<th>Check-In</th>
						<th>Check-Out</th>
						<th>Jumlah</th>						
						<th>Aksi</th>						
					</tr>
				</thead>
				<tbody>
					<?php
						$no = 1;
						if($data_chekout->num_rows()>0)
						{
							foreach($data_chekout->result_array() as $db)
							{
						?>
						<script>
										$("#tombol_byr<?=$db['no_transaksi']?>").hide();
										$("#tombol_ctk<?=$db['no_transaksi']?>").hide();
										$("#list_<?=$db['no_transaksi']?>").hide();
							$.ajax({
								url:'<?=base_url()?>pembayaran/ceklunas/<?=$db['no_transaksi']?>',cache:false,
								beforeSend:function(){
										$(".tloadingr").html('<td>Please wait...</td>');
								},
								success:function(msg){
									$(".tloadingr").hide('slow');
									if(msg==0) {
										$("#list_<?=$db['no_transaksi']?>").show("fast");
										$("#list_<?=$db['no_transaksi']?>").stop(true,true).addClass("success", 1500);
										$("#tombol_ctk<?=$db['no_transaksi']?>").show();
									}else{
										$("#list_<?=$db['no_transaksi']?>").show("fast");
										$("#list_<?=$db['no_transaksi']?>").stop(true,true).addClass("danger", 1500);
										$("#tombol_byr<?=$db['no_transaksi']?>").show();
									}
								}
							})
						</script>
						<tr class="tloadingr"></tr>
						<tr id="list_<?=$db['no_transaksi']?>">
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
								echo "<code>".$this->app_model->getSelectedData('tbl_hadir',array('no_transaksi'=>$db['no_transaksi']))->row()->tgl_pulang."<code>"; 
							?>
							</td>					
							<td><?php echo $db['lama_hari']; ?> hari</td>												
							
							<td><a href="#" class="btn btn-warning" data-toggle="modal" data-target="#myModal<?=$db['no_transaksi']?>"><?=showicon('eye-open');?> Detail</div></a>					
							    <!--<a href="orderdatatamu/invoice/<?=$db['no_transaksi']?>" target="_blank" class="btn btn-default"><?=showicon('print');?> Cetak </a>-->
							    <a id="tombol_byr<?=$db['no_transaksi']?>" href="<?=base_url()?>pembayaran/bayar/<?=$db['no_transaksi']?>" target="_blank" class="btn btn-default "><?=showicon('dollar');?> Bayar </a>
							    <a id="tombol_ctk<?=$db['no_transaksi']?>" href="<?=base_url()?>pembayaran/kwitansi/<?=$db['no_transaksi']?>" target="_blank" class="btn btn-default "><?=showicon('print');?> Cetak </a></td>
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
			