	<?php echo $__sidebar; ?>

	    <!-- Page Content  -->
	    <div id="content">

	        <?php echo $__header; ?>
	        <div class="card">
	        	<div class="card-body">
			    	<div class="row">
			    		<div class="col-12">
			    		  	<h4 class="text-primary"><b><i class="icon icon-plus"></i> TAMBAH LEMBAGA</b></h4>
			    		</div>
			    	</div>

			    	<div class="row">
						<div class="col-md-6">
							<form action="<?php echo base_url() ?>admin/lembaga__add" method="POST">
								<div class="form-group">
									<label>Nama</label><span class="required">*</span>
									<input type="text" class="form-control" placeholder="Enter Nama" name="NAMA" required="">
								</div>
								<fieldset class="form-group">
									<label>HP</label><span class="required">*</span>
									<input data-parsley-type="number" type="text" class="form-control" placeholder="Enter HP" name="HP" required="">
								</fieldset>
								<fieldset class="form-group">
									<label>Email</label><span class="required">*</span>
									<input data-parsley-type="email" type="text" class="form-control" placeholder="Enter Email" name="EMAIL" required="">
								</fieldset>
								<fieldset class="form-group">
									<label>Alamat</label><span class="required">*</span>
									<textarea class="form-control" rows="5" name="ALAMAT" placeholder="Enter Alamat" required=""></textarea>
								</fieldset>
								<fieldset class="form-group">
									<label>Latitude</label><span class="required">*</span>
									<input type="text" class="form-control" placeholder="Enter LAT" name="LAT" required="">
								</fieldset>
								<fieldset class="form-group">
									<label>Longtitude</label><span class="required">*</span>
									<input type="text" class="form-control" placeholder="Enter LONG" name="LONG" required="">
								</fieldset>
								<button type="submit" class="btn btn-primary">Simpan</button>
								<a href="<?php echo base_url();?>admin/lembaga" class="btn btn-light">Kembali</a>
							</form>
						</div>
						<div class="col-md-6">
							<p>Perhatian :</p>
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