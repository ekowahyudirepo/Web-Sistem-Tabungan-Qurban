<?php echo $__header; ?>

<div class="container" style="margin-top: 100px">
	<div class="row widget">
		<div class="col-md-12">
			<h3 class="text-success"><b><i class="icon icon-check"></i> KETENTUAN</b></h3>
		</div>
		<div class="col-md-12">
			<div class="card card-style">
				<div class="container">
					<div class="row">
						<div class="col-12" style="padding: 20px;">
						  	<p style="font-size: 16px;" class="text-muted"><?php echo $this->db->get('INFO')->row()->INFO_KETENTUAN; ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Footer -->
<?php echo $__footer; ?>
