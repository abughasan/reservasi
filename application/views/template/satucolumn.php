<div class="container">
	<!-- starting template two column kiri 4 kanan 8 
		available for 
			desktop medium width >= 992px
			desktop / tablet small width >= 768px
	-->
		<div class="row canvas">
			
			<div class="col-md-12 col-sm-12 co-xs-12">
				<?php if (! empty($interface)): ?>
				<?php foreach($interface as $isi): ?>
					<?php $this->load->view("interface/konten_".$isi); ?>
				<?php endforeach; ?>
				<?php endif; ?>
			</div>
			
		</div>
</div>