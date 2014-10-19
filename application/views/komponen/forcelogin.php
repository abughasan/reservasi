<?php
	$session = $this->session->all_userdata();
	if ( isset ( $session['username'] ) ):	
	else:
		redirect('app/login');
	endif;
?>