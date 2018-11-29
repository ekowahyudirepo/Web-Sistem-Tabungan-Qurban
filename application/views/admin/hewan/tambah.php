		<?php echo $__sidebar; ?>

	    <!-- Page Content  -->
	    <div id="content">

	        <?php echo $__header; ?>
	        <div class="card">
	        	<div class="card-body">
			    	<div class="row">
			    		<div class="col-12">
			    		  	<h4 class="text-primary"><b><i class="icon icon-plus"></i> TAMBAH HEWAN</b></h4>
			    		</div>
			    	</div>

			    	<div class="row">
						<div class="col-md-6">
							<form action="<?php echo base_url() ?>admin/hewan__add" method="POST">
								<fieldset class="form-group">
									<label>Nama</label><span class="required">*</span>
									<input type="text" class="form-control" placeholder="Enter Nama" name="NAMA" required="">
								</fieldset>
								<fieldset class="form-group">
									<label>Jenis</label><span class="required">*</span>
									<select class="form-control" name="JENIS" required="">
										<option value="">--Pilih--</option>
										<option value="KAMBING">Kambing</option>
										<option value="SAPI">Sapi</option>
									</select>
								</fieldset>
								<fieldset class="form-group">
									<label>Harga</label><span class="required">*</span>
									<input id="mask1" type="text" class="form-control" placeholder="Enter Harga" name="HARGA" required="">
								</fieldset>
								<fieldset class="form-group">
									<label>Barat</label><span class="required">*</span>
									<input type="text" class="form-control" placeholder="Enter Berat" name="BERAT" required="">
								</fieldset>
								<fieldset class="form-group">
									<label>Urut</label><span class="required">*</span>
									<input type="number" class="form-control" name="URUT" required="" data-parsley-min="1">
								</fieldset>
								<button type="submit" class="btn btn-primary">Simpan</button>
								<a href="<?php echo base_url();?>admin/hewan" class="btn btn-light">Kembali</a>
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
	<script>
		jQuery(document).ready(function($) {
            $('form').parsley();

			$("#mask1").maskMoney({thousands:'.', decimal:',', allowZero: true, prefix : 'Rp. '});
		});

    </script>
	</script>
	</body>
</html>