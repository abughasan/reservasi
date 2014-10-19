<div class="panel panel-primary">
		<div class="panel-heading">Data Villa Telah di Booking</div>
		<div class="panel-body">
			<form class="form-inline" role="form">
			  <div class="form-group">
				Tampilkan data :
			  </div>
			  <div class="form-group">
				<label class="sr-only" for="exampleInputEmail2">Tampilkan dat pertanggal</label>
				<input value="<?=@$filter[0]?>" type="date" class="form-control" placeholder="Pilih tanggal" id="dateSelected" data-provide="datepicker" data-date-autoclose="true" data-date-format="yyyy-mm-dd">
			  </div>
			 <!-- <div class="form-group">
				<label class="sr-only" for="exampleInputPassword2">Password</label>
				<select class="form-control" id="kdvilla">
					<option value="">- pilih villa -</option>
					<?php foreach ($dt_villa->result() as $villa): ?>
						<option value="<?=$villa->kode_villa?>" <?php (($villa->kode_villa == @$filter[1]) ? print 'selected' : '') ?>>
							<?=$villa->nama_villa?>
						</option>
					<?php endforeach; ?>
				</select>
			  </div> -->
			  <a href="<?=base_url()?>villa_booked" class="btn btn-info">Reset filter</a>
			</form>
		</div>
		<?php if (isset ($dt_villa_v)): ?>
		<table class="table">
			<thead>
			<tr >
				<th>No.</td>
				<th>Kode Villa</td>
				<th>Nama Villa</td>
				<th>Status Villa</td>
				<th>Keterangan</td>
			</tr>
			</thead>
			<tbody>
			<?php
				$no = 1;
				if($dt_villa_v->num_rows()>0)
				{
					foreach($dt_villa_v -> result_array() as $db)
					{
					if (ISSET($status_booking)):
					$status = $this->app_model->manualQuery("
						SELECT * FROM tbl_transaksi tt
						WHERE
							(tt.tgl_cekin <= '{$dateSelected}' AND tt.tgl_cekout >= '{$dateSelected}' AND tt.kode_villa = '{$db['kode_villa']}' )
						 OR
							(tt.tgl_cekin < '{$dateSelected}' AND tt.tgl_cekout >= '{$dateSelected}' AND tt.kode_villa = '{$db['kode_villa']}' )
						 OR
							(tt.tgl_cekin >= '{$dateSelected}' AND tt.tgl_cekout < '{$dateSelected}' AND tt.kode_villa = '{$db['kode_villa']}' )
					");
					endif;
				?>
				<tr class="<?PHP
					IF ($status->num_rows()>0):
					?>danger<?php
					else:
					?>success<?php
					endif;
					?>">
					<td><?php echo $no; ?></td>
					<td><?php echo $db['kode_villa']; ?></td>
					<td><?php echo $db['nama_villa']; ?></td>
					<td>
					<?PHP
					IF ($status->num_rows()>0):
					?><span class="label label-danger">Booked</span><?php
					else:
					?><span class="label label-success">Available</span><?php
					endif;
					?>
					</td>					
					<td></td>
					<td></td>
				</tr>
				<?php
					$no++;
					}
				}
				else
				{
					?>
					
				<tr>
					<td colspan="6">Belum ada data</td>
				</tr>
					<?php
				}
				
				endif;
			?>
			</tbody>
		</table>
	</div>
 <script>
 	$("#dateSelected").datepicker().on('changeDate',function(){
		var dateSelected = $("#dateSelected").val();
		var kdvilla = $("#kdvilla").val();
		window.location="<?=base_url()?>villa_booked/index/filter/"+dateSelected+"_";
	});
 	$("#kdvilla").change(function(){
		var dateSelected = $("#dateSelected").val();
		var kdvilla = $("#kdvilla").val();
		window.location="<?=base_url()?>villa_booked/index/filter/"+dateSelected+"_";
	});
 </script>