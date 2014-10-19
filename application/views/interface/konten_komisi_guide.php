	<div class="panel panel-default">	
		<div class="panel-heading">
		  <h4 class="panel-title">			
			  <?=showicon('cloud-download');?> KOMISI GUIDE	
		  </h4>
		</div>
		<div class="panel-body">
			<table class="table table-bordered table-hover">
				<thead>
					<tr class="warning">
						<th>No. Transaksi</th><th>Nilai Transaksi</th><th>Komisi</th><th>Guide</th><th>Ket</th><th>Sudah Dibayar</th><th>Sisa</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($komisi_guide->result() as $row): ?>
					<tr>
						<td><?=$row->no_transaksi?></td><td><?=$row->nilai_transaksi?></td><td>(<?=$row->komisi_guide?>)<?=$row->totalkomisi?></td><td><?=$this->app_model->getSelectedData('tbl_guide',array('kode_guide'=>$row->kode_guide))->row()->nama_guide?></td>
						<td><?=$row->keterangan?></td><td><?=$row->totalbayar?></td>
						<td><?=$row->sisabayar?>
						<?php if ( $row->sisabayar == 0 ) :?>
						<a class="btn btn-sm btn-info pull-right active">Lunas</a>
						<?php else: ?>
						<a class="btn btn-sm btn-success pull-right bayarbtn" data-no_transaksi="<?=$row->no_transaksi?>">Bayar</a>
						<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
					<tr>
						<td colspan=2 class="info"><b>Total Pengeluaran Komisi </b></td><td><?=$total_komisi->row()->totalkomisi?></td><td colspan=3></td>
					</tr>
				</tbody>
			</table>
			<div></div>
			<table class="table table-bordered table-hover">
				<thead>
					<tr class="warning">
						<th>Peringkat</th><th>Guide</th><th>Total Transaksi</th><th>Total Komisi</th>
					</tr>
				</thead>
				<tbody>
				<?php $i = 0; foreach ($peringkat->result() as $row) : 
				$i++;
				?>
					<tr>
						<td><?=$i?></td><td><?=$this->app_model->getSelectedData('tbl_guide',array('kode_guide'=>$row->kode_guide))->row()->nama_guide?></td><td><?=$row->total_transaksi?></td><td><?=$row->totalkomisi?></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
	<script>
		$( '.bayarbtn' ).click(function(){
			var no_transaksi = $(this).data('no_transaksi');
			var jmlbayar = prompt('Bayar berapa?');
			if (jmlbayar == null) {}else{
			window.location='<?=base_url()?>komisiguide/bayar_komisi/'+no_transaksi+'/'+jmlbayar;
			}
		});
	</script>