<?php 
	$info    = $this->db->get('INFO')->row();
	$session = $this->session->all_userdata();

 ?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="referrer" content="origin-when-cross-origin">
        
        <title><?php echo $__title; ?></title>

        <meta name="description" content="Tabungan Qurban | Qurbanapp">
		<meta property="og:locale" content="id">
		<meta property="og:type" content="website">
		<meta property="og:title" content="Berkurban sekarang lebih mudah | Qurbanapp">
		<meta property="og:description" content="Tabungan Qurban | Qurbanapp">
		<meta name="mobile-web-app-capable" content="yes">

		<meta property="og:site_name" content="Qurbanapp">

        <?php for($i=0;$i<count($__css);$i++){ echo __css($__css[$i]); } ?>

        <?php for($i=0;$i<count($__js);$i++){ echo __js($__js[$i]); } ?>
    </head>
	<body>
	<!-- Header -->

<div class="preloader">
	<div class="icon">
		<img width="70px;" src="<?php echo base_url() ?>assets/loading.svg">
	</div>
</div>

<?php echo $this->session->flashdata('__alert'); ?>
<nav class="navbar navbar-expand-md mb-5 fixed-top navbar-style" style="margin:0px;background: linear-gradient(to right, green , blue);">
	<a class="navbar-brand navbar-brand-style" href="<?php echo base_url(); ?>">
		<img src="<?php echo base_url() ?>uploads/<?php echo $info->INFO_LOGO; ?>" width="150;" alt="<?php echo $info->INFO_LOGO; ?>">
	</a>
	<button class="navbar-toggler navbar-toggler-style" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
		<i class="icon icon-menu"></i>
	</button>
	
	<div class="collapse navbar-collapse" id="navbarCollapse">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item <?php echo __menu_active('utama', $__menu ); ?>">
				<a class="nav-link text-light" href="<?php echo base_url() ?>beranda">Beranda</a>
			</li>
			<li class="nav-item <?php echo __menu_active('lembaga', $__menu ); ?>">
				<a class="nav-link text-light" href="<?php echo base_url() ?>lembaga">Lembaga</a>
			</li>
			<li class="nav-item <?php echo __menu_active('rekening', $__menu ); ?>">
				<a class="nav-link text-light" href="<?php echo base_url() ?>rekening">Rekening</a>
			</li>
			<li class="nav-item <?php echo __menu_active('ketentuan', $__menu ); ?>">
				<a class="nav-link text-light" href="<?php echo base_url() ?>ketentuan">Ketentuan</a>
			</li>
			<li class="nav-item <?php echo __menu_active('tentang', $__menu ); ?>">
				<a class="nav-link text-light" href="<?php echo base_url() ?>tentang">Tentang Kami</a>
			</li>
		</ul>
        <ul class="navbar-nav ml-auto">
        	<!-- ON -->
        	<?php if( isset($session['__ci_member_id']) ){ ?>
	        	<li class="nav-item dropdown">
					<a class="nav-link text-white dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
					<?php if( $session['__ci_member_foto'] == NULL ){ ?>
					<img class="rounded-circle" style="margin-top: -5px" width="30" src="<?php echo base_url() ?>uploads/not.jpg" alt="not.jpg">
					<?php }else{ ?>
					<img class="rounded-circle" style="margin-top: -5px" width="30" src="<?php echo base_url() ?>uploads/member/foto/<?php echo $session['__ci_member_foto']; ?>" alt="<?php echo $session['__ci_member_foto']; ?>">
					<?php } ?>
					
					 Hi, <?php echo $session['__ci_member_nama']; ?>
					</a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="<?php echo base_url() ?>member/pembelian"><i class="icon icon-bag"></i> Pembelian Saya</a>
						<a class="dropdown-item" href="<?php echo base_url() ?>member/profil"><i class="icon icon-user"></i> Profil</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item logout" href="<?php echo base_url() ?>member/keluar"><i class="icon icon-logout"></i> Keluar</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<!-- <span class="badge badge-success"> -->
						<a class="nav-link btn btn-success dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
							<i class="icon icon-wallet"></i>
							<b class="get-saldo">
								<?php echo __rp($this->M__tabungan->saldo($this->session->userdata('__ci_member_id'))); ?>
							</b>
						</a>
					<!-- </span> -->
					<div class="dropdown-menu">
						<a class="dropdown-item" href="<?php echo base_url() ?>member/tabunganTambah"><i class="icon icon-plus"></i> Deposito</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="<?php echo base_url() ?>member/tabungan"><i class="icon icon-list"></i> Riwayat Deposito</a>
					</div>
				</li>
			<?php } ?>
			<!-- OFF -->
			<?php if( ! isset($session['__ci_member_id']) ){ ?>
				<li class="nav-item">
					<div class="btn-group" role="group" aria-label="Basic example">
						<a href="<?php echo base_url() ?>member/masuk" class="nav-link btn btn-success btn-sm"><i class="icon icon-login"></i> Masuk</a>
						<a href="<?php echo base_url() ?>member/registrasi" class="nav-link btn btn-light text-success"><i class="icon icon-user-follow"></i> Registrasi</a>
					</div>
				</li>
			<?php } ?>
		</ul>
	</div>
</nav>
<?php if( $info->INFO_RUN_TEXT_STATUS == 'TAMPIL' ){ ?>
<marquee onmouseover="this.stop()" onmouseout="this.start()" scrollamount="5" class="bg-light run-text sticky-top" style="top: 74px;padding: 12px;font-size:14px;">
	<?php echo $info->INFO_RUN_TEXT; ?>
</marquee>
<?php } ?>

