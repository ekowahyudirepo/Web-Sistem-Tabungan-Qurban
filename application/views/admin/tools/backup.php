		<?php echo $__sidebar; ?>

	    <!-- Page Content  -->
	    <div id="content">

	        <?php echo $__header; ?>
	        <div class="card">
	        	<div class="card-body">
			    	<div class="row">
			    		<div class="col-12">
			    		  	<h4 class="text-primary"><b><i class="icon icon-reload"></i> CADANGKAN DAN KEMBALIKAN</b></h4>
			    		</div>
			    	</div>
			    	<div class="row">
						<div class="col-md-6">
							<div class="card bg-primary text-white">
								<div class="card-block">
									<h4 class="card-title box-text"><b>CADANGKAN</b></h4>
									<a href="<?php echo base_url() ?>admin/backup" class="btn btn-light">Cadangkan Sekarang</a>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="card bg-light">
								<div class="card-block">
									<h4 class="card-title"><b>KEMBALIKAN</b></h4>
									<form method="POST">
										<fieldset>
											<div class="form-group">
												<select class="form-control" name="file">
													<option>--Pilih--</option>
													<?php $folder = './dbbackup/'; ?>
				                                        <?php if ($hendle = opendir($folder)) { ?>

					                                        <?php while (($file = readdir($hendle)) !== false ) { ?>

						                                        <?php if(is_file($folder.$file)){ ?>
						                                        	<?php if( $file != 'index.html' ){ ?>
							                                        	<option value="<?php echo $file; ?>"><?php echo str_replace('.sql', '', $file); ?></option>
							                                        <?php } ?>
						                                        <?php } ?>
						                                    <?php } ?>
						                                    <?php closedir($handle); ?>
						                                <?php } ?>
												</select>
											</div>
										</fieldset>
										<fieldset>
											<button type="submit" formaction="<?php echo base_url() ?>admin/restore" class="btn btn-primary">Kembalikan Sekarang</button>
											<span id="opsi" style="display: none;">
												<button type="submit" formaction="<?php echo base_url() ?>admin/downloadZip" class="btn btn-primary">Download Zip</button>
												<button type="submit" formaction="<?php echo base_url() ?>admin/deleteBackup" class="btn btn-danger">Hapus</button>
											</span>
											<button name="opsi" class="btn btn-link float-right"><i class="icon icon-plus"></i> Opsi lain</button>
										</fieldset>
										<br>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	    </div>
	</div>

	<script>
		$(function(){
			$(document).on('click', 'button[name=opsi]', function(event) {
				event.preventDefault();
				/* Act on the event */
				$('#opsi').toggle();

			});
		})
	</script>
	</body>
</html>