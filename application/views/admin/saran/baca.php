		<?php $sar = $query_saran->row(); ?>
		<?php echo $__sidebar; ?>

	    <!-- Page Content  -->
	    <div id="content">

	        <?php echo $__header; ?>
	        <div class="card">
	        	<div class="card-body">
			    	<div class="row">
			    		<div class="col-12">
			    		  	<h4 class="text-primary"><a href="<?php echo base_url(); ?>admin/saranList" class="text-primary"><i class="icon icon-arrow-left-circle"></i></a> BACA SARAN</h4>
			    		</div>
			    	</div>
			    	<div class="row">
						<div class="col-md-6">
							<br>
							<blockquote class="blockquote">
								<p class="mb-0"><?php echo $sar->SARAN_ISI; ?></p>
								<br>
								<footer class="blockquote-footer"><?php echo $sar->SARAN_NAMA; ?> | <cite title="Source Title"><?php echo $sar->SARAN_EMAIL; ?></cite></footer>
							</blockquote>
						</div>
						<div class="col-md-6">
						</div>
					</div>
				</div>
			</div>
	    </div>
	</div>
	</body>
</html>