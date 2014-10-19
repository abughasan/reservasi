<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<script type='text/javascript'>
    $(function(){
        
    });
    function simpan_setup()
    {
        send_form_loading(document.fsetup,'transaksi/simpan_setup','#content');
    }
    function simpan_buku()
    {
        send_form_loading(document.fbuku,'transaksi/simpan_buku','#content');
    }
    function hapus_setup(id)
    {
        load_no_loading('transaksi/hapus_setup/'+id,'#content');
    }
    function hapus_buku(id)
    {
        load_no_loading('transaksi/hapus_buku/'+id,'#content');
    }
</script>

<div class='title'>Master Transaksi
<div class='f_right'>
    <a class='button buttonblue smallbtn' href='javascript:void(0)' onclick='simpan_setup()'>Simpan Pengaturan</a>
    </div>
</div>

<form name='fsetup' action='' method='post'>
<table class='grid tsetup'>
    <thead>
    <tr>
        <th width='25%'>Nama</th>
        <th width='5px' align='center'></th>
        <th>Pengaturan</th>
        <th width='120px'>Jenis Transaksi</th>
        <th width='50px' align='center'>Aksi</th>
    </tr>
    </thead>
    <?php
    $str_hk = '';
    $str_hd = '';
    foreach($buku->result() as $r)
    {
        $str_hd .= '<input type="checkbox" name="buku_debet_new[99][]" value="'.$r->id.'" /> '.$r->nama;
        $str_hk .= '<input type="checkbox" name="buku_kredit_new[99][]" value="'.$r->id.'" /> '.$r->nama;
    }
    ?>
    
    <tr class='bbottom'>
        <td valign='middle' rowspan='2'><input type='text' style='width:97%' name='nama_new[99]' /></td>
        <td valign='top' align='center'>D</td>
        <td valign='top'><?php echo $str_hd;?></td>
        <td valign='middle' rowspan='2'>
            <select name='jenis[99]'>
                <option value=''>- pilih -</option>
                <option value='1'>Penerimaan Kas</option>
                <option value='2'>Pengeluaran Kas</option>
            </select>                
        </td>
        <td valign='middle' rowspan='2'></td>
    </tr>
    <tr class='bbottom'>
        <td valign='top' align='center'>K</td>
        <td valign='top'><?php echo $str_hk;?></td>
    </tr>
    
    <?php
    $i = 0;
    foreach($setup->result() as $row):
        $i++;
        $buku_d = explode('+',$row->buku_debet);
        $buku_k = explode('+',$row->buku_kredit);
        $buku_d = remove_empty_values($buku_d);
        $buku_k = remove_empty_values($buku_k);
        $str_d = '';
        $str_k = '';
        foreach($buku->result() as $r)
        {
            $checked = '';
            if(in_array($r->id,$buku_d))
            {
                $checked = 'checked="checked"';
            }
            $str_d .= '<input type="checkbox" '.$checked.' name="buku_debet['.$row->id.'][]" value="'.$r->id.'" /> '.$r->nama;
        }
        foreach($buku->result() as $r)
        {
            $checked = '';
            if(in_array($r->id,$buku_k))
            {
                $checked = 'checked="checked"';
            }
            $str_k .= '<input type="checkbox" '.$checked.' name="buku_kredit['.$row->id.'][]" value="'.$r->id.'" /> '.$r->nama;
        }
    ?>    
    <tr class=''>
        <td valign='middle' rowspan='2'><input type='text' style='width:97%' name='nama[<?php echo $row->id;?>]' value='<?php echo $row->nama;?>' /></td>
        <td valign='top' align='center'>D</td>
        <td valign='top'><?php echo $str_d?></td>
        <td valign='middle' align='center' rowspan='2'>
            <?php
            $j1 = '';
            $j2 = '';
            if($row->jenis == 1)
            {
                $j1 = 'selected="selected"';
            }
            elseif($row->jenis == 2)
            {
                $j2 = 'selected="selected"';
            }
            ?>
            <select name='jenis[<?php echo $row->id;?>]'>
                <option value=''>- pilih -</option>
                <option <?php echo $j1;?> value='1'>Penerimaan Kas</option>
                <option <?php echo $j2;?> value='2'>Pengeluaran Kas</option>
            </select> 
        </td>
        <td valign='middle' align='center' rowspan='2'><a class='link1 blue98' href='javascript:void(0)' onclick='hapus_setup(<?php echo $row->id;?>)' >Hapus</a></td>
    </tr>
    <tr class='bbottom'>
        <td valign='top' align='center'>K</td>
        <td valign='top'><?php echo $str_k?></td>
    </tr>
    <?php endforeach;?>
</table>
</form>

<br />

<div class='title'>Master Buku
    <div class='f_right'>
    <a class='button buttonblue smallbtn' href='javascript:void(0)' onclick='simpan_buku()'>Simpan Buku</a>
    </div>
    <div class='clear'></div>
</div>

<form name='fbuku' action='' method='post'>
<table class='grid' style='width:50%;margin:0 auto;'>
    <tr>
        <th>Nama</th>
        <th width='15%'>Aksi</th>
    </tr>
    <tr>
        <td valign='top'><input type='text' style='width:97%' name='nama_new' /></td>
        <td valign='top'></td>
    </tr>
    <?php foreach($buku->result() as $row):?>
    <tr id='row_<?php echo $row->id;?>'>
        <td valign='top'><input type='text' style='width:97%' name='nama[<?php echo $row->id;?>]' value='<?php echo $row->nama;?>' /></td>
        <td valign='top'><a class='link1 blue98' href='javascript:void(0)' onclick='hapus_setup(<?php echo $row->id;?>)' >Hapus</a></td>
    </tr>
    <?php endforeach;?>
</table>
</form>