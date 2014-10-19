<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<!DOCTYPE html> 
<html> 
    <head> 
        <title>MyFinance Mobile</title> 
        <meta name="viewport" content="width=device-width,initial-scale=1"> 
        <link rel="stylesheet" href="<?php echo base_url('asset/mobile/lib/jquery.mobile-1.0.min.css');?>" />
        <link rel="stylesheet" href="<?php echo base_url('asset/mobile/mobile.css');?>" />
        <script type="text/javascript" src="<?php echo base_url('asset/mobile/lib/jquery.js');?>"></script>
        <script type="text/javascript" src="<?php echo base_url('asset/mobile/mobile.js');?>"></script>
        <script type="text/javascript" src="<?php echo base_url('asset/mobile/lib/jquery.mobile-1.0.min.js');?>"></script>
    </head>
    <script type='text/javascript'>
        var site = "<?php echo site_url();?>";
    </script>
<body> 

<!-- main page -->
<div data-role="page" id="home">

	<div data-role="header" data-theme="a">
                <a href='<?php echo site_url('mobile');?>' rel="external" data-theme="b" data-icon="home" data-iconpos="notext">Home</a>
                <?php if(is_logged_in()):?> <a href='<?php echo site_url('mobile/logout');?>' rel="external"  data-icon="delete" data-iconpos="notext">Logout</a><?php endif;?>
		<h1>MyFinance Mobile</h1>
	</div><!-- /header -->

	<div data-role="content">	

            <?php echo $content;?>

	</div><!-- /content -->
        
        <div data-role="footer">
            <h4>Copyright &copy; anggytrisnawan.com</h4>    
        </div>
        
</div><!-- /page -->

</body>
</html>