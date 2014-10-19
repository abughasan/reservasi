<div class="jumbotron">
  <h2>Hello <?= $user ; ?>, ikuti 4 langkah berikut, untuk kemudahan transaksi inap</h2>
  <p>4 langkah mudah memesan villa
	<br>
		
	<div class="row">
		<div class="col-md-6">	
		<ol>
				<li>tentukan tanggal check in dan tanggal check out.</li>
				<li>memilih villa yang yang diinginkan untuk menginap.</li>
				<li>isi data transaksi yang telah disediakan sistem </li>
				<li>cetak invoice yang bersangkutan</li>
		</ol>
	</div>
		
	<div class="panel-group" id="accordion">
	<div class="panel panel-default">
	<div class="panel-heading">
	<h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
			  <?=showicon('calendar') ?> PILIH TANGGAL BOOKING
			</a>
		  </h4>
		  
		  <div id="collapseOne" class="panel-collapse collapse in">
		  <div class="panel-body">
	
				<div class="">			
					<form role="form" method="post" action="<?=base_url()?>ordervilla/index/2">	
						<div class="col-md-6">			
						<input type="" placeholder="Tanggal Check-in" class="form-control pilihtanggal" name="tglcekin" id="tglcekin" required/>											
						</div>
						
						<div class="col-md-6">			
						<input type="" placeholder="Tanggal Check-out" 	class="form-control pilihtanggal" name="tglcekout" id="tglcekout" required/>															
						</div>
						
						<div class="col-md-6" align="right">				
						<br />
						<input type="hidden" placeholder="Lama Hari" class="form-control" name="lamahari" id="lamahari" />
						<span class="lamahari pull-left label label-warning" style=""></span>
						</div>
						
						<div class="col-md-6" align="right">				
						<br />
						<input type="submit" name="submit" class="btn btn-primary" value="Lanjutkan >>">	
						</div>
					</form>	
				</div>
			</div>
			</div>		
	</div>
	</div>
	</div>
	</div>		
</div>
<script>
	$(function() {
		$( "#tglcekin" ).datepicker({
			defaultDate: "+1w",
			dateFormat: "yy-mm-dd",
			// changeMonth: true,
			numberOfMonths: 2,
			onClose: function( selectedDate ) {
				$( "#tglcekout" ).datepicker( "option", "minDate", selectedDate );
			}
		});
		$( "#tglcekout" ).datepicker({
			defaultDate: "+1w",
			dateFormat: "yy-mm-dd",
			// changeMonth: true,
			numberOfMonths: 2,
			onClose: function( selectedDate ) {
				$( "#tglcekin" ).datepicker( "option", "maxDate", selectedDate );
				var dateIn = new Date($("#tglcekin").val());
				var dateOut = new Date($("#tglcekout").val());
				var lamahari = new Date(dateOut - dateIn);
				var daycount = lamahari/1000/60/60/24;
				$("#lamahari").val(daycount+" malam");
				$(".lamahari").html(daycount+" malam");
				// alert(lamahari);
			}
		});
	});
</script>
  