<?php
function createDateRangeArray($strDateFrom,$strDateTo,$id_tamu)
	{
		// takes two dates formatted as YYYY-MM-DD and creates an
		// inclusive array of the dates between the from and to dates.

		// could test validity of dates here but I'm already doing
		// that in the main script

		$aryRange=array();

		$iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
		$iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

		if ($iDateTo>=$iDateFrom)
		{
			array_push($aryRange,date('Y-m-d',$iDateFrom)."_".$id_tamu); // first entry
			while ($iDateFrom<$iDateTo)
			{
				$iDateFrom+=86400; // add 24 hours
				array_push($aryRange,date('Y-m-d',$iDateFrom)."_".$id_tamu);
			}
		}
		return $aryRange;
	}
?>
		<div class="panel panel-default">	
		<div class="panel-heading">
		  <h4 class="panel-title">			
			  Data Booking Tanggal : 
			  <select id="tahunkalender">
				<option value="2014" <?php (($tahun=="2014") ? print 'selected' : '' )?>>2014</option>
				<option value="2015" <?php (($tahun=="2015") ? print 'selected' : '' )?>>2015</option>
			  </select> 
				<select id="bulankalender">
			  <?php foreach ($this->app_model->getAllData('tbl_kalender')->result() as $row): ?>
				<option value="<?=$row->id?>" <?php (($row->id==$kal_day->row()->id) ? print 'selected' : '' )?>><?=$row->bulan?></option>
			  <?php endforeach; ?>
				</select>
		  </h4>
		</div>
		<div class="panel-body">
		
		<table class="table table-bordered">
				<thead>
				<tr class="info">
					<th>Villa/Tgl</th>
					<?php $z = $kal_day->row()->jml_hari; 
					for ($a=1;$a<=$z;$a++) { ?>
						<th><?=$a?></th>
					<?php } ?>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($villa->result() as $row): ?>
				<?php 
				if ($mon==12):
				$maxmonth = 0;
				else:
				$maxmonth = $mon;
				endif;
				if ($mon==1):
				$minmonth = 13;
				else:
				$minmonth = $mon;
				endif;
				$dateselected = $this->app_model->manualQuery("
					SELECT tgl_cekin,tgl_cekout,id_tamu,MONTH(tgl_cekin )m_in, MONTH(tgl_cekout) m_out FROM tbl_transaksi 
					WHERE kode_villa = '{$row->kode_villa}'
						AND
					(
						(MONTH(tgl_cekin) = {$mon} and MONTH(tgl_cekout) = {$maxmonth}+1 and (id_status_v = 2 or id_status_v = 3))
						or
						(MONTH(tgl_cekin) = {$mon} and MONTH(tgl_cekout) = {$mon} and (id_status_v = 2 or id_status_v = 3))
						or
						(MONTH(tgl_cekin) = {$minmonth}-1 and MONTH(tgl_cekout) = {$mon} and (id_status_v = 2 or id_status_v = 3))
					)
					AND (YEAR(tgl_cekin) = {$tahun} OR YEAR(tgl_cekout) = {$tahun})
					ORDER BY tgl_cekin ASC
				");
				$datarange = array();
				foreach ($dateselected->result() as $do):
				$m_in = str_pad($do->m_in,2,"0",STR_PAD_LEFT);
				$m_out = str_pad($do->m_out,2,"0",STR_PAD_LEFT);
					if($mon > $do->m_in):
					 $dr = createDateRangeArray($tahun."-".$m_out."-01",$do->tgl_cekout,$do->id_tamu);
					elseif($mon < $do->m_out):
					 $dr = createDateRangeArray($do->tgl_cekin,$tahun."-".$m_in."-31",$do->id_tamu);
					elseif($mon == 12 and $mon > $do->m_out):
					 $dr = createDateRangeArray($do->tgl_cekin,$tahun."-".$m_in."-31",$do->id_tamu);
					elseif($mon == 1 and $mon < $do->m_in):
					 $dr = createDateRangeArray($tahun."-".$m_out."-01",$do->tgl_cekout,$do->id_tamu);
					else:
					 $dr = createDateRangeArray($do->tgl_cekin,$do->tgl_cekout,$do->id_tamu);
					endif;
					$datarange = array_merge($datarange,$dr);
					// echo $do->id_tamu;
					// echo $do->tgl_cekout;
				endforeach;
							$object = new stdClass();
							foreach($datarange as $d) {
							// print_r ( list($y,$m,$t) = explode("-",$d) );
							list($y,$m,$t) = explode("-",$d);
							// print_r($years[$y][] = $d);
							list($date,$tamu) = explode("_",$t);
							$tgl = "t_".$date;
							$object->$tgl = $date;
							}
							// print_r($object);
							
				?>
					<tr class="success">
						<td><?=$row->nama_villa?></td>
						<?php 
						$z = $kal_day->row()->jml_hari; 
						$date_create = array();
						for ($a=1;$a<=$z;$a++) {
						$apad = str_pad($a,2,"0",STR_PAD_LEFT);
						$var = "t_".$apad;
								if (EMPTY($object->$var)) :
									$villa = '';
									$class = "success";
								else:
									$villa = showicon('user');
									$class = "danger";
									$b = $object->$var;
								endif;

							?><td class="<?=$class?>"><?php 
								echo $villa;
								// echo @$b;
								// echo $row->kode_villa;
								//CEK IN SIGN CODE 30 minutes left 
								
								$qcin_sign = $this->app_model->manualQuery("
								SELECT day(tgl_cekin) cin, tbl_transaksi.* from tbl_transaksi
								WHERE MONTH(tgl_cekin) = '{$mon}' and YEAR(tgl_cekin) = '{$tahun}' AND kode_villa = '{$row->kode_villa}'
								");

							?></td><?php
						
						} 
				?>	</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
			</div>
			</div>
			

<script>
$('.booked').popover();
$("#bulankalender").change(function(){
	var bulan = $("#bulankalender option:selected").val();
	var tahun = $("#tahunkalender option:selected").val();
	window.location='<?=base_url()?>kalender_m/bulan/'+bulan+'/'+tahun;
});
</script>