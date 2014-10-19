<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo $this->config->item('site_name');?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <script type="text/javascript" src="<?php echo base_url();?>asset/javascript/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>asset/plugin/calendar/jquery.calendar.js" ></script>
    <script type='text/javascript'>
        var site = "<?php echo site_url()?>";
        var loading_image_large = "<?php echo base_url();?>asset/images/loading_large.gif";
        var loading_image_small = "<?php echo base_url();?>asset/images/loading.gif";
	$(function(){
	    load("home/front","#content");
	})
    </script>
    <script type="text/javascript" src="<?php echo base_url();?>asset/javascript/app.js" ></script>
    <script type="text/javascript" src="<?php echo base_url();?>asset/plugin/chart/jquery.jqplot.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>asset/plugin/chart/jqplot.barRenderer.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>asset/plugin/chart/jqplot.categoryAxisRenderer.min.js"></script>
    
    <link href="<?php echo base_url();?>asset/plugin/chart/jquery.jqplot.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo site_url('style');?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>asset/plugin/calendar/jquery.calendar.css" rel="stylesheet"  type="text/css" />
    <link rel="shorcut icon" href="<?php echo base_url()?>asset/images/favicon.ico" />
    
</head>
<body>
    <div id='container'>
        <div id='header'>
            <div class='logo'></div>
            <div class='tabs'>
                <div class='current_tab' onclick='load("home/front","#content");switch_tab(this);'><?php echo img('asset/images/icon/home.png');?><br />Beranda</div>
                <?php
                if(is_logged_in())
                {
                    ?>
                    <div class='tab' onclick='load("transaksi","#content");switch_tab(this);'><?php echo img('asset/images/icon/transaksi.png');?><br />Transaksi</div>
                    <div class='tab' onclick='load("transaksi/buku_besar","#content");switch_tab(this);'><?php echo img('asset/images/icon/book.png');?><br />Buku Besar</div>
                    <?php if($this->auth->cek('data_master',true)):?>
                        <div class='tab' onclick='load("transaksi/setup","#content");switch_tab(this);'><?php echo img('asset/images/icon/master.png');?><br />Data Master</div>
                    <?php endif;?>
                    <?php if($this->auth->cek('manajemen_user',true)):?>
                        <div class='tab' onclick='load("user","#content");switch_tab(this);'><?php echo img('asset/images/icon/user.png');?><br />Manage User</div>
                    <?php endif;?>    
                    <?php
                }
                ?>
                <div class='tab' onclick='load("home/about","#content");switch_tab(this);'><?php echo img('asset/images/icon/info.png');?><br />Informasi</div>
                <?php
                if(is_logged_in())
                {
                    ?>
                    <div class='tab' onclick="<?php echo form_prep('window.location="'.site_url('home/logout').'"');?>"><?php echo img('asset/images/icon/logout.png');?><br />Logout</div>
                    <?php
                }
                ?>
            </div>
	    <div class='clear'></div>
        </div>
        <div id='content'>
            
        </div>
	<!-- JIKA ANDA INGIN MENGHARGAI KARYA SAYA, TULISAN DI FOOTER TOLONG JANGAN DIHAPUS/DI-HIDDEN -->
        <div id='footer'>
            <div class='left_footer'>MyFinance version <?php echo $this->config->item('version');?> &copy; <?php echo date('Y');?> by <a class='whitelink' href='http://anggytrisnawan.com'>Anggy Trisnawan</a></div>
            <div class='right_footer'>Script powered by <a class='link1 blue98' href='http://codeigniter.com' target='_blank'>Codeigniter</a> and <a class='link1 blue98' href='http://jquery.com' target='_blank'>jQuery</a></div>
        </div>
    </div>

</body>
</html>    