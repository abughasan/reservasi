<div class="panel panel-default">	<div class="panel panel-default">			<div class="panel-heading">		  <h4 class="panel-title">						<?=showicon('cloud-download');?> CATATAN UTANG PER PERIODE					  </h4>		</div>		<div class="panel-body">									<!-- Begin-->					<div class="span6 pull-right">			<?php echo form_open("fin_utang_perperiod", 'class="navbar-form pull-right"'); ?>								<div class="span6 pull-right">					<input type="" placeholder="Masukan Tanggal" class="form-control" name="tgl1" id="tgl1" data-provide="datepicker" data-date-autoclose="true" data-date="date(yyyy-mm-dd)" data-date-format="yyyy-mm-dd" required/>																<input type="" placeholder="Masukan Tanggal" class="form-control" name="tgl2" id="tgl2" data-provide="datepicker" data-date-autoclose="true" data-date="date(yyyy-mm-dd)" data-date-format="yyyy-mm-dd" required/>																				<button name="submit" type="submit" class="btn btn-primary"><i class="icon-search icon-white"></i> Cari Data</button>					<a href="fin_utang_perperiod/cetak" target="_blank" class="btn btn-default"><?=showicon('print');?> Cetak </a>				</div>			<?php echo form_close(); ?>			</div>						<div class="cleaner_h5"></div>				<hr>			<!-- Start data input -->			<p class="text-center"><strong><font size="5">LAPORAN UTANG PT. VILLA DELIMA</font></strong><br/>Periode : <?=$this->session->userdata('mulai');?> - <?=$this->session->userdata('akhir');?></p>								<table class="table table-bordered table-hover">					<tr  class="danger">						<th>NO.</th>												<th>Tanggal</th>						<th>Keterangan</th>						<th>Jumlah</th>					</tr>					<?php $i=0; foreach ( $keu->result() as $row ) : $i++;?>					<tr>						<td><?=$i?></td>												<td><?=$row->tanggal_transaksi?></td>						<td><?=$row->keterangan?></td>						<td class="text-right">							<?php 								if($row->kredit==0) :									echo number_format($row->debet,0,'','.');								else:									echo '('.number_format($row->kredit,0,'','.').')';								endif;							?>						</td>					</tr>					<?php endforeach; ?>					<?php if ($keu->num_rows() == 0): ?>						<tr><td colspan=3>Belum ada transaksi</td></tr>					<?php endif; ?>					<tr>						<td colspan=3>Total</td>						<td class="danger text-right"><b><?=number_format($keu_total_debet-$keu_total_kredit,0,'','.')?></b></td>					</tr>				</table>						<!--end data-->			</div>	</div>			<script>	$(function() {		$( "#tgl1" ).datepicker({			defaultDate: "+1w",			dateFormat: "yy-mm-dd",			// changeMonth: true,			numberOfMonths: 1,			onClose: function( selectedDate ) {				$( "#tgl2" ).datepicker( "option", "minDate", selectedDate );			}		});		$( "#tgl2" ).datepicker({			defaultDate: "+1w",			dateFormat: "yy-mm-dd",			// changeMonth: true,			numberOfMonths: 1,			onClose: function( selectedDate ) {				$( "#tgl1" ).datepicker( "option", "maxDate", selectedDate );							}		});	});</script>