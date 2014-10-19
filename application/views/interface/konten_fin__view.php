<table class="table table-bordered table-hover">
	<tr  class="danger">
		<th>NO.</th>
		<th>Keterangan</th>
		<th>Jumlah</th>
	</tr>
	<?php $i=0; foreach ( $keu->result() as $row ) : $i++;?>
	<tr>
		<td><?=$i?></td>
		<td><?=$row->keterangan?></td>
		<td class="text-right">
			<?php 
				if($row->kredit==0) :
					echo number_format($row->debet,0,'','.');
				else:
					echo '('.number_format($row->kredit,0,'','.').')';
				endif;
			?>
		</td>
	</tr>
	<?php endforeach; ?>
	<?php if ($keu->num_rows() == 0): ?>
		<tr><td colspan=3>Belum ada transaksi</td></tr>
	<?php endif; ?>
	<tr>
		<td colspan=2>Total <?=$kas?> bulan <?=$bulantext?></td>
		<td class="danger text-right"><b><?=number_format($keu_total_debet-$keu_total_kredit,0,'','.')?></b></td>
	</tr>
</table>