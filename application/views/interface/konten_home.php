	<div class="form-group">
		<div class="col-md-12 input-group">											
			<?php date_default_timezone_set('Asia/Jakarta');?>
			<?php gmdate("Y-m-d H:i:s", time()+60*60*7);?>
			<?php $namaHari = array("Ahad","Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu");?>
			<?php $namaBulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Desember");?>
			<?php $today= date('l, F j, Y');?>
			<?php //$sekarang = $namaHari[date('N')].",".date('j')." ".$namaBulan[date('n')-1]." ".date('Y');?>			
			
			<p align="right"><font color="white" size="50px"><?=date("H:i:s")?></font><br/>
			<font color="white"><?=$today;?></font></p>
		</div>
	</div>
	