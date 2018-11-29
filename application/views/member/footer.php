<?php 
	$kontak_kami = $this->db->get('INFO')->row();
 ?>
		<section class="footer" style="background-image: url('<?php echo base_url() ?>assets/footer.jpg');background-size: cover;background-position: center center;border: none;outline: none;">
			<div class="container" style="padding: 20px">
				<div class="row">
					<div class="col-md-3 col-sm-6">
						<h4 class="text-white title"><b>KONTAK KAMI</b></h4>
						<br>
						<p class="text-white">
							<i class="icon icon-phone"></i> 
							<?php echo $kontak_kami->INFO_HP; ?>
						</p>
						<p class="text-white">
							<i class="icon icon-location-pin"></i> 
							<?php echo $kontak_kami->INFO_ALAMAT; ?>
						</p>
						<p class="text-white">
							<i class="icon icon-envelope-letter"></i> 
							<a href="mailto:<?php echo $kontak_kami->INFO_EMAIL; ?>">
								<?php echo $kontak_kami->INFO_EMAIL; ?>		
							</a>
						</p>
					</div>
					<div class="col-md-3 col-sm-6">
						<h4 class="text-white title"><b>SOSIAL MEDIA </b></h4>
						<br>
						
						<p class="text-white">
							<i class="icon icon-social-facebook"></i> 
							<a href="<?php echo $kontak_kami->INFO_FB; ?>">
							Facebook
							</a>
						</p>
						<p class="text-white">
							<i class="icon icon-social-instagram"></i> 
							<a href="<?php echo $kontak_kami->INFO_INSTAGRAM; ?>">
							Instagram
							</a>
						</p>
						<p class="text-white">
							<i class="icon icon-social-youtube"></i> 
							<a href="<?php echo $kontak_kami->INFO_YOUTUBE; ?>">
							Youtube Channel
							</a>
						</p>
					</div>
					<div class="col-md-2 col-sm-6">
						<h4 class="text-white title"><b>KONTEN </b></h4>
						<br>
						<p class="text-white">
							<i class="icon icon-check"></i>
							<a href="<?php echo base_url() ?>beranda">Beranda</a>
						</p>
						<p class="text-white">
							<i class="icon icon-check"></i>
							<a href="<?php echo base_url() ?>lembaga">Lembaga</a>
						</p>
						<p class="text-white">
							<i class="icon icon-check"></i>
							<a href="<?php echo base_url() ?>rekening">Rekening</a>
						</p>
						<p class="text-white">
							<i class="icon icon-check"></i>
							<a href="<?php echo base_url() ?>ketentuan">Ketentuan</a>
						</p>
						<p class="text-white">
							<i class="icon icon-check"></i>
							<a href="<?php echo base_url() ?>tentang">Tentang Kami</a>
						</p>
					</div>
					<div class="col-md-4 col-sm-6">
						<h4 class="text-white title text-center"><b>BERITAHU KAMI </b></h4>
						<br>
						<a href="<?php echo base_url() ?>masukan" class="btn btn-light btn-block btn-lg text-dark"><b><i class="icon icon-support"></i> MASUKAN</b></a>
						
						<br>
						<h4 class="text-white title text-center"><b>DOWNLOAD APP</b></h4>
						<div class="text-center get-app">
							<a href="#"><img class="img-fluid" src="<?php echo base_url() ?>assets/get_android.png" width="150px" alt="get_android.png"/></a></a>
							<a href="#"><img class="img-fluid" src="<?php echo base_url() ?>assets/get_ios.png" width="150px" alt="get_ios.png"/></a></a>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="bg-dark text-white" style="padding: 20px;border: green;outline: none;">
		    <div class="container">
		        <div class="col-md-12">
		            <p>&copy; 2018 SISTEM TABUNGAN QURBAN</p>
		        	<p>Alpha Version</p>
		        </div>
		    </div>
		</section>
	</body>
</html>