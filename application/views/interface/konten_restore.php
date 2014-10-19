	<div class="panel-group" id="accordion">
	  <div class="panel panel-default">
		<div class="panel-heading">
		  <h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
			  <?=showicon('saved') ?> RESTORE DATA
			</a>
		  </h4>
		</div>
		<div id="collapseOne" class="panel-collapse collapse in">
		  <div class="panel-body">
				<!-- START DATA INPUT -->
						
						<div id="body">
							<div class="cleaner_h10"></div>
							<p style="background-color:#FF3366; padding:5px; margin:0px; color:#FFFFFF;">Peringatan, melakukan restore database akan menghapus data yang 
							ada di server pusat...!!!</p>
							<div class="cleaner_h10"></div>
							
							<?php echo form_open_multipart('restore/upload'); ?>
								<input type="file" name="userfile" class="input-read-only" />
								<div class="cleaner_h10"></div>
								<input type="submit" value="Restore Data" class="btn-kirim-login" />
							<?php echo form_close(); ?>
							
						</div>
		
		
				<!-- END OFF DATA INPUT -->
	
		  </div>
		</div>
	  </div>		
	</div>  
	
  
	
