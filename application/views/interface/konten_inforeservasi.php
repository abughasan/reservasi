<div class="panel panel-default">
	<div class="panel-heading">Info Reservasi Villa</div>
	<div class="row">
	<div class="col-md-6">
	<table class="table ">
		<tr>
			<td>Kode Villa </td>
			<td width=3>:</td>
			<td><?=$villa_booked->kode_villa?></td>
		</tr>
		<tr>
			<td>Nama Villa </td>
			<td>:</td>
			<td><?=$villa_booked->nama_villa?></td>
		</tr>
		<tr>
			<td>Tarif Villa </td>
			<td>:</td>
			<td><?="<code>Rp ".number_format($villa_booked->tarif_villa,2,',','.')." / night</code>"?></td>
		</tr>
		<tr>
			<td>Tanggal Check-In </td>
			<td>:</td>
			<td><?=$_GET['dateIn']?></td>
		</tr>		
		<tr>
			<td>Tanggal Check-Out </td>
			<td>:</td>
			<td><?=$_GET['dateOut']?></td>
		</tr>
		<tr>
			<td>Lama Menginap </td>
			<td>:</td>
			<td><?=$_GET['lamahari']?></td>
		</tr>
		<tr>
			<td>Diskon </td>
			<td>:</td>
			<td><?=$villa_booked->diskon*100?> %</td>
		</tr>
		<tr class="info">
			<td>Total Biaya </td>
			<td>:</td>
			<td>
			<?php if( $villa_booked->diskon != 0 ) : ?>
			<strike><?=number_format($_GET['lamahari']*$villa_booked->tarif_villa,2,',','.')?></strike><br/>
			<?=number_format(($_GET['lamahari']*($villa_booked->tarif_villa-($villa_booked->tarif_villa*$villa_booked->diskon))),2,',','.')?>
			<?php else: ?>
			<?=number_format($_GET['lamahari']*$villa_booked->tarif_villa,2,',','.')?>
			<?php endif; ?>
			</td>
		</tr>
	</table>
	</div>
	<div class="col-md-6">
		<div class="cleaner_h10"></div>
			<img height="250" src="<?=base_url()?>upload/thumb/<?=$villa_booked->url?>">
	</div>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">Data Tamu Pemesan Villa</div>
	<div class="row">
	<div class="col-md-6">
	<table class="table ">
		<tr>
			<td>ID Penduduk </td>
			<td width=3>:</td>
			<td><?=$tamu->jenis_kartu_id?> (<?=$tamu->no_kartu_id?>)</td>
		</tr>
		<tr>
			<td>Nama </td>
			<td>:</td>
			<td><?=$tamu->nama_tamu?></td>
		</tr>
		<tr>
			<td>No. Telp </td>
			<td>:</td>
			<td><?=$tamu->tlp?></td>
		</tr>
	</table>
	</div>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		Pembayaran
	</div>
	<div class="panel-body">
		
		<form class="form-horizontal" role="form">
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Tipe Pembayaran</label>
			<div class="col-sm-3">
			  <div class="radio">
				  <label>
					<input type="radio" name="optionsRadios" id="optionsRadios1" value="" checked>
					TUNAI
				  </label>
				</div>
			</div>
		  </div>
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Total Bayar</label>
			<div class="col-sm-3">
			<?php if( $villa_booked->diskon != 0 ) : ?>
			  <input type="text" value="<?=($_GET['lamahari']*($villa_booked->tarif_villa-($villa_booked->tarif_villa*$villa_booked->diskon)))?>" class="form-control" id="totalbayar" readonly>
			<?php else : ?>
			  <input type="text" value="<?=$_GET['lamahari']*$villa_booked->tarif_villa?>" class="form-control" id="totalbayar" readonly>
			<?php endif ; ?>
			</div>
		  </div>
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Jumlah Bayar</label>
			<div class="col-sm-3">
			  <input type="number" class="form-control" id="jumlahbayar" placeholder="Uang Muka / Pembayaran" required>
			  <span id="msgtunai"></span>
			</div>
		  </div>
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Sisa Bayar</label>
			<div class="col-sm-3">
			  <input type="text" class="form-control" id="sisabayar">
			</div>
		  </div>
		
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-body">
		<button type="submit" class="btn btn-primary" id="konfirm">Konfirmasi Pemesanan</button>
	</div>
