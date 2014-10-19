<div class="container">
	<!-- starting template two column kiri 4 kanan 8 
		available for 
			desktop medium width >= 992px
			desktop / tablet small width >= 768px
	-->
		<div class="row bg-info canvas">
			
			<div class="col-md-2 col-sm-2">
				<?php if (! empty($menu)): ?>
				<?php foreach($menu as $isi): ?>
					<?php $this->load->view("interface/menu_".$isi); ?>
				<?php endforeach; ?>
				<?php endif; ?>
			</div>
			
			<div class="col-md-10 col-sm-10">
				<?php if (! empty($interface)): ?>
				<?php foreach($interface as $isi): ?>
					<?php $this->load->view("interface/konten_".$isi); ?>
				<?php endforeach; ?>
				<?php endif; ?>
			</div>
			
		</div>
</div>