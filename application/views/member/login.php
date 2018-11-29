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

		<?php if(isset($__css)){ for($i=0;$i<count($__css);$i++){ echo __css($__css[$i]); } } ?>

        <?php if(isset($__js)){ for($i=0;$i<count($__js);$i++){ echo __js($__js[$i]); }} ?>

	</head>
	<body class="login" style="background-color: lightgrey">
	<div class="bxlogin">

		<?php echo $this->session->userdata('__alert'); ?>

		<div class="card">
			<div class="card-body">
				<h2 class="text-success"><b><a href="<?php echo base_url(); ?>" class="text-success"><i class="icon icon-arrow-left-circle"></i></a> MASUK MEMBER</b></h2>
				<br>
				<form action="<?php echo base_url() ?>member/member__masuk" method="POST">
					<input type="hidden" name="token" value="<?php echo $this->encrypt->encode(TOKEN); ?>">
					<fieldset class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" name="EMAIL" tabindex="1" placeholder="Enter email" required="">
					</fieldset>
					<fieldset class="form-group">
						<label>Password</label>
						<a href="#lupa_password" data-toggle="modal" class="float-right" tabindex="4"><label><i class="icon icon-question"></i> Lupa password</label></a>
						<div class="clearfix"></div>
						<input type="password" class="form-control" name="PASSWORD" tabindex="2" placeholder="Enter password" required="">
					</fieldset>
					<fieldset class="form-group">
						<?php echo $widget;?>
						<?php echo $script;?>
					</fieldset>
					
					<br>
					<button type="submit" class="btn btn-success btn-lg btn-block" tabindex="3"><i class="icon icon-login"></i> Masuk</button>
					<hr/>
					<p>Belum punya akun ? <a href="<?php echo base_url() ?>member/registrasi" class="btn btn-link">Registrasi disini</a></p>
				</form>
			</div>
		</div>
	</div>

	<!-- Modal lupa password -->
	<div class="modal fade" id="lupa_password">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title text-success"><b>LUPA PASSWORD</b></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span>
					</button>
					
				</div>
				<div class="modal-body">
				<form action="<?php echo base_url() ?>member/member__lupa_password" method="POST">
					<fieldset class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" name="EMAIL" placeholder="Enter email" required="">
						<small class="text-muted">Sistem hanya mengirim email ke email yang telah anda daftarkan sebelumya</small>
					</fieldset>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-success">Kirim</button>
				</div>
				</form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<script>
		$(function(){
			$('form').parsley();
		})
	</script>
	</body>
</html>