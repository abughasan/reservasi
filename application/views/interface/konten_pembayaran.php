	<div class="panel panel-primary">
		<div class="panel panel-default">	
		<div class="panel-heading">
		  <h4 class="panel-title">			
			  <?=showicon('book');?> DATA PEMBAYARAN
		  </h4>
		</div>
		<div class="panel-body">
			<ul class="nav nav-tabs">
			  <li><a href="#lunas" data-toggle="tab">LUNAS</a></li>
			  <li class="active"><a href="#blmlunas" data-toggle="tab">BELUM LUNAS</a></li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
			  <div class="tab-pane fade" id="lunas">
			  
					<table class="table table-hover">
						<thead>
							<tr>
								<th>No. Transaksi</th>
								<th>Tgl Transaksi</th>
								<th>Nama Tamu</th>
								<th>Villa Dibooking</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($paid->result() as $rows) : ?>
							<?php $det = $this->app_model->getSelectedData('tbl_transaksi',array('no_transaksi'=>$rows->notrans))->row(); ?>
							<tr>
								<td><?=$rows->notrans?></td>
								<td><?=$det->tgl_transaksi?></td>
								<td><?=$this->app_model->getSelectedData('tbl_tamu',array('id_tamu'=>$det->id_tamu))->row()->nama_tamu?></td>
								<td><?=$this->app_model->getSelectedData('tbl_villa',array('kode_villa'=>$det->kode_villa))->row()->nama_villa?></td>
								<td>
									<a href="<?=base_url()?>pembayaran/bayar/<?=$rows->notrans?>" class="btn btn-warning"><?=showicon('eye-open');?> Detail</a>&nbsp;
									<a href="<?=base_url()?>pembayaran/kwitansi/<?=$rows->notrans?>" target="_blank" class="btn btn-default"><?=showicon('print');?> Cetak</a>
								</td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
			  
			  </div>
			  <div class="tab-pane fade in active" id="blmlunas">
					
					<table class="table table-hover">
						<thead>
							<tr>
								<th>No. Transaksi</th>
								<th>Tgl Transaksi</th>
								<th>Nama Tamu</th>
								<th>Villa Dibooking</th>
								<th>Aksi <?= $tunpaid->num_rows() ?></th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($tunpaid->result() as $rows) : ?>
							<?php $det = $this->app_model->getSelectedData('tbl_transaksi',array('no_transaksi'=>$rows->notrans))->row(); ?>
							<tr>
								<td><?=$rows->notrans?></td>
								<td><?=$det->tgl_transaksi?></td>
								<td><?=$this->app_model->getSelectedData('tbl_tamu',array('id_tamu'=>$det->id_tamu))->row()->nama_tamu?></td>
								<td><?=$this->app_model->getSelectedData('tbl_villa',array('kode_villa'=>$det->kode_villa))->row()->nama_villa?></td>
								<td>
									<a href="<?=base_url()?>pembayaran/bayar/<?=$rows->notrans?>" class="btn btn-warning"><?=showicon('ok-circle');?> Bayar</a>&nbsp;
									<a href="<?=base_url()?>pembayaran/kwitansi/<?=$rows->notrans?>" target="_blank" class="btn btn-default"><?=showicon('print');?> Cetak</a>
								</td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
					
			  </div>
			 
			</div>
		</div>
		</div>
	</div>
	
	
	