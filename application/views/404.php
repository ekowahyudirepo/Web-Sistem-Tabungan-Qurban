<!DOCTYPE html>
<html>
<head>
	<title></title>

	<?php 
		echo __css('bootstrap');
	 ?>
	<style>
		.overlay{
			position: fixed;
			left: 0;
			top: 0;
			z-index: 99999;
			width: 100%;
			height: 100%;
			overflow: visible;
			background-color: rgba(255,255,255,.5);
			align-items: center;
			display: flex;
			justify-content: center;
		}

		.overlay .icon{
			animation: spin .7s linear infinite;
		}

		@keyframes spin{
		    0%{
		        transform: translate(0px,20px);
		    }
		    100%{
		        transform: translate(0px,0px);
		    }
		}
	</style>
</head>
<body>
<div class="overlay">
	<div class="icon">
		<img width="100px;" src="<?php echo base_url() ?>assets/img/icon/kambing.png">
	</div>
	<div>
		<h1 class="text-success">Maaf! Halaman Tidak ditemukan</h1>
		<a class="btn btn-light" href="<?php echo base_url(); ?>">Ke halaman beranda</a>
		<a class="btn btn-dark" href="<?php echo base_url(); ?>masukan?url=<?php echo str_replace('index.php/', '', $this->input->server('HTTP_HOST').$this->input->server('PHP_SELF')); ?>">Laporkan link rusak</a>
	</div>
</div>
</body>
</html>