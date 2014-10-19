<div class="container" id="container-primary">
	<!-- starting template one column 10 Grid with 1 left and 1 right 
		available for 
			desktop medium width >= 992px
			desktop / tablet small width >= 768px
	-->
		<div class="row">
			<div class="col-md-1 col-sm-1">
			</div>
			<div class="col-md-10 col-sm-10">
				<?php ((isset($content1)) ? $this->load->view("content_".$content1) : ""); ?>
				<?php ((isset($content2)) ? $this->load->view("content_".$content2) : ""); ?>
				<?php ((isset($content3)) ? $this->load->view("content_".$content3) : ""); ?>
				<?php ((isset($content4)) ? $this->load->view("content_".$content4) : ""); ?>
				<?php ((isset($content5)) ? $this->load->view("content_".$content5) : ""); ?>
			</div>
			<div class="col-md-1 col-sm-1">
			</div>
		</div>
</div>
				<?php ((isset($jquery1)) ? $this->load->view("js_inject/".$jquery1) : ""); ?>