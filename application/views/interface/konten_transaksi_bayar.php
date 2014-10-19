<?php $det = $this->app_model->getSelectedData('tbl_transaksi',array('no_transaksi'=>$no_transaksi))->row(); ?>
	<div class="panel-group" id="accordion">
	  <div class="panel panel-default">
		<div class="panel-heading">
		  <h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
			  <?=showicon('saved') ?> DATA PEMBAYARAN 
			</a>
		  </h4>
		</div>
		<div id="collapseOne" class="panel-collapse collapse in">
		  <div class="panel-body">
				<!-- START DATA INPUT -->
										
					<div class="row">
						<div class="col-md-6">
							<!--LEFT HERE-->
							<div class="form-group">
								<label  class="col-md-4 control-label">Nomor Transaksi</label>
								<div class="col-md-6 input-group">										
									<input type="text" placeholder="Nomor Transaksi" name="no_transaksi" value="<?=$det->no_transaksi?>" class='form-control input-read-only' readonly="true">
								</div>
							</div>
							<div class="form-group">
								<label  class="col-md-4 control-label">Tanggal Transaksi</label>
								<div class="col-md-6 input-group">										
									<input type="text" placeholder="Tanggal Transaksi" name="tgl_transaksi" value="<?=$det->tgl_transaksi?>" class='form-control input-read-only' readonly="true">
								</div>
							</div>
							<div class="form-group">
								<label  class="col-md-4 control-label">Lama Inap</label>
								<div class="col-md-6 input-group">										
									<input type="text" placeholder="Lama Hari" name="lama_hari" value="<?=$det->lama_hari?> Hari" class='form-control input-read-only' readonly="true">
								</div>
							</div>						
							<div class="form-group">
								<label  class="col-md-4 control-label">Biaya Inap</label>
								<div class="col-md-6 input-group">										
									<input type="text" placeholder="Biaya Inap" name="dapat_harga" value="<?=$det->dapat_harga?>" class='form-control input-read-only' readonly="true">
								</div>
							</div>	
							<div class="form-group bg-danger">
								<label class="col-md-4 control-label">Denda</label>
								<div class="col-md-6 input-group">										
									<input id="dendainput" type="text" placeholder="Ada denda?" name="dapat_denda" value="<?=$det->dapat_denda?>" class='form-control input-read-only'>
									<script>
										$( '#dendainput' ).keyup(function(){
											var notrans = '<?=$det->no_transaksi?>';
											var besardenda = $( '#dendainput' ).val();
											$.ajax({
												url:'<?=base_url()?>pembayaran/denda/'+notrans+'/'+besardenda, cache:false,
											})
										});
									</script>
								</div>
							</div>						
						</div>
						<div class="col-md-6">
							<!--RIGHT HERE-->
							<div class="form-group">
								<label  class="col-md-4 control-label">Nama Tamu</label>
								<div class="col-md-6 input-group">										
									<input type="text" placeholder="Nama Tamu" name="nama_tamu" value="<?=$this->app_model->getSelectedData('tbl_tamu',array('id_tamu'=>$det->id_tamu))->row()->nama_tamu?>" class='form-control input-read-only' readonly="true">
								</div>
							</div>
							<div class="form-group">
								<label  class="col-md-4 control-label">Nomor ID</label>
								<div class="col-md-6 input-group">										
									<input type="text" placeholder="Nomor ID" name="no_kartu_id" value="<?=$this->app_model->getSelectedData('tbl_tamu',array('id_tamu'=>$det->id_tamu))->row()->no_kartu_id?>" class='form-control input-read-only' readonly="true">
								</div>
							</div>		
							<div class="form-group">
								<label  class="col-md-4 control-label">Nama Villa</label>
								<div class="col-md-6 input-group">										
									<input type="text" placeholder="Nama Villa" name="nama_villa" value="<?=$this->app_model->getSelectedData('tbl_villa',array('kode_villa'=>$det->kode_villa))->row()->nama_villa?>" class='form-control input-read-only' readonly="true">
								</div>
							</div>
							<div class="form-group">
								<label  class="col-md-4 control-label">Nama Guide</label>
								<div class="col-md-6 input-group">										
									<input type="text" placeholder="Guide" name="nama_guide" value="<?=@$this->app_model->getSelectedData('tbl_guide',array('kode_guide'=>$det->kode_guide))->row()->nama_guide?>" class='form-control input-read-only' readonly="true">
								</div>
							</div>		
							
						</div>
					</div>
					<hr>
					<!--table here-->	
					<div class="row">
						<div class="col-md-12">
							<table class="table">
								<thead>
									<tr>
									<th>No</th>
									<th>Tanggal Bayar</th>
									<th>Jumlah Bayar</th>
									<th>Subtotal</th>
									<th>
							<?php if($det->dapat_harga+$det->dapat_denda == $totalbayar): ?>
							<span class="label label-success">LUNAS</span>
							<?PHP else: ?>
							<a id="addrow" data-toggle="modal" data-target="#modaladd" style="cursor:pointer"><?=showicon('plus')?> Tambah</a>
							<?PHP endif; ?>
									
									</th>
									</tr>
								</thead>
								<tbody>
								<?php $subtot = 0;$i=0;
								foreach ($dttrans as $dt) : 
								$i++; ?>
									<tr>
									<td><?=$i?></td>
									<td><?=$dt->tgl_bayar?></td>
									<td><?=$dt->jml_bayar?></td>
									<td><?php echo $subtot = $subtot + $dt->jml_bayar; ?></td>									
									<td></td>
									</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>	
					
					<?=anchor('pembayaran', 'Kembali', array('class' => 'btn btn-success'));?>
				<!-- END OFF DATA INPUT -->
	
		  </div>
		</div>
	  </div>		
	</div>

<!--START MODAL-->
<div class="modal fade" id="modaladd">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" action="<?php echo base_url(); ?>pembayaran/tambahbayar/<?=$no_transaksi?>" id="modaldetailkegiatan">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Tambahkan Pembayaran</h4>
      </div>
      <div class="modal-body">
				<div class="form-group">
					 <label for="">Sisa Harus Bayar </label><input type="text" value="" class="form-control inputkeg" id="sisabayarinput"/>
				</div>
				<div class="form-group">
					 <label for="">Jumlah Bayar</label><input type="text" name="jml_bayar" class="form-control inputkeg" id="" />
				</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
	  </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->	
<script>
$('#modaladd').on('show.bs.modal', function (e) {
	var s = parseInt(<?=$sisabayar?>);
	var u = parseInt($( '#dendainput' ).val());
	var sisabayar = s + u;
	$( '#sisabayarinput' ).val(sisabayar);
})
</script>