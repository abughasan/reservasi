<div class="panel panel-default">	
		<div class="panel-heading">
		  <h4 class="panel-title">			
			  <?=showicon('cloud-download');?> CATATAN PENGELUARAN PER BULAN, DATA per : 
			  <select id="tahunkalender" class="hidden-print">
				<option value="2014" <?php (($tahun=="2014") ? print 'selected' : '' )?>>2014</option>
				<option value="2015" <?php (($tahun=="2015") ? print 'selected' : '' )?>>2015</option>
			  </select> 
			  <select id="bulankalender" class="hidden-print">
			  <?php foreach ($this->app_model->getAllData('tbl_kalender')->result() as $row): ?>
				<option value="<?=str_pad($row->id,2,"0",STR_PAD_LEFT)?>" <?php (($row->id==$kal_day->row()->id) ? print 'selected' : '' )?>><?=$row->bulan?></option>
			  <?php endforeach; ?>
			  </select>
		  </h4>
		</div>
		<div class="panel-body">						
			<!-- Begin-->		
			<div class="cleaner_h5"></div>	
			<div id="labarugi_content"></div>
		</div>
	</div>

<script>
	var bulan = $("#bulankalender option:selected").val();
	var bulantext = $("#bulankalender option:selected").text();
	var tahun = $("#tahunkalender option:selected").val();
$.ajax({
	url:'<?=base_url()?>fin_labarugi/view/'+bulan+'/'+tahun+'/'+bulantext, cache: false,
	beforeSend: function(){
		$("#labarugi_content").html("<img src=<?=base_url()."assets/img/ajax-loader-small.gif"?> />")
	},
	success: function(msg){
		$("#labarugi_content").html(msg);
		$("#judul_pengeluaran").html(bulantext+' '+tahun);
	}
  });
$("#bulankalender").change(function(){
	var bulan = $("#bulankalender option:selected").val();
	var bulantext = $("#bulankalender option:selected").text();
	var tahun = $("#tahunkalender option:selected").val();
	$.ajax({
	url:'<?=base_url()?>fin_labarugi/view/'+bulan+'/'+tahun+'/'+bulantext, cache: false,
	beforeSend: function(){
		$("#labarugi_content").html("<img src=<?=base_url()."assets/img/ajax-loader-small.gif"?> />")
	},
	success: function(msg){
		$("#labarugi_content").html(msg);
		$("#judul_pengeluaran").html(bulantext+' '+tahun);
	}
  });
});
</script>