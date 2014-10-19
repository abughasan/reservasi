			<div class="row">
				
				<div class="col-md-8">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				
					<div align="">		
						<?php echo $notes?>		
					</div>
					
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
				<div class="col-md-4">
					<form method="post" action="cari">
					<div class="cleaner_h60"></div>
					<div class="cleaner_h30"></div>
					<div class="form-group">
						<label for="pilih_villa"><font color="#fff">Pilih Villa</font></label>
						<select id="pil_villa" name="pil_villa" class="form-control" required>
							<option value="">--Pilih Villa--</option>
							<?php foreach($dt_villa->result() as $rows): ?>
								<option value="<?=$rows->kode_villa?>" <?php (($rows->kode_villa==$this->session->userdata('kalender_kode_villa')) ? print 'selected' : '' ) ?>><?=$rows->kode_villa?> - <?=$rows->nama_villa?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">						
						
					</div>					
					</form>
				</div>
			</div>
			
<script>
$('.booked').popover();
$("#pil_villa").change(function(){
	var kode_villa = $("#pil_villa option:selected").val();
	$.ajax({
		url: '<?=base_url()?>kalender_transaksi/villa_sess/'+kode_villa, cache:false,
		success: function(msg){
			// alert(msg);
			location.reload();
		}
	});
});
</script>