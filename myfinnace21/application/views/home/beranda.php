<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<script type='text/javascript'>
$(document).ready(function(){
    var s1 = <?php echo $s1;?>;
    var s2 = <?php echo $s2;?>;
    var s3 = <?php echo $s3;?>;
    // Can specify a custom tick Array.
    // Ticks should match up one for each y value (category) in the series.
    var ticks = <?php echo $axis;?>;
     
    var plot1 = $.jqplot('chart1', [s1, s2, s3], {
        // The "seriesDefaults" option is an options object that will
        // be applied to all series in the chart.
        seriesDefaults:{
            renderer:$.jqplot.BarRenderer,
            rendererOptions: {fillToZero: true}
        },
        // Custom labels for the series are specified with the "label"
        // option on the series option.  Here a series option object
        // is specified for each series.
        series:[
            {label:'Pemasukan'},
            {label:'Pengeluaran'},
            {label:'Laba/Rugi'}
        ],
        // Show the legend and put it outside the grid, but inside the
        // plot container, shrinking the grid to accomodate the legend.
        // A value of "outside" would not shrink the grid and allow
        // the legend to overflow the container.
        legend: {
            show: true,
            placement: 'outsideGrid'
        },
        axes: {
            // Use a category axis on the x axis and use our custom ticks.
            xaxis: {
                renderer: $.jqplot.CategoryAxisRenderer,
                ticks: ticks
            },
            // Pad the y axis just a little so bars can get close to, but
            // not touch, the grid boundaries.  1.2 is the default padding.
            yaxis: {
                pad: 1.05,
                tickOptions: {formatString: 'Rp. %#d'}
            }
        }
    });
});
</script>

<div class="title">Grafik Laba/Rugi Tahun <?php echo date('Y');?></div>
<div id="chart1" style="width:800px; height:400px; margin:0 auto"></div>

<?php
// saldo tiap kas
$buku = $this->trmodel->get_buku();
echo '<div class="title">Saldo Buku Besar Bulan '.$this->fungsi->bulan(date('m')).' '.date('Y').'</div>';
?>
<table class='grid'>
<tr>
    <th>Buku Besar</th>
    <th align='right'>Saldo Bulan Lalu (Rp)</th>
    <th align='right'>Debet (Rp)</th>
    <th align='right'>Kredit (Rp)</th>
    <th align='right'>Saldo (Rp)</th>
</tr>
<?php
foreach($buku->result() as $row)
{
    $detail = $this->trmodel->get_saldo($row->id,date('m'),date('Y'),true);
    $saldo_awal = $detail[0];
    $debet = $detail[1];
    $kredit = $detail[2];
    $saldo = $this->trmodel->get_saldo_akhir($saldo_awal,$debet,$kredit,1);
    ?>
    <tr>
        <td><?php echo $row->nama;?></td>
        <td align='right'><?php echo $this->fungsi->pecah($saldo_awal,'.',true);?></td>
        <td align='right'><?php echo $this->fungsi->pecah($debet);?></td>
        <td align='right'><?php echo $this->fungsi->pecah($kredit);?></td>
        <td align='right'><?php echo $this->fungsi->pecah($saldo,'.',true);?></td>
    </tr>
    <?php
}
echo '</table>';
echo '<div class="title">Laba/Rugi</div>';
?>
<table class='grid'>
<tr>
    <th>Uraian</th>
    <th align='right'>Pemasukan</th>
    <th align='right'>Pengeluaran</th>
    <th align='right'>Saldo</th>
    <th align='right'>Keterangan</th>
</tr>
<?php
$surdef_bulan = $this->trmodel->get_surdef(date('Y-m').'-01',date('Y-m-d'));
foreach($surdef_bulan->result() as $row)
{
    $pemasukan = $row->pemasukan;
    $pengeluaran = $row->pengeluaran;
    $saldo = $pemasukan-$pengeluaran;
    $ket = '<font color="green">laba</font>';
    if($saldo < 0) $ket = '<font color="red">rugi</font>';
    ?>
    <tr>
        <td>Laba Rugi Bulan ini</td>
        <td align='right'><?php echo $this->fungsi->pecah($pemasukan);?></td>
        <td align='right'><?php echo $this->fungsi->pecah($pengeluaran);?></td>
        <td align='right'><?php echo $this->fungsi->pecah($saldo,'.',true);?></td>
        <td align='right'><?php echo $ket;?></td>
    </tr>
    <?php
}
$surdef_tahun = $this->trmodel->get_surdef(date('Y').'-01-01',date('Y-m-d'));
foreach($surdef_tahun->result() as $row)
{
    $pemasukan = $row->pemasukan;
    $pengeluaran = $row->pengeluaran;
    $saldo = $pemasukan-$pengeluaran;
    $ket = '<font color="green">laba</font>';
    if($saldo < 0) $ket = '<font color="red">rugi</red>';
    ?>
    <tr>
        <td>Laba Rugi Tahun ini</td>
        <td align='right'><?php echo $this->fungsi->pecah($pemasukan);?></td>
        <td align='right'><?php echo $this->fungsi->pecah($pengeluaran);?></td>
        <td align='right'><?php echo $this->fungsi->pecah($saldo,'.',true);?></td>
        <td align='right'><?php echo $ket;?></td>
    </tr>
    <?php
}
$surdef_all = $this->trmodel->get_surdef('2011-01-01',date('Y-m-d'));
foreach($surdef_all->result() as $row)
{
    $pemasukan = $row->pemasukan;
    $pengeluaran = $row->pengeluaran;
    $saldo = $pemasukan-$pengeluaran;
    $ket = '<font color="green">laba</font>';
    if($saldo < 0) $ket = '<font color="red">rugi</red>';
    ?>
    <tr>
        <td>Laba Rugi Total</td>
        <td align='right'><?php echo $this->fungsi->pecah($pemasukan);?></td>
        <td align='right'><?php echo $this->fungsi->pecah($pengeluaran);?></td>
        <td align='right'><?php echo $this->fungsi->pecah($saldo,'.',true);?></td>
        <td align='right'><?php echo $ket;?></td>
    </tr>
    <?php
}
echo '</table>';
echo '<div class="title">Daftar Piutang Yang Belum Lunas</div>';
?>
<table class='grid'>
<tr>
    <th>Uraian</th>
    <th align='right'>Tanggal</th>
    <th align='right'>Nominal Piutang</th>
    <th align='right'>Telah Dibayarkan</th>
    <th align='right'>Sisa Piutang</th>
</tr>
<?php
$piutang = $this->trmodel->get_list_piutang();
$jumlah = 0;
foreach($piutang->result() as $row)
{
    $nominal = $row->nominal;
    $telahbayar = $row->telahbayar;
    $kurang = $nominal-$telahbayar;
    ?>
    <tr>
        <td><?php echo $row->keterangan;?></td>
        <td align='right'><?php echo $this->fungsi->tanggal3($row->tanggal_transaksi);?></td>
        <td align='right'><?php echo $this->fungsi->pecah($nominal);?></td>
        <td align='right'><?php echo $this->fungsi->pecah($telahbayar);?></td>
        <td align='right'><?php echo $this->fungsi->pecah($kurang,'.',true);?></td>
    </tr>
    <?php
    $jumlah += $kurang;
}
?>
<tr class='jumlah'>
    <td align='center' colspan='4'>JUMLAH</td>
    <td align='right'><?php echo $this->fungsi->pecah($jumlah,'.',true);?></td>
</tr>
</table>