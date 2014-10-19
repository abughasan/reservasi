<div class="panel panel-default">	
		<div class="panel-heading">
		  <h4 class="panel-title">			
			  <?=showicon('cloud-download');?> CATATAN PEMASUKAN PER BULAN, DATA per : 
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
			<!--Tabulasi Begin-->		
			<div class="cleaner_h5"></div>	
			<ul class="nav nav-tabs" id="myTab">
				<li class="active"><a href="#data" data-toggle="tab" id="judul_pengeluaran"><?php //=$this->app_model->getSelectedData('tbl_kalender')->row()->bulan?> DATA</a></li>
				 
			</ul>
		
			<div class="tab-content">  
				<div class="tab-pane fade in active" id="data">  
					<!-- START DATA INPUT FOR CHECKOUT LIST -->
					<div  id="data_pengeluaran">
					</div>
				</div>
				
			</div>
	</div>
	</div>

<script>
	var bulan = $("#bulankalender option:selected").val();
	var bulantext = $("#bulankalender option:selected").text();
	var tahun = $("#tahunkalender option:selected").val();
$.ajax({
	url:'<?=base_url()?>fin_pemasukan/view/'+bulan+'/'+tahun, cache: false,
	beforeSend: function(){
		$("#data_pengeluaran").html("<img src=<?=base_url()."assets/img/ajax-loader-small.gif"?> />")
	},
	success: function(msg){
		$("#data_pengeluaran").html(msg);
		$("#judul_pengeluaran").html(bulantext+' '+tahun);
	}
  });
$("#bulankalender").change(function(){
	var bulan = $("#bulankalender option:selected").val();
	var bulantext = $("#bulankalender option:selected").text();
	var tahun = $("#tahunkalender option:selected").val();
	// alert(bulantext);
	// window.location='<?=base_url()?>fin_pengeluaran/index/'+bulan+'/'+tahun;
	$.ajax({
	url:'<?=base_url()?>fin_pemasukan/view/'+bulan+'/'+tahun, cache: false,
	beforeSend: function(){
		$("#data_pengeluaran").html("<img src=<?=base_url()."assets/img/ajax-loader-small.gif"?> />")
	},
	success: function(msg){
		$("#data_pengeluaran").html(msg);
		$("#judul_pengeluaran").html(bulantext+' '+tahun);
	}
  });
});
</script>