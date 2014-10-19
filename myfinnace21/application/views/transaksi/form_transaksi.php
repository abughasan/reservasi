<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<script type='text/javascript'>
    $(function(){
        $('.date').calendar();
        var transaksi = $('select[name=transaksi]').val();
        var txt_transaksi = $('select[name=transaksi] :selected').text();
        $('input[name=transaksi]').val(transaksi);
        $('.jenis').html(txt_transaksi);
        $('input[name=keterangan]').focus();
    });    
    function view_transaksi()
    {
        var transaksi = $('select[name=transaksi]').val();
        var bulan = $('select[name=bulan]').val();
        var tahun = $('select[name=tahun]').val();
        load_no_loading('transaksi/index/'+transaksi+'_'+bulan+'_'+tahun,'#content');
        $('input[name=transaksi]').val(transaksi);
        var txt_transaksi = $('select[name=transaksi] :selected').text();
        $('.jenis').html(txt_transaksi);
    }
    function simpan_transaksi()
    {
        var tanggal = $('input[name=tanggal_transaksi]').val();
        if(tanggal=='')
        {
            alert('Isilah form dengan lengkap');
        }
        else
        {
            send_form(document.form_transaksi,'transaksi/simpan','#content');
        }
    }
    function edit(id)
    {
        $('input[name=tanggal_transaksi]').val($('.tanggal_'+id).val());
        $('input[name=keterangan]').val($('.keterangan_'+id).val());
        $('input[name=nominal]').val($('.nominal_'+id).val());
        $('input[name=nomor]').val($('.nomor_'+id).val());
        if(typeof($('select[name=id_piutang]').val()) != 'undefined')
        {
            $('select[name=id_piutang]').val($('.id_piutang_'+id).val());
        }
    }
    function reset_form()
    {
        $('input[name=tanggal_transaksi]').val('');
        $('input[name=keterangan]').val('');
        $('input[name=nominal]').val('');
        $('input[name=nomor]').val('');
    }
</script>

<div class='title'>Lihat Transaksi</div>

<?php
    echo $this->fungsi->build_select_common('transaksi',$transaksi,'id','nama','onchange="view_transaksi()"',$cur_transaksi);
    echo '&nbsp;&nbsp;';
    echo $this->fungsi->build_select_month('bulan','onchange="view_transaksi()"',$cur_bulan);
    echo '&nbsp;&nbsp;';
    echo $this->fungsi->build_select_year('tahun','onchange="view_transaksi()"',$cur_tahun);
?>

<br /><br />

<div class='tabel_transaksi'>
<?php echo $this->load->view('transaksi/transaksi_tabel');?>
</div>

<br />

<?php
$p = false;
if(in_array($cur_transaksi,array(9,16)))
{
    $piutang = $this->trmodel->get_list_piutang2();
    $p = true;
}
?>
<div class='title'>Input Transaksi</div>
<div class='the_content'>
    <form method='post' action='' name='form_transaksi'>
    <?php
        echo form_hidden('nomor');
        echo form_hidden('transaksi');
        echo form_hidden('user',from_session('user_id'));
        echo form_hidden('tanggal_catat',time());
    ?>
    <table class='myform' style='width:100%'>
        <tr>
            <td class='a_right' valign='top'>Transaksi</td>
            <td valign='top'>:</td>
            <td class='a_left' valign='top'><span class='jenis'></span></td>
        </tr>
        <tr>
            <td class='a_right' valign='top'>Tanggal</td>
            <td valign='top'>:</td>
            <td class='a_left' valign='top'><input type='text' value='<?php echo date('Y-m-d');?>' class='date' name='tanggal_transaksi' autocomplete='off' style='width:100px' /></td>
        </tr>
        <tr>
            <td class='a_right' valign='top'>Keterangan</td>
            <td valign='top'>:</td>
            <td class='a_left' valign='top'><input type='text' name='keterangan' style='width:600px' /></td>
        </tr>
        <tr>
            <td class='a_right' valign='top'>Nominal</td>
            <td valign='top'>:</td>
            <td class='a_left' valign='top'><input type='text' name='nominal' style='width:120px'  onkeyup="formatNumber(this);" onchange="formatNumber(this);"/></td>
        </tr>
        <?php
        if($p):
        ?>
        <tr>
            <td class='a_right' valign='top'>Piutang</td>
            <td valign='top'>:</td>
            <td class='a_left' valign='top'><?php echo $this->fungsi->build_select_common('id_piutang',$piutang,'nomor','keterangan','- pilih -');?></td>
        </tr>
        <?php endif;?>
    </table>
    </form>
    <div class='the_footer a_left'>
        <a class='button buttonblue smallbtn' href='javascript:void(0)' onclick='simpan_transaksi()'>Simpan</a>
        <a class='button buttonwhite smallbtn' href='javascript:void(0)' onclick='reset_form()'>Kosongkan Form</a>
    </div>
</div>