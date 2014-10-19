<div id="container">
	
	<div class="panel panel-primary">
		<div class="panel panel-default">	
		<div class="panel-heading">
		  <h4 class="panel-title">			
			  <?=showicon('cloud-download');?> HOUSE KEEPING
		  </h4>
		</div>
		<div class="panel-body">						
			<!--Tabulasi Begin-->		
			<div class="cleaner_h5"></div>	
			<ul class="nav nav-tabs" id="myTab">
				<li class="active"><a href="#pengajuan_list" data-toggle="tab">PENGAJUAN</a></li>
				<li><a href="#ganti_list" data-toggle="tab">PENGGANTIAN / PERBAIKAN</a></li>				
			</ul>
		
		<div class="tab-content">  
			<div class="tab-pane fade in active" id="pengajuan_list">  
				<!-- START DATA INPUT FOR CHECKOUT LIST -->
				<div  id="pengajuan_list_content">
				</div>
			</div>
			
			<div class="tab-pane fade in active" id="ganti_list">
				<!-- START DATA INPUT FOR CHECKOUT LIST -->
				<div  id="ganti_list_content">
				</div>
			</div>	  			
		</div>
	</div>
	</div>
</div>

<script>


$('a[href="#ganti_list"]').on('shown.bs.tab', function (e) {
  // e.preventDefault()
  // $(this).tab('show')
  // alert('this is checkout list');
  $.ajax({
	url:'<?=base_url()?>pengajuan_ganti/index/', cache: false,
	beforeSend: function(){
		$("#ganti_list_content").html("Please wait...")
	},
	success: function(msg){
		$("#ganti_list_content").html(msg)
	}
  });
})

$('a[href="#pengajuan_list"]').on('shown.bs.tab', function (e) {
  $.ajax({
	url:'<?=base_url()?>pengajuan/view/', cache: false,
	beforeSend: function(){
		$("#pengajuan_list_content").html("Please wait...")
	},
	success: function(msg){
		$("#pengajuan_list_content").html(msg)
	}
  });
})

// tampilan awal 

$.ajax({
	url:'<?=base_url()?>pengajuan/view/', cache: false,
	beforeSend: function(){
		$("#pengajuan_list_content").html("Please wait...")
	},
	success: function(msg){
		$("#pengajuan_list_content").html(msg)
	}
  });
</script>
