<div class="list-group">
<?php if($this->session->userdata('level')==1) { ?>
 <a href="<?=base_url()?>pengajuan/viewacc" class="list-group-item <?php ((isset($pengajuan)) ? print 'active' : '') ?>">
   List Pengajuan
  </a>
  <a href="<?=base_url()?>pengajuan/view" class="list-group-item <?php ((isset($pengajuan_view)) ? print 'active' : '') ?>">
  List Pengajuanhhhh1
  </a>
<?php }else if($this->session->userdata('level')==2){ ?>

 <a href="<?=base_url()?>pengajuan" class="list-group-item <?php ((isset($pengajuan)) ? print 'active' : '') ?>">
    Input Pengajuanhhhh 2
  </a>
  <a href="<?=base_url()?>pengajuan/view" class="list-group-item <?php ((isset($pengajuan_view)) ? print 'active' : '') ?>">
  List Pengajuanhhhh 2
  </a>  
<?php }
else
{
?>
 <a href="<?=base_url()?>pengajuan" class="list-group-item <?php ((isset($pengajuan)) ? print 'active' : '') ?>">
    Input Pengajuan 3
  </a>
  <a href="<?=base_url()?>pengajuan/view" class="list-group-item <?php ((isset($pengajuan_view)) ? print 'active' : '') ?>">
  List Pengajuan 3
  </a>
<?php }?>
</div>
