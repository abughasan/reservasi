<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<script type='text/javascript'>
    function simpan_user()
    {
        send_form(document.fuser,"user/simpan","#content");
    }
    function edit(id)
    {
        $('input[name=user_name]').val($('#name_'+id).val());
        $('input[name=user_username]').val($('#username_'+id).val());
        $('select[name=user_level]').val($('#level_'+id).val());
        $('input[name=user_id]').val(id);
        $('input[name=user_password]').attr("disabled","disabled");
    }
</script>

<div class='title'>Daftar User</div>
<table class='grid'>
    <tr>
        <th>Nama</th>
        <th>Username</th>
        <th>Level</th>
        <th width='100px'>Login Count</th>
        <th width='100px'>Aksi</th>
    </tr>
    <?php foreach($user->result() as $row):?>
    <tr>
        <td>
            <input type='hidden' id='name_<?php echo $row->user_id;?>' value='<?php echo $row->user_name;?>' />
            <input type='hidden' id='username_<?php echo $row->user_id;?>' value='<?php echo $row->user_username;?>' />
            <input type='hidden' id='level_<?php echo $row->user_id;?>' value='<?php echo $row->user_level;?>' />
            <?php echo $row->user_name;?>
        </td>
        <td><?php echo $row->user_username;?></td>
        <td><?php echo $row->user_level;?></td>
        <td><?php echo $row->user_logincount;?></td>
        <td>
            <a class='link1 blue98' href='javascript:void(0)' onclick='edit(<?php echo $row->user_id;?>)' >Edit</a>
             - 
            <a class='link1 blue98' href='javascript:void(0)' onclick='load_no_loading("user/hapus/<?php echo $row->user_id;?>","#content")' >Hapus</a>
        </td>
    </tr>
    <?php endforeach;?>
</table>

<br />

<div class='title'>Tambah User</div>
<form name='fuser' method='post' action=''>
    <?php
        echo form_hidden('user_id');        
    ?>
<table width='80%'>
    <tr>
        <td class='a_right'>Nama</td>
        <td class='a_center'>:</td>
        <td><input type='text' name='user_name' style='width:60%' /></td>
    </tr>
    <tr>
        <td class='a_right'>Username</td>
        <td class='a_center'>:</td>
        <td><input type='text' name='user_username' style='width:30%' /></td>
    </tr>
    <tr>
        <td class='a_right'>Password</td>
        <td class='a_center'>:</td>
        <td><input type='password' name='user_password' style='width:40%' /></td>
    </tr>
    <tr>
        <td class='a_right'>Level</td>
        <td class='a_center'>:</td>
        <td>
            <select name='user_level'>
                <option value='admin'>Admin</option>
                <option value='operator'>Operator</option>
            </select>
        </td>
    </tr>
</table>
</form>
<div class='the_footer a_left'>
    <a class='button buttonblue smallbtn' href='javascript:void(0)' onclick='simpan_user()'>Simpan</a>
    <a class='button buttonwhite smallbtn' href='javascript:void(0)' onclick='document.fuser.reset()'>Kosongkan Form</a>
</div>