</div>
		</form>

<div class="modal fade" id="pilihguide">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body">
		<h3 class="label label-info">Pilih Guide</h3>
		<select class="form-control" id="guide">
		  <option value="">-pilih guide-</option>
		  <option value="guide_baru" style="color:red" >guide baru</option>
		  <?php foreach($guide as $db): ?>			
			<option value="<?=$db->kode_guide?>"><?=$db->nama_guide?></option>
		  <?php endforeach; ?>
		</select><br/>
		<select class="form-control" id="komisi_guide">
		  <option value="">-Komisi-</option>
		  <option value="0.06">6 %</option>
		  <option value="0.07">7 %</option>
		  <option value="0.08">8 %</option>
		  <option value="0.09">9 %</option>
		  <option value="0.1">10 %</option>
		</select><br/>
		
      </div>
	  <div class="modal-footer">
        <button type="button" class="btn btn-default" id="guide_ok_button">Ok</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="konfirmasi">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
		<div id="msg_konfirmasi"></div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modal_guide_baru">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
		<div>
			<form class="form_guide_baru" id="form_guide_baru" action="<?= base_url() ?>ajax/guide_baru_save">
			<div class="form-group">
				<label  class="col-md-3 control-label">Nomor KTP</label>
				<div class="col-md-6 input-group">										
					<input type="text" placeholder="Nomor KTP" id="guide_no_ktp_guide" name="no_ktp" value="" class='form-control'>
				</div>
			</div>
			<div class="form-group">
				<label  class="col-md-3 control-label">Nama Guide</label>
				<div class="col-md-6 input-group">										
					<input type="text" placeholder="Nama Guide" id="guide_nama_guide" name="nama_guide" value="" class='form-control'>
				</div>
			</div>
			<div class="form-group">
				<label  class="col-md-3 control-label">Alamat</label>
				<div class="col-md-6 input-group">										
					<input type="text" placeholder="Alamat" id="guide_alamat_guide" name="alamat" value="" class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<label  class="col-md-3 control-label">Nomor Telepon</label>
				<div class="col-md-6 input-group">										
					<input type="text" placeholder="Nomor Telepon" id="guide_no_telp_guide" name="no_telp" value="" class="form-control" >
				</div>
			</div>
				<div class="form-group" align="">
					<label  class="col-md-2 control-label"></label>
					<div class="col-md-4 input-group">										
						<input type="submit" class="btn btn-success" value="Simpan">
						<input type="reset" class="btn btn-default" value="Reset">												
					</div>	
				</div>
				<input type="hidden" name="stts_guide" value="Oke">
			</form>
		</div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
$('#konfirm').click(function(){
	var jum = $("#jumlahbayar").val();
	if (jum == '') {} else {
		$('#pilihguide').modal('show');
		return false;
	}
});

