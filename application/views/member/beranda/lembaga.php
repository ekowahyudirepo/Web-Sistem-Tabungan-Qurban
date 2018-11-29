<?php echo $__header; ?>

<div class="container" style="margin-top: 100px">
	<div class="row widget">
		<div class="col-md-12">
			<h3 class="text-success"><b><i class="icon icon-user-following"></i> LEMBAGA PENERIMA</b></h3>
		</div>
		<?php foreach( $query_pen->result() as $pen ){ ?>
			<div class="col-md-6 col-12">
				<div class="card card-style">
					<div class="container text-center">
						<div class="row">
							<div class="col-12" style="padding: 20px;">
							  	<h4 class="text-success"><b></b><?php echo $pen->LEMBAGA_NAMA; ?></b></h4>
							  	<br>
							  	<p class="text-muted"><?php echo $pen->LEMBAGA_ALAMAT; ?></p>
							  	<p class="text-muted"><?php echo $pen->LEMBAGA_HP; ?> | <?php echo $pen->LEMBAGA_EMAIL; ?></p>
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