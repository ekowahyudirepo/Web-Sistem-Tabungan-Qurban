		<?php $info = $this->db->get('INFO')->row(); ?>
		<?php echo $__sidebar; ?>

	    <!-- Page Content  -->
	    <div id="content">

	        <?php echo $__header; ?>

	        <div class="card">
	        	<div class="card-body">
			    	<div class="row">
			    		<div class="col-12">
			    		  	<h4 class="text-primary"><b><i class="icon icon-info"> </i> INFO</b></h4>
			    		</div>
			    	</div>
			    	<div class="row">
			    		<div class="col-md-8">
			    			<div class="btn-group">
								<a href="<?php echo base_url() ?>admin/info/info" class="btn btn-<?php echo ( $this->uri->segment(3) == '' OR $this->uri->segment(3) == 'info' )? 'primary' : 'light'; ?>">Info</a>
								<a href="<?php echo base_url() ?>admin/info/kontak" class="btn btn-<?php echo ( $this->uri->segment(3) == 'kontak' )? 'primary' : 'light'; ?>">Kontak</a>
								<a href="<?php echo base_url() ?>admin/info/tentang" class="btn btn-<?php echo ( $this->uri->segment(3) == 'tentang' )? 'primary' : 'light'; ?>">Tentang</a>
								<a href="<?php echo base_url() ?>admin/info/ketentuan" class="btn btn-<?php echo ( $this->uri->segment(3) == 'ketentuan' )? 'primary' : 'light'; ?>">Ketantuan</a>
							</div>
						</div>
			    	</div>
			    	<form action="<?php echo base_url() ?>admin/info__up/ketentuan" method="POST">
			    	<div class="row">
						<div class="col-md-12">
							<fieldset class="form-group">
								<label>Ketentuan</label>
								<textarea id="summernote" class="form-control" name="KETENTUAN"><?php echo $info->INFO_KETENTUAN; ?></textarea>
							</fieldset>
							<button type="submit" class="btn btn-primary"><i class="icon icon-check"></i> Perbarui</button>
						</div>
					</div>
					</form>
				</div>
			</div>
	    </div>
	</div>
	
    <script>
    $(document).ready(function() {
      $('#summernote').summernote();
    });
    </script>
		
	</body>
</html>