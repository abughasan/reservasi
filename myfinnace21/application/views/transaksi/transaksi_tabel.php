<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<table class='grid'>
    <tr>
        <th width='10%'>Nomor</th>
        <th width='50%'>Keterangan</th>
        <th>Nominal</th>
        <th>Tanggal</th>
        <th width='5%'>Aksi</th>
    </tr>
    <?php foreach($list_transaksi->result() as $row):
        $nom = $row->debet;
        if($nom==0) $nom = $row->kredit;
    ?>
        <tr>
            <td>
                <input type='hidden' class='nomor_<?php echo $row->id;?>' value='<?php echo $row->nomor;?>' />
                <input type='hidden' class='tanggal_<?php echo $row->id;?>' value='<?php echo $row->tanggal_transaksi;?>' />
                <input type='hidden' class='keterangan_<?php echo $row->id;?>' value='<?php echo $row->keterangan;?>' />
                <input type='hidden' class='nominal_<?php echo $row->id;?>' value='<?php echo $this->fungsi->pecah($nom,',');?>' />
                <input type='hidden' class='id_piutang_<?php echo $row->id;?>' value='<?php echo $row->id_piutang;?>' />
                <?php echo $this->fungsi->complete($row->nomor,5);?>
            </td>
            <td><?php echo $row->keterangan;?></td>
            <td><?php echo $this->fungsi->pecah($nom);?></td>
            <td><?php echo $this->fungsi->date_to_tanggal($row->tanggal_transaksi);?></td>
            <td><a class='link1 blue98' href='javascript:void(0)' onclick='edit(<?php echo $row->id;?>)' >Edit</a></td>
        </tr>    
    <?php endforeach;
    if($list_transaksi->num_rows()==0)
    {
        ?>
        <tr>
            <td colspan='5' align='center'><span class='dark77'>Data tidak tersedia</span></td>
        </tr>
        <?php
    }    
    ?>
</table>
<div class='a_center'>
    <?php
    $str = '';
    $br = '';
    if(!isset($no_prev))
    {
        $br = '<br />';
        $str .= $prev;
    }
    if(!isset($no_next))
    {
        $br = '<br />';
        if(!isset($no_prev))
        {
            $str .= ' - ';
        }
        $str .= $next;
    }
    echo $br.$str;
    ?>
</div>