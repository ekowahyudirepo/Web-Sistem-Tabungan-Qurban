<?php echo $__header; ?>

<div class="container" style="margin-top: 100px">
	<div class="row widget">
		<div class="col-md-12">
			<h3 class="text-success"><b><i class="icon icon-credit-card"></i> REKENING</b></h3>
		</div>
		<?php foreach( $query_rek->result() as $rek ){ ?>
			<div class="col-md-6">
				<div class="card card-style" style="padding: 20px;">
					<div class="container">
						<div class="row text-center">
							<div class="col-md-6">
							  	<h5><?php echo $rek->REKENING_NO; ?></h5>
							  	<p class="text-muted">A.N <?php echo $rek->REKENING_AN; ?></p>
							</div>
							<div class="col-md-6">
							  	<h1 class="text-success"><?php echo $rek->REKENING_NAMA; ?></h1>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>

<!-- Footer -->
<?php echo $__footer; ?>