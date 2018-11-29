	<?php $lem = $query_lembaga->row(); ?>
	
	<?php echo $__sidebar; ?>

	    <!-- Page Content  -->
	    <div id="content">

	        <?php echo $__header; ?>
	        <div class="card">
	        	<div class="card-body">
			    	<div class="row">
			    		<div class="col-12">
			    		  	<h4 class="text-primary"><b><i class="icon icon-pencil"></i> EDIT LEMBAGA</b></h4>
			    		</div>
			    	</div>
			    	<div class="row">
						<div class="col-md-6">
							<form action="<?php echo base_url() ?>admin/lembaga__up" method="POST">
								<input type="hidden" value="<?php echo $lem->LEMBAGA_ID; ?>" name="ID">
								<fieldset class="form-group">
									<label>Nama</label><span class="required">*</span>
									<input type="text" class="form-control" placeholder="Enter NIM" name="NAMA" value="<?php echo $lem->LEMBAGA_NAMA; ?>" required="">
								</fieldset>
								<fieldset class="form-group">
									<label>HP</label><span class="required">*</span>
									<input data-parsley-type="number" type="text" class="form-control" placeholder="Enter nama" name="HP" value="<?php echo $lem->LEMBAGA_HP; ?>" required="">
								</fieldset>
								<fieldset class="form-group">
									<label>Email</label><span class="required">*</span>
									<input data-parsley-type="email" type="text" class="form-control" placeholder="Enter Email" name="EMAIL" value="<?php echo $lem->LEMBAGA_EMAIL ?>" required="">
								</fieldset>
								<fieldset class="form-group">
									<label>Alamat</label><span class="required">*</span>
									<textarea class="form-control" rows="5" name="ALAMAT" required=""><?php echo $lem->LEMBAGA_ALAMAT; ?></textarea>
								</fieldset>
								<fieldset class="form-group">
									<label>Latitude</label><span class="required">*</span>
									<input type="text" class="form-control" placeholder="Enter LAT" name="LAT" value="<?php echo $lem->LEMBAGA_LAT ?>" required="">
								</fieldset>
								<fieldset class="form-group">
									<label>Longitude</label><span class="required">*</span>
									<input type="text" class="form-control" placeholder="Enter LONG" name="LONG" value="<?php echo $lem->LEMBAGA_LONG ?>" required="">
								</fieldset>
								<button type="submit" class="btn btn-primary">Simpan</button>
								<a href="<?php echo base_url() ?>admin/lembaga" class="btn btn-light">Kembali</a>
							</form>
						</div>
						<div class="col-md-6">
							<p>Perhatian</p>
							<span class="required">*</span> Harus diisi
						</div>
					</div>
				</div>
			</div>
	    </div>
	</div>
	
    <script type="text/javascript">
        $(document).ready(function() {
            $('form').parsley();
        });
    </script>
	</body>
</html>