<?php echo $__header; ?>

<div class="container" style="margin-top: 100px">
	<div class="row">
		<div class="col-md-12">
			<h3 class="text-success"><b><i class="icon icon-support"></i> MASUKAN</b></h3>
		</div>
		<div class="col-md-12">
			<div class="container">
				<div class="row">
					<div class="col-12">
					  	<p class="text-muted">Sampaikan masukkan anda melalui formulir ini</p>
					  	<form action="<?php echo base_url() ?>member/saran__add" method="POST">
					  		<?php if( $this->session->userdata('__ci_member_nama') ){ ?>
					  		<fieldset class="form-group">
					  			<label>Nama Anda</label><span class="required">*</span>
					  			<input type="text" class="form-control" name="NAMA" placeholder="Enter nama" required="" readonly="" value="<?php echo $this->session->userdata('__ci_member_nama'); ?>">
					  		</fieldset>
						  	<?php }else{ ?>
						  	<fieldset class="form-group">
					  			<label>Nama Anda</label><span class="required">*</span>
					  			<input type="text" class="form-control" name="NAMA" placeholder="Enter nama" required="">
					  		</fieldset>
						  	<?php } ?>
						  	<?php if( $this->session->userdata('__ci_member_email') ){ ?>
					  		<fieldset class="form-group">
					  			<label>Email Anda</label><span class="required">*</span>
					  			<input type="email" class="form-control" name="EMAIL" placeholder="Enter email" required="" readonly="" value="<?php echo $this->session->userdata('__ci_member_email'); ?>">
					  		</fieldset>
					  		<?php }else{ ?>
					  		<fieldset class="form-group">
					  			<label>Email Anda</label><span class="required">*</span>
					  			<input type="email" class="form-control" name="EMAIL" placeholder="Enter email" required="">
					  		</fieldset>
					  		<?php } ?>
					  		<?php if( $this->input->get('url') ){ ?>
					  		<fieldset class="form-group">
					  			<label>Saran Anda</label><span class="required">*</span>
					  			<textarea class="form-control" name="ISI" placeholder="Enter saran anda disini" required="" rows="10">Saya melaporkan URL ini rusak <?php echo $this->input->get('url') ?>
					  			</textarea>
					  		</fieldset>
					  		<?php }else{ ?>
					  		<fieldset class="form-group">
					  			<label>Saran Anda</label><span class="required">*</span>
					  			<textarea class="form-control" name="ISI" placeholder="Enter saran anda disini" required="" rows="10"></textarea>
					  		</fieldset>
					  		<?php } ?>
					  		<button type="submit" class="btn btn-success">Kirim Saran</button>
					  	</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Footer -->
<?php echo $__footer; ?>