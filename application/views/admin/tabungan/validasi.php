		<?php $tab = $query_tab->row() ?>
		<?php echo $__sidebar; ?>

	    <!-- Page Content  -->
	    <div id="content">

	        <?php echo $__header; ?>
	        
	        <div class="card">
	        	<div class="card-body">
			    	<div class="row">
			    		<div class="col-12">
			    		  	<h4 class="text-primary"><b><i class="icon icon-check"></i> VALIDASI TABUNGAN MEMBER</b></h4>
			    		</div>
			    	</div>

			    	<form action="<?php echo base_url() ?>admin/tabungan__validasi_status" method="POST" enctype="multipart/form-data">
			    	<input type="hidden" name="ID" value="<?php echo $tab->TABUNGAN_ID; ?>">
			    	<div class="row">
						<div class="col-md-6">
							<fieldset class="form-group">
								<label>Status</label><span class="required">*</span>
								<select class="form-control" name="STATUS" required="">
									<option value="">-- Pilih --</option>
									<option value="TERIMA">Terima</option>
									<option value="TOLAK">Tolak</option>
								</select>
							</fieldset>
							<fieldset class="form-group">
								<label>Pesan</label>
								<textarea class="form-control" name="CATATAN" rows="6"></textarea>
							</fieldset>
							
							<button type="submit" class="btn btn-primary">Validasi Tabungan</button>
						</div>
						<div class="col-md-6">
							<p>Perhatian</p>
							<span class="required">*</span> Harus diisi
						</div>
					</div>
					</form>
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