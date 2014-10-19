<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Style extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}	
	function index()
	{		
		header("Content-Type: text/css");
		$colors = $this->config->item('color_scheme');
		$background = $this->config->item('background');
		?>
		@font-face {
			font-family: "neue_sans_bold";
			src: url("<?php echo base_url('asset/font/NeueSans-Bold.otf');?>");
		}
		body
		{
		    font-family: "lucida grande", Tahoma, verdana, arial, sans-serif;
		    font-size:11px;
		    color: #333333;
		    margin:0 auto;
		    padding:0;
		    outline:none;
		    line-height:16px;
		    background:<?php echo $colors[0];?> url('<?php echo base_url('asset/images/'.$background);?>');
		}
		a{
		    outline:none;
		}
		#container
		{
		    margin:0 auto;
		    width:1000px;
		}
		#header
		{
		    
		}
		.logo
		{
		    height:70px;
		    background:url('<?php echo base_url('asset/images/logo.png');?>') no-repeat;
		}
		#content
		{
			min-height:400px;
			padding:10px;
			background:#FFF;
			-moz-border-radius-bottomleft:10px;
			-webkit-border-bottom-left-radius:10px;
			border-bottom-left-radius:10px;
			-moz-border-radius-bottomright:10px;
			-webkit-border-bottom-right-radius:10px;
			border-bottom-right-radius:10px;
			-webkit-box-shadow:1px -1px 2px rgba(0,0,0,0.4);
			-moz-box-shadow:1px -1px 2px rgba(0,0,0,0.4);
			box-shadow:1px 1px 2px rgba(0,0,0,0.4);
		}
		#form_login
		{
		    width:300px;
		    margin:60px auto;
		}
		.title
		{
		    font-size:16px;
		    padding-bottom:10px;
		    border-bottom:1px solid #E9E9E9;
		    margin-bottom:10px;
		    margin-top:20px;
		    vertical-align:middle;
		    font-family: "neue_sans_bold",Trebuchet,"Trebuchet MS",Helvetica,sans-serif;
		}
		.the_content
		{
		    
		}
		.the_footer
		{
		    margin-top:10px;
		    padding-top:5px;
		    border-top:1px solid #E9E9E9;
		}
		#footer
		{
		    clear:both;
		    width:995px;
		    margin:3px auto 20px;
		    text-align:left;
		    padding:5px 0px 10px;
		    color:#FFFFFF;
		}
		.left_footer
		{
		    float:left;
		}
		.right_footer
		{
		    float:right;
		}
		
		
		/****************** TABS ************************/
		
		.tabs
		{
			height:70px;
			background-color:#fff;
			-moz-border-radius-topleft:10px;
			-webkit-border-top-left-radius:10px;
			border-top-left-radius:10px;
			-moz-border-radius-topright:10px;
			-webkit-border-top-right-radius:10px;
			border-top-right-radius:10px;
			-webkit-box-shadow:1px -1px 2px rgba(0,0,0,0.4);
			-moz-box-shadow:1px -1px 2px rgba(0,0,0,0.4);
			box-shadow:1px -1px 2px rgba(0,0,0,0.4);
			padding:5px;
		}
		.tabs div{
			float:left;
			padding:5px;
			text-align:center;
			border:1px solid #E1E1E1;
			color: <?php echo $colors[1];?>;
			font-weight: bold;
			font-size:13px;
			text-decoration: none;
			white-space:nowrap;
			margin:5px;
			-moz-border-radius:7px;
			-webkit-border-radius:7px;
			border-radius:7px;
			width:100px;
		}
		.tab  
		{
		    
		}
		.tab:hover  
		{  
		    background-color: #eee;  
		    cursor:pointer;
		    text-decoration: none; 
		}
		.current_tab{
		    background-color: #eee;
		}
		
		/* TABLE */
		.grid tr th
		{
		    background-color:<?php echo $colors[2];?>;
		}
		.grid tr:nth-child(2n+1)
		{
		    background-color:<?php echo $colors[3];?>;
		}
		.grid
		{			
		    background: #fff;
		    margin: 0px;
		    width: 100%;
		    border-collapse: collapse;
		    text-align: left;
		    table-layout:fixed;
		    border-bottom: 1px solid <?php echo $colors[1];?>;
		}
		.grid th
		{
		    font-weight: normal;			
		    padding: 5px 7px;
		    border-bottom: 2px solid <?php echo $colors[1];?>;
		}
		.grid td
		{
		    padding: 3px 7px;
		}
		.grid tr.bbottom
		{
		    border-bottom: 1px solid <?php echo $colors[1];?>;
		}
		.grid tr.jumlah
		{
		    background-color:<?php echo $colors[3];?>;
		    border-top: 1px solid <?php echo $colors[1];?>;
		    font-weight:bold;
		}
		.myform td
		{
		    line-height:20px;
		}
		.ctable
		{
		    background: #fff;
		    margin: 0px;
		    width: 100%;
		    border-collapse: collapse;
		    text-align: left;
		    table-layout:fixed;
		}
		
		
		/* BUTTON */
		.button, .button:visited
		{
			font-family: Arial, Helvetica, Helvetica Neue, Verdana, sans-serif;
			background: #222 url(<?php echo base_url('asset/images/alert-overlay.png');?>) repeat-x; 
			display: inline-block; 
			padding: 5px 10px 6px; 
			color: #fff; 
			text-decoration: none;
			-moz-border-radius: 5px; 
			-webkit-border-radius: 5px;
			-moz-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
			-webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
			text-shadow: 0 -1px 1px rgba(0,0,0,0.25);
			border-bottom: 1px solid rgba(0,0,0,0.25);
			position: relative;
			cursor: pointer;
		}
		.button:hover				{ background-color: #111; color: #fff; }
		.button:active				{ top: 1px; }
		.button, .button:visited,
		.smallbtn.button, .smallbtn.button:visited
		{
			font-size: 13px; font-weight: bold; line-height: 1; text-shadow: 0 -1px 1px rgba(0,0,0,0.25);
		}
		.buttonblue.button, .buttonblue.button:visited	{ background-color: <?php echo $colors[1];?>; }
		.buttonblue.button:hover			{ background-color: <?php echo $colors[2];?>; }
		.buttonwhite.button, .buttonwhite.button:visited	{ background-color: #606060; }
		.buttonwhite.button:hover			{ background-color: #9E9E9E; }
		
		
		
		input, textarea, select
		{
		    font-family: "lucida grande", Tahoma, verdana, arial, sans-serif;
		    border:1px solid #BDC7D8;
		    font-size:11px;
		    padding:3px;
		}
		textarea
		{
		    white-space:nowrap;
		}
		input[type=checkbox]
		{
		    vertical-align:middle;
		}
		.date
		{
		    background:#fff url('../images/calendar.gif') no-repeat 87px 2px;
		    width:100px;
		}
		.date:hover
		{
		    cursor:pointer;
		}
		
		.a_left
		{
		    text-align:left;
		}
		.a_right
		{
		    text-align:right;
		}
		.a_center
		{
		    text-align:center;
		}
		.f_right
		{
		    float:right;
		}
		.ajax_loading
		{
		    text-align:center;
		    margin-top:150px;
		}
		.ajax_loading_small
		{
		    margin-left:10px;
		}
		/* SPECIAL */
		.small
		{
			font-size:10px;
		}
		.medium
		{
			font-size:11px;
		}
		.semibig
		{
			font-size:13px;
		}
		.bold
		{
			font-weight:bold;
		}
		.dark99
		{
			color:#999999;
		}
		.dark33
		{
			color:#333333;
		}
		.dark77
		{
			color:#777777;
		}
		.darkE9
		{
			color:#E9E9E9;
		}
		.blue98
		{
			color:#3B5998;
		}
		.link1
		{
			text-decoration:none;
		}
		.link1:hover
		{
			text-decoration:underline;
		}
		.clear
		{
			clear:both;
		}
		.whitelink{
			color:#fff;
			text-decoration:none;
		}
		.whitelink:hover{
			text-decoration:underline;
		}
		
		<?php
	}
}

/* End of file style.php */
/* Location: ./application/controllers/style.php */