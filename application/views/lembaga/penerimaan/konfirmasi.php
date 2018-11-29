	<?php $not = $query_nota->row() ?>
	<?php echo $__sidebar; ?>

	    <!-- Page Content  -->
	    <div id="content">

	        <?php echo $__header; ?>
	        
	        <div class="card">
	        	<div class="card-body">
			    	<div class="row">
			    		<div class="col-12">
			    		  	<h3 class="text-primary"><b><i class="icon icon-plus"> </i> TAMBAH BUKTI PENERIMAAN</b></h3>
			    		</div>
			    	</div>

			    	<form method="POST" enctype="multipart/form-data">
			    	<input type="hidden" name="ID" value="<?php echo $not->NOTA_ID; ?>">
			    	<div class="row">
						<div class="col-md-12">
							<table class="table table-bordered">
								<tr>
									<th width="5%">No</th>
									<th width="20%">Preview</th>
									<th width="75%">Opsi</th>
								</tr>
								<tr>
									<td>1.</td>
									<td>
										<img id="image-preview1" src="<?php echo base_url() ?>uploads/lembaga/bukti/<?php echo ($not->NOTA_GMB1 == NULL)? '' : $not->NOTA_GMB1; ?>" class="img-fluid" width="100%" alt="image preview"/>
									</td>
									<td>
										<?php if($not->NOTA_GMB1 == NULL){ ?>
										<div class="input-group">
											<input type="file" class="form-control" id="image-source1" name="GMB1" onchange="previewImage1()">
											<span class="input-group-btn">
												<button formaction="<?php echo base_url() ?>lembaga/penerimaan__konfirmasi1" class="btn btn-secondary btn-lg" type="submit">Upload</button>
											</span>
										</div>
										<?php }else{ ?>
											<a href="<?php echo base_url() ?>lembaga/penerimaan__konfirmasi1_del/<?php echo $not->NOTA_ID; ?>" class="btn btn-danger">Hapus</a>
										<?php } ?>
									</td>
								</tr>
								<tr>
									<td>2.</td>
									<td>
										<img id="image-preview2" src="<?php echo base_url() ?>uploads/lembaga/bukti/<?php echo ($not->NOTA_GMB2 == NULL)? '' : $not->NOTA_GMB2; ?>" class="img-fluid" width="100%" alt="image preview"/>
									</td>
									<td>
										<?php if($not->NOTA_GMB2 == NULL){ ?>
										<div class="input-group">
											<input type="file" class="form-control" id="image-source2" name="GMB2" onchange="previewImage2()">
											<span class="input-group-btn">
												<button formaction="<?php echo base_url() ?>lembaga/penerimaan__konfirmasi2" class="btn btn-secondary btn-lg" type="submit">Upload</button>
											</span>
										</div>
										<?php }else{ ?>
											<a href="<?php echo base_url() ?>lembaga/penerimaan__konfirmasi2_del/<?php echo $not->NOTA_ID; ?>" class="btn btn-danger">Hapus</a>
										<?php } ?>
									</td>
								</tr>
								<tr>
									<td>3.</td>
									<td>
										<img id="image-preview3" src="<?php echo base_url() ?>uploads/lembaga/bukti/<?php echo ($not->NOTA_GMB3 == NULL)? '' : $not->NOTA_GMB3; ?>" class="img-fluid" width="100%" alt="image preview"/>
									</td>
									<td>
										<?php if($not->NOTA_GMB3 == NULL){ ?>
										<div class="input-group">
											<input type="file" class="form-control" id="image-source3" name="GMB3" onchange="previewImage3()">
											<span class="input-group-btn">
												<button formaction="<?php echo base_url() ?>lembaga/penerimaan__konfirmasi3" class="btn btn-secondary btn-lg" type="submit">Upload</button>
											</span>
										</div>
										<?php }else{ ?>
											<a href="<?php echo base_url() ?>lembaga/penerimaan__konfirmasi3_del/<?php echo $not->NOTA_ID; ?>" class="btn btn-danger">Hapus</a>
										<?php } ?>
									</td>
								</tr>
								<tr>
									<td>4.</td>
									<td>
										<img id="image-preview4" src="<?php echo base_url() ?>uploads/lembaga/bukti/<?php echo ($not->NOTA_GMB4 == NULL)? '' : $not->NOTA_GMB4; ?>" class="img-fluid" width="100%" alt="image preview"/>
									</td>
									<td>
										<?php if($not->NOTA_GMB4 == NULL){ ?>
										<div class="input-group">
											<input type="file" class="form-control" id="image-source4" name="GMB4" onchange="previewImage4()">
											<span class="input-group-btn">
												<button formaction="<?php echo base_url() ?>lembaga/penerimaan__konfirmasi4" class="btn btn-secondary btn-lg" type="submit">Upload</button>
											</span>
										</div>
										<?php }else{ ?>
											<a href="<?php echo base_url() ?>lembaga/penerimaan__konfirmasi4_del/<?php echo $not->NOTA_ID; ?>" class="btn btn-danger">Hapus</a>
										<?php } ?>
									</td>
								</tr>
							</table>
							
							

						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<button type="submit" formaction="<?php echo base_url() ?>lembaga/penerimaan__konfirmasi_status/<?php echo $this->uri->segment(3); ?>" class="btn btn-primary">Konfirmasi Terima</button>
							<a href="<?php echo base_url();?>lembaga/penerimaanDetail/<?php echo $this->uri->segment(3); ?>" class="btn btn-light">Kembali</a>
						</div>
					</div>
					</form>
				</div>
			</div>
	    </div>
	</div>

	<script type="text/javascript">
	 	function previewImage1() {
		    document.getElementById("image-preview1").style.display = "block";
		    var oFReader = new FileReader();
		     oFReader.readAsDataURL(document.getElementById("image-source1").files[0]);

		    oFReader.onload = function(oFREvent) {
		      document.getElementById("image-preview1").src = oFREvent.target.result;
		    };
		  };

		function previewImage2() {
		    document.getElementById("image-preview2").style.display = "block";
		    var oFReader = new FileReader();
		     oFReader.readAsDataURL(document.getElementById("image-source2").files[0]);

		    oFReader.onload = function(oFREvent) {
		      document.getElementById("image-preview2").src = oFREvent.target.result;
		    };
		  };

		function previewImage3() {
		    document.getElementById("image-preview3").style.display = "block";
		    var oFReader = new FileReader();
		     oFReader.readAsDataURL(document.getElementById("image-source3").files[0]);

		    oFReader.onload = function(oFREvent) {
		      document.getElementById("image-preview3").src = oFREvent.target.result;
		    };
		  };

		function previewImage4() {
		    document.getElementById("image-preview4").style.display = "block";
		    var oFReader = new FileReader();
		     oFReader.readAsDataURL(document.getElementById("image-source4").files[0]);

		    oFReader.onload = function(oFREvent) {
		      document.getElementById("image-preview4").src = oFREvent.target.result;
		    };
		  };
	 </script>
	</body>
</html>