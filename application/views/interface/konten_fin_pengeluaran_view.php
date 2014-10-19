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
		<td><?=number_format((($row->kredit==0)?$row->debet:$row->kredit),0,'','.')?></td>
	</tr>
	<?php endforeach; ?>
	<?php if ($keu->num_rows() == 0): ?>
		<tr><td colspan=3>Belum ada transaksi</td></tr>
	<?php endif; ?>
	<tr>
		<td colspan=2></td>
		<td class="danger"><b><?=number_format($keu_total,0,'','.')?></b></td>
	</tr>
</table>