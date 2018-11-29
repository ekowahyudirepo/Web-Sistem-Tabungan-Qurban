<!--  Header -->
<?php echo $__header; ?>

<div class="container" style="padding-top: 100px;">
	<div class="row">
		<div class="col-md-4 offset-md-4">
			<h2 class="text-primary text-center"><b><i class="icon icon-key"></i> GANTI PASSWORD</b></h2>
  			<div class="card" style="padding: 10px;">
  				<form action="<?php echo base_url() ?>member/member__lupa_passwod_konfirmasi" method="POST">
  					<input type="hidden" name="EMAIL" value="<?php echo $this->input->get('q'); ?>">
  					<fieldset class="form-group">
  						<label>Password Baru</label>
  						<input type="password" class="form-control" name="PASSWORD_BARU" placeholder="Enter password"  required="" id="pass2">
  					</fieldset>
  					<fieldset class="form-group">
  						<label>Ulangi Password</label>
  						<input type="password" class="form-control" name="PASSWORD_ULANGI" placeholder="Enter password" required="" data-parsley-equalto="#pass2">
  					</fieldset>
  					<br>
  					<button type="submit" class="btn btn-primary"><i class="icon icon-login"></i> Perbarui</button>
  					<span class="float-right">Sudah ingat password anda ? <a href="<?php echo base_url() ?>member/masuk" class="btn btn-link">Coba login</a></span>
  					<div class="clearfix"></div>
  				</form>
  			</div>
		</div>
	</div>
</div>


<script>
  $(function(){
    $('form').parsley();
  })
</script>
<!-- Footer -->
<?php echo $__footer; ?>