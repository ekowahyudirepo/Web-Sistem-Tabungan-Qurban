<!DOCTYPE html>
<html lang="id">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8"/>
		<meta name="msapplication-tap-highlight" content="no" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="description" content="<?php echo $this->db->get('INFO')->row()->INFO_META_DESC; ?>" />
    	<meta name="author" content="<?php echo $this->db->get('INFO')->row()->INFO_EMAIL; ?>" />
		<title><?php echo $__title; ?></title>

		<?php for($i=0;$i<count($__css);$i++){ echo __css($__css[$i]); } ?>

        <?php for($i=0;$i<count($__js);$i++){ echo __js($__js[$i]); } ?>

	</head>
	<body style="background-color: lightgrey">
		
	<div class="container">

	<?php echo $this->session->userdata('__alert'); ?>

	<div class="row" style="margin-top: 50px;">
		<div class="col-md-6 offset-md-3">
			<div class="card">
	  			<div class="card-body">
	  				<h2 class="text-success"><b><a href="<?php echo base_url(); ?>member/masuk" class="text-success"><i class="icon icon-arrow-left-circle"></i></a> REGISTRASI MEMBER BARU</b></h2>
	  				<br>
					<form action="<?php echo base_url() ?>member/member__reg" method="POST">
						<fieldset class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" name="EMAIL" tabindex="1" placeholder="Enter email" required=""/>
						</fieldset>
						<fieldset class="form-group">
							<label>Password</label>
							<input type="password" class="form-control" name="PASSWORD" tabindex="2" placeholder="Enter password" required=""/>
						</fieldset>
						<fieldset class="form-group">
							<label>Nama Lengkap</label>
							<input type="text" class="form-control" name="NAMA" tabindex="3" placeholder="Enter nama" required=""/>
						</fieldset>
						<fieldset class="form-group">
							<label>Nomor HP</label>
							<input type="text" class="form-control" name="HP" tabindex="4" placeholder="Enter nomor HP" required="" data-parsley-type="number"/>
						</fieldset>
						<fieldset class="form-group">
							<label>Jenis Kelamin</label>
							<div class="radio">
								<label>
									<input type="radio" name="JK" value="L" checked>
									Laki Laki
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="JK" value="P">
									Perempuan
								</label>
							</div>
						</fieldset>
						
						<div class="checkbox">
							<label>
								<input type="checkbox" tabindex="5"> Saya setuju dengan <a href="#ketentuan" data-toggle="modal">Ketentun yang berlaku</a>
							</label>
						</div>
						<br>
						<button type="submit" disabled="" class="btn btn-success btn-lg btn-block" tabindex="6">Daftar <i class="icon icon-arrow-right-circle"></i></button>
						<hr/>
						<p>Sudah punya akun ?<a href="<?php echo base_url() ?>member/masuk" class="btn btn-link">Masuk</a>
						</p>
					</form>
	  			</div>
	  		</div>
		</div>
	</div>
</div>

<!-- Modal ketentuan -->
<div class="modal fade" id="ketentuan">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">

				<h4 class="modal-title text-success"><b>KETENTUAN</b></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
			</div>
			<div class="modal-body" style="height: 500px;overflow-y: auto;">
				<p><?php echo $this->db->get('INFO')->row()->INFO_KETENTUAN; ?></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

	<?php 
		echo __js('jquery');
		echo __js('parsley');
		echo __js('bootstrap');
		echo __js('front');
	 ?>
	 <script>
	 	jQuery(document).ready(function($) {
	 		// Kondisi tombol submit dengan checkbox ketentuan
			const el = $('button[type=submit]');

			$(document).on('click', 'input[type=checkbox]', function(){
				var e = $('input[type=checkbox]:checked').length;

				if (e==0) { el.attr('disabled','') }else{ el.removeAttr('disabled') }
			})

	 	});
	 </script>
	</body>
</html>