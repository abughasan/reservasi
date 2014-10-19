<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<script type='text/javascript'>
    $(function(){

    });    
    function view_buku()
    {
        var buku = $('select[name=buku]').val();
        var bulan = $('select[name=bulan]').val();
        var tahun = $('select[name=tahun]').val();
        load_no_loading('transaksi/buku_besar/'+buku+'_'+bulan+'_'+tahun,'#content');
    }
</script>

<div class='title'>Buku Besar</div>

<?php
    echo $this->fungsi->build_select_common('buku',$buku,'id','nama','onchange="view_buku()"',$cur_buku);
    echo '&nbsp;&nbsp;';
    echo $this->fungsi->build_select_month('bulan','onchange="view_buku()"',$cur_bulan);
    echo '&nbsp;&nbsp;';
    echo $this->fungsi->build_select_year('tahun','onchange="view_buku()"',$cur_tahun);
?>

<br /><br />

<table class='grid'>
    <tr>
        <th width='14%' align="right">Tanggal</th>
        <th width='50%'>Keterangan</th>
        <th align="right">Debet</th>
        <th align="right">Kredit</th>
        <th align="right">Saldo</th>
    </tr>
<?php
$delimiter = '.';
$space = '&nbsp;&nbsp;&nbsp;';
$saldo = $info;
$sign = 1;
$saldo_pecah = $this->fungsi->pecah(abs($saldo),$delimiter);
if($saldo<0)
{
    $sign = 2;	    
    $saldo_str = '('.$saldo_pecah.')';
}
else
{
    $saldo_str = $saldo_pecah;
}
$saldo = abs($saldo);

?>
    <tr>
        <td align="right"></td>
        <td>Saldo Awal</td>		
        <td align="right"></td>
        <td align="right"></td>
        <td align="right"><?php echo $saldo_str ?></td>
    </tr>    
<?php
$tg = array();
$temp_saldo = $saldo;
$jumlah_debet = 0;
$jumlah_kredit = 0;
$tulis = $saldo_str;
$i = 0;
foreach($detail->result() as $row)
{
    $i ++;
    $tgl = $this->fungsi->tanggal_jurnal($row->tanggal_transaksi);
    $nominal_debet = $row->debet;
    $nominal_kredit = $row->kredit;
    $jumlah_debet += $nominal_debet;
    $jumlah_kredit += $nominal_kredit;
    $temp_saldo = $this->trmodel->get_saldo_akhir($temp_saldo,$nominal_debet,$nominal_kredit,$sign);
    $nominal_debet = $this->fungsi->pecah($nominal_debet,$delimiter);
    $nominal_kredit = $this->fungsi->pecah($nominal_kredit,$delimiter);
    $uraian = $row->keterangan;
    ?>
    <tr>
        <td align="right">
        <?php 
            if(!in_array($tgl[0],$tg))
            { 
                echo $tgl[0];
            }
            echo $space."<span class='box'>".$tgl[1]."</span>";
            $tulis = $this->fungsi->pecah($temp_saldo,$delimiter,true);
        ?>
        </td>
            <td><?php echo $uraian?></td>
            <td align="right"><?php echo $nominal_debet ?></td>
            <td align="right"><?php echo $nominal_kredit ?></td>
            <td align="right"><?php echo $tulis ?></td>
    </tr>
    <?php 

    $tg[]=$tgl[0];
}

?>
    <tr class='jumlah'>
        <td align="right"></td>
        <td>Jumlah</td>		
        <td align="right"><?php echo $this->fungsi->pecah($jumlah_debet) ?></td>
        <td align="right"><?php echo $this->fungsi->pecah($jumlah_kredit) ?></td>
        <td align="right"><?php echo $tulis ?></td>
    </tr>  
</table>