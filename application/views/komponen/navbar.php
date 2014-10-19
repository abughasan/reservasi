<?php 
	$status = $this->session->userdata('stts');
	if($status == 'operator')
	{
?>	
	<nav class="navbar navbar-inverse" role="navigation">
	  <div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="<?=base_url()?>">RESERVASI VILLA</a>	  
		</div>		
		
		<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">		
			<ul class="nav navbar-nav">
				
				<li><a href="<?php echo base_url(); ?>pilih_tanggal">Input Reservasi</a></li>
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Data <b class="caret"></b></a>
				  <ul class="dropdown-menu">
					<li><a href="<?php echo base_url(); ?>kalender_m/bulan/<?=date('m')?>/<?=date('Y')?>">Data Kalender Booking</a></li>
					<li><a href="<?php echo base_url(); ?>tamu">Data Tamu</a></li>
					<li><a href="<?php echo base_url(); ?>barang">Data Barang</a></li>
					<li><a href="<?php echo base_url(); ?>pengajuan">Data Barang Rusak</a></li>
					<li class="divider"></li>
					<li><a href="<?php echo base_url(); ?>transaksi">Data Reservasi</a></li>						
				  </ul>				  
				</li>				
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pembayaran <b class="caret"></b></a>
				  <ul class="dropdown-menu">	
					<li><a href="<?php echo base_url(); ?>pembayaran/">Tagihan Villa</a></li>			
					<li><a href="<?php echo base_url(); ?>komisiguide/">Komisi Guide</a></li>			
					<li><a href="<?php echo base_url(); ?>myfinnace21" target="_blank">Delima Finance</a></li>			
				  </ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Laporan <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo base_url(); ?>laporan/pertanggal">Laporan Transaksi pertanggal</a></li>
						<li><a href="<?php echo base_url(); ?>laporan/perbulan">Laporan Transaksi perbulan</a></li>
						<!--<li><a href="<?php echo base_url(); ?>kalender_transaksi">Kalender Transaksi</a></li>-->
						<li><a href="<?php echo base_url(); ?>laporan_barang">Laporan Barang</a></li>
					</ul>
				</li>	
				
			</ul>	
			
			<ul class="nav navbar-nav">        		
			  <a class="btn btn-danger navbar-btn" href="<?=base_url()?>app/logout"><?=showicon('off')?> Logout</a>		
			</ul>	
		</div><!-- /.navbar-collapse -->
		
	  </div><!-- /.container-fluid -->
	</nav>
<?php 
	}
	else
	{
?>	
		<nav class="navbar navbar-inverse" role="navigation">
		  <div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a class="navbar-brand" href="<?=base_url()?>">RESERVASI VILLA</a>	  
			</div>
			
			<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">		
			<ul class="nav navbar-nav">
				<li><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>		
			</ul>
			<ul class="nav navbar-nav">
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Master <b class="caret"></b></a>
				  <ul class="dropdown-menu">
					<li><a href="<?php echo base_url(); ?>villa">Master Villa</a></li>
					<li><a href="<?php echo base_url(); ?>kamar">Master Kamar</a></li>			
					<li><a href="<?php echo base_url(); ?>guide">Master Guide</a></li>							            			
				  </ul>
				</li>
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Data <b class="caret"></b></a>
				  <ul class="dropdown-menu">
					<li><a href="<?php echo base_url(); ?>kalender_m/bulan/<?=date('m')?>/<?=date('Y')?>">Data Kalender Booking</a></li>
					<li><a href="<?php echo base_url(); ?>tamu">Data Tamu</a></li>
					<li><a href="<?php echo base_url(); ?>barang">Data Barang</a></li>
					<li><a href="<?php echo base_url(); ?>pengajuan">Data Barang Rusak</a></li>
					<li class="divider"></li>
					<li><a href="<?php echo base_url(); ?>transaksi">Data Reservasi</a></li>						
				  </ul>
				</li>
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pembayaran <b class="caret"></b></a>
				  <ul class="dropdown-menu">	
					<li><a href="<?php echo base_url(); ?>pembayaran/">Tagihan Villa</a></li>			
					<li><a href="<?php echo base_url(); ?>komisiguide/">Komisi Guide</a></li>			
					<li><a href="<?php echo base_url(); ?>myfinnace21" target="_blank">Delima Finance</a></li>			
				  </ul>
				</li>
			</ul>
			
			<ul class="nav navbar-nav">
				<li><a href="<?php echo base_url(); ?>pilih_tanggal">Input Reservasi</a></li>		
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Laporan <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo base_url(); ?>laporan/pertanggal">Laporan Transaksi pertanggal</a></li>
						<li><a href="<?php echo base_url(); ?>laporan/perbulan">Laporan Transaksi perbulan</a></li>
						<!--<li><a href="<?php echo base_url(); ?>kalender_transaksi">Kalender Transaksi</a></li>-->
						<li><a href="<?php echo base_url(); ?>laporan_barang">Laporan Barang</a></li>
					</ul>
				</li>	
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Keuangan <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo base_url(); ?>fin_pemasukan_perperiod/berjalan">Laporan Keuangan Berjalan</a></li>
						<li class="divider"></li>
						<li><a href="#"><b>Keuangan Perbulan</b></a></li>
						<li class="divider"></li>
						<li><a href="<?php echo base_url(); ?>fin_kas/index/<?=date('m')?>/<?=date('Y')?>">Laporan Kas</a></li>
						<li><a href="<?php echo base_url(); ?>fin_pemasukan/index/<?=date('m')?>/<?=date('Y')?>">Laporan Pemasukan</a></li>
						<li><a href="<?php echo base_url(); ?>fin_pengeluaran/index/<?=date('m')?>/<?=date('Y')?>">Laporan Pengeluaran</a></li>
						<li><a href="<?php echo base_url(); ?>fin_piutang/index/<?=date('m')?>/<?=date('Y')?>">Laporan Piutang</a></li>
						<li><a href="<?php echo base_url(); ?>fin_utang/index/<?=date('m')?>/<?=date('Y')?>">Laporan Utang</a></li>
						<li><a href="<?php echo base_url(); ?>fin_labarugi/index/<?=date('m')?>/<?=date('Y')?>">Laporan Laba / Rugi</a></li>
						<li class="divider"></li>
						<li><a href="#"><b>Keuangan Perperiode</b></a></li>
						<li class="divider"></li>
						<li><a href="<?php echo base_url(); ?>fin_kas_perperiod/index/<?=date('m')?>/<?=date('Y')?>">Laporan Kas</a></li>
						<li><a href="<?php echo base_url(); ?>fin_pemasukan_perperiod/index/<?=date('m')?>/<?=date('Y')?>">Laporan Pemasukan</a></li>
						<li><a href="<?php echo base_url(); ?>fin_pengeluaran_perperiod/index/<?=date('m')?>/<?=date('Y')?>">Laporan Pengeluaran</a></li>
						<li><a href="<?php echo base_url(); ?>fin_piutang_perperiod/index/<?=date('m')?>/<?=date('Y')?>">Laporan Piutang</a></li>
						<li><a href="<?php echo base_url(); ?>fin_utang_perperiod/index/<?=date('m')?>/<?=date('Y')?>">Laporan Utang</a></li>
						<li><a href="<?php echo base_url(); ?>fin_labarugi_perperiod/index/<?=date('m')?>/<?=date('Y')?>">Laporan Laba / Rugi</a></li>
												
						<!--<li><a href="<?php echo base_url(); ?>fin_labarugi/perperiod">Laporan Laba / Rugi perperiod</a></li>-->
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav">        
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Setting <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo base_url(); ?>user">User / Pengguna</a></li>
						<li><a href="<?php echo base_url(); ?>backup">Backup Data</a></li>
						<li><a href="<?php echo base_url(); ?>restore">Restore Data</a></li>
					</ul>
				</li>		
			 </ul>
			<ul class="nav navbar-nav">        		
			  <a class="btn btn-danger navbar-btn" href="<?=base_url()?>app/logout"><?=showicon('off')?> Logout</a>		
			</ul>	
			</div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>

<?php
	}	
?>			