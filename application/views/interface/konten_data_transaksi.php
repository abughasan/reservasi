<div id="container">
	
	<div class="panel panel-primary">
		<div class="panel panel-default">	
		<div class="panel-heading">
		  <h4 class="panel-title">			
			  <?=showicon('cloud-download');?> CATATAN DATA TRANSAKSI		
		  </h4>
		</div>
		<div class="panel-body">						
			<!--Tabulasi Begin-->		
			<div class="cleaner_h5"></div>
				<div class="col-xs-3 pull-right">
					<div class="form-group">
					<div class="col-xs-12">
						<input type="text" class="form-control" placeholder="Search" id="search"> <i id="search_img"></i>
					</div>
					<!--<div class="col-xs-6">
						<select class="form-control ">
							<option value="booking_list">BOOKING</option>
							<option value="checkin_list">CHECK-IN</option>
							<option value="checkout_list">CHECK-OUT</option>
							<option value="cancel_list">CANCEL</option>
						</select>
					</div>-->
					</div>
				</div>
			<ul class="nav nav-tabs" id="myTab">
				<li class="active"><a href="#booking_list" data-toggle="tab">BOOKING LIST</a></li>
				<li><a href="#checkin_list" data-toggle="tab">CHECK-IN LIST</a></li>
				<li><a href="#checkout_list" data-toggle="tab">CHECK-OUT LIST</a></li>  
				<li><a href="#cancel_list" data-toggle="tab">CANCEL LIST</a></li>  
			</ul>
		
		<div class="tab-content">  
			<div class="tab-pane fade in active" id="booking_list">  
				<!-- START DATA INPUT FOR CHECKOUT LIST -->
				<div  id="booking_list_content">
				</div>
			</div>
			
			<div class="tab-pane" id="checkin_list">
				<!-- START DATA INPUT FOR CHECKOUT LIST -->
				<div id="checkin_list_content">
				</div>
			</div>	  
		
			<div class="tab-pane" id="checkout_list">
				<!-- START DATA INPUT FOR CHECKOUT LIST -->
				<div  id="checkout_list_content">
				</div>
			</div>	  
			
			<div class="tab-pane" id="cancel_list">
				<!-- START DATA INPUT FOR CHECKOUT LIST -->
				<div  id="cancel_list_content">
				</div>
			</div>	  			
			
			
		</div>
	</div>
	</div>
</div>

<!--START MODAL-->
<?php 
foreach($detail_transaksi->result_array() as $db){ ?>
<div class="modal fade" id="myModal<?=$db['no_transaksi']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h3 class="modal-title" id="myModalLabel">DETAIL</h3>
      </div>
      <div class="modal-body">
        
		<!-- buat detail disini -->				
		<div class="panel panel-warning">
		  <!-- Default panel contents -->
		  <div class="panel-heading">DETAIL TRANSAKSI</div>

		  <!-- Table -->
		  <table class="table asik">
				<tr>
					<!--batas kiri-->
					<td width="20%">Nomor Transaksi </td>
					<td width="3%"> : </td>
					<td width="27%"><?=$db['no_transaksi']?></td>
					<!--batas kanan-->
					<td width="20%">Kode Villa </td>
					<td width="3%"> : </td>
					<td width="27%"><?=$db['kode_villa']?></td>
				</tr>
				<tr>
					<!--batas kiri-->
					<td width="20%">Tanggal Transaksi </td>
					<td width="3%"> : </td>
					<td width="27%"><?=$db['tgl_transaksi']?></td>
					<!--batas kanan-->
					<td width="20%">Nama VIlla </td>
					<td width="3%"> : </td>
					<td width="27%"><?=$db['nama_villa']?></td>
				</tr>
				<tr>
					<!--batas kiri-->
					<td width="20%">Tanggal Check-In </td>
					<td width="3%"> : </td>
					<td width="27%"><kbd><?=$db['tgl_cekin']?><kbd></td>
					<!--batas kanan-->
					<td width="20%">Tarif Villa Perhari</td>
					<td width="3%"> : </td>
					<td width="27%"><?=$db['tarif_villa']?></td>
				</tr>
				<tr>
					<!--batas kiri-->
					<td width="20%">Tanggal Check-Out</td>
					<td width="3%"> : </td>
					<td width="27%"><code><?=$db['tgl_cekout']?><code></td>
					<!--batas kanan-->
					<td width="20%">Lama Inap</td>
					<td width="3%"> : </td>
					<td width="27%"><?=$db['lama_hari']?></td>
				</tr>
				<tr>
					<!--batas kiri-->
					<td width="20%"></td>
					<td width="3%"></td>
					<td width="27%"></td>
					<!--batas kanan-->
					<td width="20%">Total Bayar</td>
					<td width="3%"> : </td>
					<td width="27%"><?=$db['dapat_harga']?></td>
				</tr>
			</table>
			
		</div>
		
		<!-- buat detail disini -->				
		<div class="panel panel-warning">
		  <!-- Default panel contents -->
		  <div class="panel-heading">DETAIL TAMU</div>

		  <!-- Table -->
		  <table class="table asik">
				<tr>
					<!--batas kiri-->
					<td width="20%">Nama Tamu </td>
					<td width="3%"> : </td>
					<td width="27%"><?=$db['nama_tamu']?></td>
					<!--batas kanan-->
					<td width="20%">Nomor ID </td>
					<td width="3%"> : </td>
					<td width="27%"><?=$db['no_kartu_id']?></td>
				</tr>
				<tr>
					<!--batas kiri-->
					<td width="20%">Alamat </td>
					<td width="3%"> : </td>
					<td width="27%"><?=$db['alamat_tamu']?></td>
					<!--batas kanan-->
					<td width="20%"></td>
					<td width="3%"></td>
					<td width="27%"></td>
				</tr>
				<tr>
					<!--batas kiri-->
					<td width="20%">Telp </td>
					<td width="3%"> : </td>
					<td width="27%"><?=$db['tlp']?></td>
					<!--batas kanan-->
					<td width="20%"></td>
					<td width="3%"></td>
					<td width="27%"></td>
				</tr>
			</table>
			
		</div>
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>     
      </div>
    </div>
  </div>
</div>
<?php };?>

