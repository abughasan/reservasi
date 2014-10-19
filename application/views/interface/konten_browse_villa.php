<div class="panel panel-default">
		<div class="panel-heading"><h4>Villa Tersedia pada tanggal : <kbd><?=$dateorder[0];?></kbd> s/d <kbd><?=$dateorder[1];?></kbd></h4><?=$istime?></div>
		<div class="row">
		<?php foreach($dt_villa->result_array() as $db) : ?>
		  <div class="col-sm-6 col-md-4">
			<div class="cleaner_h10"></div>
			<div class="thumbnail">
			  <img src="<?=base_url()."upload/thumb/".$db['url']?>" height="" width="" alt="...">
			  <div class="caption">
				<h3><?=$db['nama_villa']?><?=$db['kode_villa']?></h3>
				<?php
					$villa_booked = $this->app_model->manualQuery("
						SELECT * FROM tbl_transaksi tt
							WHERE 
								(tt.tgl_cekin <= '{$dateorder[0]}' AND tt.tgl_cekout >= '{$dateorder[1]}' AND tt.kode_villa = '{$db['kode_villa']}' AND (id_status_v = 3 OR id_status_v = 2))
							 OR 
							 	(tt.tgl_cekin < '{$dateorder[1]}' AND tt.tgl_cekout >= '{$dateorder[0]}' AND tt.kode_villa = '{$db['kode_villa']}' AND (id_status_v = 3 OR id_status_v = 2))
							 OR
								(tt.tgl_cekin >= '{$dateorder[0]}' AND tt.tgl_cekout < '{$dateorder[1]}' AND tt.kode_villa = '{$db['kode_villa']}' AND (id_status_v = 3 OR id_status_v = 2))
					");
				?>
				<p><?="<code>Rp ".number_format($db['tarif_villa'],2,',','.')." / night</code>"?></p>
					<?PHP
					// IF ($istime=='PM'):
						if ($villa_booked->num_rows()>0):
							$isavailabel = $this->app_model->manualQuery("
							SELECT IF(('{$dateorder[0]}' = tt.tgl_cekout),'availabel','nope') ISAVAILABEL FROM tbl_transaksi tt 
								WHERE 
									(tt.tgl_cekin <= '{$dateorder[0]}' AND tt.tgl_cekout >= '{$dateorder[1]}' AND tt.kode_villa = '{$db['kode_villa']}' AND (id_status_v = 3 OR id_status_v = 2))
								 OR 
									(tt.tgl_cekin < '{$dateorder[1]}' AND tt.tgl_cekout >= '{$dateorder[0]}' AND tt.kode_villa = '{$db['kode_villa']}' AND (id_status_v = 3 OR id_status_v = 2))
								 OR
									(tt.tgl_cekin >= '{$dateorder[0]}' AND tt.tgl_cekout < '{$dateorder[1]}' AND tt.kode_villa = '{$db['kode_villa']}' AND (id_status_v = 3 OR id_status_v = 2))
							");
							if($isavailabel->row()->ISAVAILABEL=='availabel'):
								if($isavailabel->num_rows > 1):
								?><p><a href="" class="btn btn-danger btn-sm disabled" style="" role="button">Booked!</a></p><?php
								else:
								?><p><a data-toggle="modal" data-target="#customer<?=$db['kode_villa']?>" class="btn btn-success btn-sm" role="button">Available. Order Now!</a></p><?php
								endif;
							else:
								?><p><a href="" class="btn btn-danger btn-sm disabled" style="" role="button">Booked!</a></p><?php
							endif; //endif punya isavailabel
						else:
						?><p><a data-toggle="modal" data-target="#customer<?=$db['kode_villa']?>" class="btn btn-success btn-sm" role="button">Available. Order Now!</a></p><?php
						endif;
					// ELSE:
					// ENDIF;
					?>
			  </div>
			</div>
		  </div>
		<?php endforeach; ?>
		</div>
</div>

<?php foreach ($dt_villa->result() as $db) : ?>

<div class="modal fade" id="customer<?=$db->kode_villa?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <a data-toggle="modal" data-target="#tamulama" class="btn btn-info btn-lg btn-block villabtn" data-kdvilla="<?=$db->kode_villa?>">Tamu Lama?</a>
		<br/>
		<div align="center">atau</div>
		<br/>
        <a data-toggle="modal" data-target="#tamubaru<?=$db->kode_villa?>" class="btn btn-warning btn-lg btn-block">Tamu Baru?</a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="tamubaru<?=$db->kode_villa?>">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <?php 
			$data['stts_input'] = 'tambah_from_transaksi';
			$data['dateIn'] = $dateorder[0];
			$data['dateOut'] = $dateorder[1];
			$data['lamahari'] = $lamahari;
			$data['kode_villa'] = $db->kode_villa;
			$this->load->view('interface/konten_tamu_tambah', $data , false); 
		?>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php endforeach; ?>

<div class="modal fade" id="tamulama">
  <div class="modal-dialog">
    <div class="modal-content">
	  <div class="modal-body">
        <form class="form-horizontal" role="form">
		  <div class="form-group">
			<label for="NamaTamuLama" class="col-sm-2 control-label">Cari Data by Nama</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" id="NamaTamuLama" placeholder="Nama">
			</div>
		  </div>
		</form>
		<div id="hasilcaritamulama"></div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
var kdvilla;
$(".villabtn").click(function(){
	var kdvilla = $(this).data('kdvilla');
	// alert(kdvilla);
	$("#NamaTamuLama").keyup(function(){
	var nama = $("#NamaTamuLama").val();
		// alert(kdvilla);
		$.ajax({
			url:'<?=base_url()?>ordervilla_caritamulama/index/'+nama+'/?dateIn=<?=$dateorder[0]?>&dateOut=<?=$dateorder[1]?>&lamahari=<?=$lamahari?>&kdvilla='+kdvilla, cache:false,
			beforeSend:function(){
				$("#hasilcaritamulama").html("Please wait....");
			},
			success:function(msg){
				$("#hasilcaritamulama").html(msg);
			}
		})
	});
});
</script>