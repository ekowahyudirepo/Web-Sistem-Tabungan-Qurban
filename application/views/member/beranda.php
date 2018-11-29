<?php 
	echo $__header;
	echo $__slider;
?>

<div class="container">
	<div class="row text-center">
		<div class="col-md-4 col-sm-4 col-12">
			<div class="card card-style">
				<h3 class="text-success box-text"><b><i class="icon icon-people"></i> MEMBER</b></h3>
				<p class="text-muted box-text">Shohibbul Qurban yang bergabung</p>
				<div class="card-block bg-success">
					<h3 class="text-white"><?php echo $this->db->count_all('MEMBER'); ?></h3>
					<a href="<?php echo base_url() ?>memberList" class="btn btn-light btn-sm">Lihat <i class="icon icon-arrow-right-circle"></i></a>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-sm-4 col-12">
			<div class="card card-style">
			  	<h3 class="text-success box-text"><b><i class="icon icon-user-following"></i> LEMBAGA</b></h3>
			  	<p class="text-muted box-text">Lembaga Penerima</p>
				<div class="card-block bg-success">
				  	<h3 class="text-white"><?php echo $this->db->count_all('LEMBAGA'); ?></h3>
					<a href="<?php echo base_url() ?>lembaga" class="btn btn-light btn-sm">Lihat <i class="icon icon-arrow-right-circle"></i></a>

				</div>
			</div>
		</div>
		<div class="col-md-4 col-sm-4 col-12">
			<div class="card card-style">
			  	<h3 class="text-success box-text"><b><i class="icon icon-refresh"></i> TERSALURKAN</b></h3>
			  	<p class="text-muted box-text">Qurban Tersalurkan</p>
				<div class="card-block bg-success">
				  	<h3 class="text-white">
				  	    <?php $KERANJANG_QTY = $this->db->select_sum('KERANJANG_QTY')->get('KERANJANG')->row()->KERANJANG_QTY;
						echo ($KERANJANG_QTY == NULL)? '0' : $KERANJANG_QTY;
						 ?>
				  	    </h3>
					<a href="<?php echo base_url() ?>penyaluranList" class="btn btn-light btn-sm">Lihat <i class="icon icon-arrow-right-circle"></i></a>
				</div>
			</div>
		</div>
	</div>
	
	

	<div class="row" style="margin-top: 30px">
		<div class="col-md-12">
			<h3 class="text-success"><b><i class="icon icon-tag"></i> HARGA HEWAN</b></h3>
			<p class="text-muted">Pilih harga hewan qurban sesuai kemampuan anda</p>
		</div>
		<div class="col-12">
			<div class="owl-carousel owl-theme">
				<?php foreach( $query_hewan->result() as $hew ){ ?>
	            <div class="item">
	             	<div class="card card-style" style="height: 400px;">

					<div class="card-body" style="background-image: url('<?php echo base_url(); ?>uploads/hewan/<?php echo $hew->HEWAN_JENIS; ?>.png');background-size: cover;background-position: center center;">
					</div>
	
					<div class="bg-success text-white" style="padding: 10px;">
						<h5 class="text-white text-center box-text"><b></b><?php echo $hew->HEWAN_NAMA; ?></b></h5>
		
						<p class="text-center text-white box-text"><i class="icon icon-info"></i> Berat : <?php echo $hew->HEWAN_BERAT; ?></p>
						<p class="text-center text-white box-text"><i class="icon icon-tag"></i> Harga : <?php echo __rp($hew->HEWAN_HARGA); ?></p>
					</div>
				</div>
	            </div>
	        <?php } ?>
	        </div>
		</div>
	</div>
	<?php if( $this->session->userdata('__ci_member_id') ){ ?>
	<div class="row text-center" style="margin-top: 10px">
		<div class="col-md-12">
			<a href="<?php echo base_url() ?>member/pembelianTambah" class="btn btn-success">Mulai Pembelian Sekarang <i class="icon icon-arrow-right-circle"></i></a>
		</div>
	</div>
	<?php } ?>


	<div class="row" style="margin-top: 30px">
		<div class="col-md-12">
		  	<h3 class="text-success"><b><i class="icon icon-directions"></i> DISTRIBUSI</b></h3>
		</div>
	</div>
	<div class="owl-carousel lembaga owl-theme">
		<?php foreach( $query_lem->result() as $lem ){ ?>
		<div class="item text-center">
			<div class="card card-style">
			  	<h5 class="text-success box-text"><b></b><?php echo $lem->LEMBAGA_NAMA; ?></b></h5>
			  	<p class="text-muted box-text"><?php echo $lem->LEMBAGA_ALAMAT; ?></p>
			  	<div class="card-block">
			  		<a target="_blank" href="https://maps.google.com?q=<?php echo $lem->LEMBAGA_LAT; ?>,<?php echo $lem->LEMBAGA_LONG; ?>" class="btn btn-success btn-sm">Lihat lokasi <i class="icon icon-directions"></i></a>
			  	</div>
			</div>
		</div>
		<?php } ?>
	</div>
</div>

<script>
	const slider = $('.owl-carousel.slider');

	slider.owlCarousel({
	    items:1,
	    loop:true,
	    margin:10,
	    autoplay:true,
	    autoplayTimeout:5000,
	    autoplayHoverPause:true
	});

	const lembaga = $('.owl-carousel.lembaga');

	lembaga.owlCarousel({
	    items:2,
	    loop: false,
	    margin:10,
	    autoplay:true,
	    autoplayTimeout:5000,
	    autoplayHoverPause:true,
	});
		
	$(function(){
		$('.owl-carousel').owlCarousel({
	        loop: true,
	        margin: 10,
	        loop : false,
	        responsiveClass: true,
	        responsive: {
	          0: {
	            items: 2,
	            nav: true
	          },
	          600: {
	            items: 3,
	            nav: true
	          },
	          1000: {
	            items: 4,
	            nav: true,
	            margin: 20
	          }
	        }
	  	})
	})
</script>
<!-- Footer -->
<?php echo $__footer; ?>

