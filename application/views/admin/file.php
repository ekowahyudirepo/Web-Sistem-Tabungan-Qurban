<style>
    .file .img{	margin: 5px; }
	.file .img img:hover{ cursor: pointer; }
</style>
<div style="background-color: #ffff;padding: 10px;height: 600px;overflow-y: auto;overflow-x: hidden;">
	<div class="row file">
		<?php foreach( $this->db->get('UPLOADS')->result() as $up ){ ?>
		<div class="col-md-2 col-4 img" style="position: relative;">
			<a style="position:absolute;top: 0; " href="#" name="<?php echo $up->UPLOADS_FILE; ?>" class="hapusFile btn btn-danger btn-sm"><i class="icon icon-close"></i></a>
			<img name="<?php echo $up->UPLOADS_FILE; ?>" class="img-fluid img-thumbnail" src="<?php echo base_url() ?>uploads/<?php echo $up->UPLOADS_FILE; ?>">
		</div>
		<?php } ?>
	</div>
</div>