<!-- END OF MODAL-->

	
<script>
function pecah(e)
{	
	var arr = e.split('#');
}
	
	var activeTab = "<?php echo base_url();?>transaksi#booking_list";
	$('#search').keyup(function(){
		var val_search = $('#search').val();
		if (val_search==''){val_search=0}
		if (activeTab=="<?php echo base_url();?>transaksi#booking_list" || activeTab=="<?php echo base_url();?>transaksi/#booking_list")
		{
			var opt = 2;
			$.ajax({
				url:'<?=base_url()?>transaksi/view_where/'+val_search+'/'+opt, cache: false,
				beforeSend: function(){
					$("#search_img").html("<img src=<?=base_url()."assets/img/ajax-loader-smalls.gif"?>  /> mencari...")
				},
				success: function(msg){
					$("#search_img").html('');
					$("#booking_list_content").html(msg)
				}
			});
		}
		if (activeTab=="<?php echo base_url();?>transaksi#checkin_list" || activeTab=="<?php echo base_url();?>transaksi/#checkin_list" )
		{
			var opt = 3;
			$.ajax({
				url:'<?=base_url()?>transaksi/view_where/'+val_search+'/'+opt, cache: false,
				beforeSend: function(){
					$("#search_img").html("<img src=<?=base_url()."assets/img/ajax-loader-smalls.gif"?>  /> mencari...")
				},
				success: function(msg){
					$("#search_img").html('');
					$("#checkin_list_content").html(msg)
				}
			});
		}
		if (activeTab=="<?php echo base_url();?>transaksi#checkout_list" || activeTab=="<?php echo base_url();?>transaksi/#checkout_list")
		{
			var opt = 4;
			$.ajax({
				url:'<?=base_url()?>transaksi/view_where/'+val_search+'/'+opt, cache: false,
				beforeSend: function(){
					$("#search_img").html("<img src=<?=base_url()."assets/img/ajax-loader-smalls.gif"?>  /> mencari...")
				},
				success: function(msg){
					$("#search_img").html('');
					$("#checkout_list_content").html(msg)
				}
			});
		}
		if (activeTab=="<?php echo base_url();?>transaksi#cancel_list" || activeTab=="<?php echo base_url();?>transaksi/#cancel_list")
		{
			var opt = 1;
			$.ajax({
				url:'<?=base_url()?>transaksi/view_where/'+val_search+'/'+opt, cache: false,
				beforeSend: function(){
					$("#search_img").html("<img src=<?=base_url()."assets/img/ajax-loader-smalls.gif"?>  /> mencari...")
				},
				success: function(msg){
					$("#search_img").html('');
					$("#cancel_list_content").html(msg)
				}
			});
		}
	});

// $('#myTab a[href="#checkout_list"]').click(function (e) {
$('a[href="#checkout_list"]').on('shown.bs.tab', function (e) {
	activeTab = e.target;
  // e.preventDefault()
  // $(this).tab('show')
  // alert('this is checkout list');
  $.ajax({
	url:'<?=base_url()?>transaksi_checkout/index/', cache: false,
	beforeSend: function(){
		$("#checkout_list_content").html("<img src=<?=base_url()."assets/img/ajax-loader-small.gif"?> />")
	},
	success: function(msg){
		$("#checkout_list_content").html(msg)
	}
  });
})

// $('#myTab a[href="#checkin_list"]').click(function (e) {
$('a[href="#checkin_list"]').on('shown.bs.tab', function (e) {
	activeTab = e.target;
  // e.preventDefault()
  // $(this).tab('show')
  // alert('this is checkout list');
  $.ajax({
	url:'<?=base_url()?>transaksi_checkin/index/', cache: false,
	beforeSend: function(){
		$("#checkin_list_content").html("<img src=<?=base_url()."assets/img/ajax-loader-small.gif"?> />")
	},
	success: function(msg){
		$("#checkin_list_content").html(msg)
	}
  });
})


$('a[href="#cancel_list"]').on('shown.bs.tab', function (e) {
	activeTab = e.target;
  $.ajax({
	url:'<?=base_url()?>transaksi_cancel/index/', cache: false,
	beforeSend: function(){
		$("#cancel_list_content").html("<img src=<?=base_url()."assets/img/ajax-loader-small.gif"?> />")
	},
	success: function(msg){
		$("#cancel_list_content").html(msg)
	}
  });
})

$('a[href="#booking_list"]').on('shown.bs.tab', function (e) {
	activeTab = e.target;
  $.ajax({
	url:'<?=base_url()?>transaksi/view/', cache: false,
	beforeSend: function(){
		$("#booking_list_content").html("<img src=<?=base_url()."assets/img/ajax-loader-small.gif"?> />")
	},
	success: function(msg){
		$("#booking_list_content").html(msg)
	}
  });
})

$.ajax({
	url:'<?=base_url()?>transaksi/view/', cache: false,
	beforeSend: function(){
		$("#booking_list_content").html("<img src=<?=base_url()."assets/img/ajax-loader-small.gif"?> />")
	},
	success: function(msg){
		$("#booking_list_content").html(msg)
	}
  });
</script>