$('#guide_ok_button').click(function (e) {
	var dateIn = '<?=$_GET['dateIn']?>';
	var dateOut = '<?=$_GET['dateOut']?>';
	var lamahari = '<?=$_GET['lamahari']?>';
	var kode_villa = '<?=$_GET['kode_villa']?>';
	var diskon = '<?=$villa_booked->diskon?>';
	var totalbayar = $('#totalbayar').val();
	var kode_guide = $('#guide option:selected').val();
	var komisi_guide = $('#komisi_guide option:selected').val();
	var id_tamu = '<?=$_GET['id_tamu']?>';
	var jumlahbayar = $('#jumlahbayar').val();
	//cek guide
	if ($('#guide option:selected').val() == "") {
		if (confirm("Yakin tidak ada guide?")){
			callajax();
		}
	}else if ($('#guide option:selected').val() == "guide_baru"){
		$( '#modal_guide_baru' ).modal('show');
		$('#form_guide_baru').submit(function(){
			var no_ktp_guide = $('#guide_no_ktp_guide').val();
			var nama_guide = $('#guide_nama_guide').val();
			var alamat_guide = $('#guide_alamat_guide').val();
			var no_telp_guide = $('#guide_no_telp_guide').val();
			$.ajax({
				url:'<?= base_url() ?>guide/guide_baru_save/'+no_ktp_guide+'/'+nama_guide+'/'+alamat_guide+'/'+no_telp_guide,cache:false,
				success:function(msg){
					var kode_guide = msg;
					alert(kode_guide+' berhasil ditambahkan dan dipilih');
					$( '#modal_guide_baru' ).modal('hide');
					callajax2(kode_guide);
					// alert('guide baru tersimpan dan terpilih');
				}
			});
			return false;
		});
	}else {
		if($('#komisi_guide option:selected').val()=="") {
			alert('Pilih komisi untuk guide terlebih dahulu.!');
		}else{
			callajax();
		}
	}
	function callajax() {
		$.ajax({
			url: '<?=base_url()?>orderdatatamu/submit_trans/?dateIn='+dateIn+'&dateOut='+dateOut+'&lamahari='+lamahari+'&kode_villa='+kode_villa+'&id_tamu='+id_tamu+'&totalbayar='+totalbayar+'&kode_guide='+kode_guide+'&jumlahbayar='+jumlahbayar+'&komisi_guide='+komisi_guide+'&diskon='+diskon, 
			cache: false,
			beforeSend: function(){
				$('#pilihguide').modal('hide');
				$('#konfirmasi').modal('show');
				$('#msg_konfirmasi').html('<div class="alert alert-warning"><img src="<?=base_url()?>assets/img/ajax-loader-small.gif"> Transaksi sedang diproses...</div>');
			},
			success: function (msg) {
				$('#msg_konfirmasi').html('<div class="alert alert-success"><b>Terimakasih</b> Villa telah dipesan!</div>');
				$('#konfirmasi').on('hidden.bs.modal', function (e) {
					window.location=msg;
				});
			}
		});
	}

	function callajax2(guidebaru) {
		$.ajax({
			url: '<?=base_url()?>orderdatatamu/submit_trans/?dateIn='+dateIn+'&dateOut='+dateOut+'&lamahari='+lamahari+'&kode_villa='+kode_villa+'&id_tamu='+id_tamu+'&totalbayar='+totalbayar+'&kode_guide='+guidebaru+'&jumlahbayar='+jumlahbayar+'&komisi_guide='+komisi_guide+'&diskon='+diskon, 
			cache: false,
			beforeSend: function(){
					$('#pilihguide').modal('hide');
				$('#konfirmasi').modal('show');
				$('#msg_konfirmasi').html('<div class="alert alert-warning"><img src="<?=base_url()?>assets/img/ajax-loader-small.gif"> Transaksi sedang diproses...</div>');
			},
			success: function (msg) {
				$('#msg_konfirmasi').html('<div class="alert alert-success"><b>Terimakasih</b> Villa telah dipesan!</div>');
				$('#konfirmasi').on('hidden.bs.modal', function (e) {
					window.location=msg;
				});
			}
		});
	}
});

$("#jumlahbayar").keyup(function(){
	var tot = $("#totalbayar").val();
	var jum = $("#jumlahbayar").val();
	var sisa = tot - jum;
	$("#sisabayar").val(sisa);
	if (tot == jum) {
		$( "#msgtunai" ).html("TYPE BAYAR : TUNAI LUNAS");
	} else {
		$( "#msgtunai" ).html("TYPE BAYAR : CICILAN");
	}
});
</script>