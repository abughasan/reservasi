<table class="table">
	<tr>
		<th colspan=3>
		<h4 class="text-center"><strong>Laporan Laba / Rugi PT. VILLA DELIMA</strong><BR/><?=$bulantext?> <?=$tahun?></h4>
		</th>
	</tr>
	<tr class="active">
		<td><b>a. PEMASUKAN</b></td>
		<td></td>
		<td></td>
	</tr>
	<?php $i=0; foreach ($pemasukan->result() as $d) : $i++; ?>
	<tr>
		<td>&ensp;a. <?=$i?> <?=$d->keterangan?></td>
		<td class="text-right"><?=angka($d->debet)?></td>
		<td class="text-right"></td>
	</tr>
	<?php endforeach; ?>
	<tr>
		<td><b>Total Pemasukan</b></td>
		<td></td>
		<td class="text-right success"><?=angka($pemasukan_total)?></td>
	</tr>			<tr class="active">
		<td><b>b. PENGELUARAN</b></td>
		<td></td>
		<td></td>
	</tr>
	<?php $a=0; foreach ($pengeluaran->result() as $k) : $a++; ?>
	<tr>
		<td>&ensp;b. <?=$a?> <?=$k->keterangan?></td>
		<td class="text-right"><?=angka($k->kredit)?></td>
		<td class="text-right"></td>
	</tr>
	<?php endforeach; ?>
	<tr>
		<td><b>Total Pengeluaran</b></td>
		<td></td>
		<td  class="text-right danger"><?=angka($pengeluaran_total)?></td>
	</tr>
	<?php $lr = $pemasukan_total-$pengeluaran_total; ?>
	<tr>
		<td colspan=3></td>
	</tr>
	<tr class="active">
		<td><b>Selisih Pemasukan dan Pengeluaran</b></td>
		<td class="text-right"><b><?PHP if($lr>0) : echo "LABA"; elseif($lr==0): echo "-"; else: echo "RUGI"; endif; ?></b></td>
		<td class="text-right <?PHP if($lr>=0) : echo "success"; else: echo "danger"; endif; ?>"><?=angka($lr)?></td>
	</tr>
</table>