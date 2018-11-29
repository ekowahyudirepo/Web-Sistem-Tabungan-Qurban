<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title><?php echo $__title; ?></title>

        <?php for($i=0;$i<count($__css);$i++){ echo __css($__css[$i]); } ?>

        <?php for($i=0;$i<count($__js);$i++){ echo __js($__js[$i]); } ?>

	</head>
	<body class="login" style="background-color: lightgrey">
	<div class="bxlogin">

		<?php echo $this->session->flashdata('__alert'); ?>
		<div class="card">
			<div class="card-body">
				<h2 class="text-primary"><b>MASUK ADMIN</b></h2>
				<br>
				<form action="<?php echo base_url() ?>admin/admin__masuk" method="POST">
					<fieldset class="form-group">
						<label>Username</label>
						<input type="text" class="form-control" placeholder="Enter Username" name="USERNAME" tabindex="1" required="" autofocus="">
					</fieldset>
					<fieldset class="form-group">
						<label>Password</label>
						<a href="#lupa_password" data-toggle="modal" class="float-right btn btn-link" tabindex="4"><label><i class="icon icon-question"></i> Lupa password</label></a>
						<div class="clearfix"></div>
						<input type="password" class="form-control" placeholder="Enter password" name="PASSWORD" tabindex="2" required="">
					</fieldset>
					<fieldset class="form-group">
						<?php echo $widget;?>
						<?php echo $script;?>
					</fieldset>
					
					<br>
					<button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="3"><i class="icon icon-login"></i> Masuk</button>
					
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="lupa_password">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Formulir Lupa Password</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span>
					</button>
					
				</div>
				<div class="modal-body">
					<form>
						<fieldset class="form-group">
							<label>Email address</label>
							<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
							<small class="text-muted">Sistem hanya mengirim email ke email yang telah anda daftarkan sebelumya</small>
						</fieldset>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="button" onclick="alert('Belum aktif')" class="btn btn-primary">Kirim</button>
					</form>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<?php 
		echo __js('jquery');
		echo __js('parsley');
		echo __js('bootstrap'); 
		echo __js('dashboard'); 
	?>
	<script>
	 	$(document).ready(function(){
	 		$('form').parsley();
	 	})
	 </script>
	</body>
</html>