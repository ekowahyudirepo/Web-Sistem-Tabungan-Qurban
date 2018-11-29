	<?php echo $__sidebar; ?>

    <!-- Page Content  -->
    <div id="content">

        <?php echo $__header; ?>
        
        <div class="card">
        	<div class="card-body">
		    	<div class="row">
		    		<div class="col-12">
		    		  	<h4 class="text-primary"><b><i class="icon icon-plus"> </i> TAMBAH SLIDER</b></h4>
		    		</div>
		    	</div>

		    	<div class="row">
					<div class="col-md-6">
						<form action="<?php echo base_url() ?>admin/slider__add" method="POST">
							<fieldset class="form-group">
								<a href="#" id="foto" class="btn btn-success"><i class="icon icon-picture"></i> Tambah Gambar</a> 
								<label class="getFotoLabel"></label>
								<input type="hidden" class="form-control getFoto" placeholder="Enter Foto" name="GMB" required="">
							</fieldset>
							<fieldset class="form-group">
								<label>Link</label><span class="required">*</span>
								<input type="text" class="form-control" placeholder="Enter Link" name="LINK" required="" data-parsley-type="url">
							</fieldset>
							<button type="submit" class="btn btn-primary">Simpan</button>
							<a href="<?php echo base_url();?>admin/slider" class="btn btn-light">Kembali</a>
						</form>
					</div>
					<div class="col-md-6">
						<p>Perhatian</p>
						<span class="required">*</span> Harus diisi
					</div>
				</div>
			</div>
		</div>

		<div class="dropzone-overlay">
			<div class="overlay-btn">
				<a href="#" class="tutup"><i class="icon icon-close"></i></a>
			</div>
			<div class="container-fluid">
				<div style="padding: 20px;background-color: #ffffff;>
					<div class="row">
						<div class="col-md-12">
							<div class="dropzone" style="min-height: 500px;max-height: 500px;align-items: center;display: flex;justify-content: center;">
								<div class="dz-message">
									<h4><span class="icon icon-cloud-upload"></span><br/>Tarik file anda disini</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="overlay">
			<div class="overlay-btn">
				<a href="#" class="upload"><i class="icon icon-cloud-upload"></i></a>
				<a href="#" class="tutup"><i class="icon icon-close"></i></a>
			</div>
			<div class="container-fluid">
				
			</div>
		</div>
    </div>
</div>

	<script>
	 	jQuery(document).ready(function($) {
	 		$('form').parsley();

	 		var el ,
	 			overlay   = $('.overlay');
	 			dropzone  = $('.dropzone-overlay');
	 			container = $('.overlay .container-fluid');

	 		function file() {
	 			overlay.slideDown('slow', function() {
	 				$.ajax({
	 					url: '<?php echo base_url() ?>admin/file',
	 					type: 'GET',
	 					dataType: 'html',
	 				})
	 				.done(function(e) {
	 					container.html(e)
	 				})
	 				.fail(function() {
	 					console.log("error");
	 				})
	 				.always(function() {
	 					console.log("complete");
	 				});
	 			});
	 		}

	 		$(document).on('click', '#foto', function(e){
	 			e.preventDefault();
	 			file();
	 		})

	 		$(document).on('click', '.overlay a.tutup',function(e) {
	 			/* Act on the event */
	 			e.preventDefault();
	 			$(this).parent().parent().slideUp('slow');
	 		});

	 		$(document).on('click', '.dropzone-overlay a.tutup',function(e) {
	 			/* Act on the event */
	 			e.preventDefault();
	 			$(this).parent().parent().slideUp('slow');

	 			overlay.slideDown('slow', function() {
	 				file()
	 			});
	 		});

	 		$(document).on('click', '.overlay a.upload',function(e) {
	 			/* Act on the event */
	 			e.preventDefault();
	 			$(this).parent().parent().slideUp('slow');
	 			dropzone.slideDown('slow');
	 		});

	 		$(document).on('click', '.file img', function(){
	 			$('.getFotoLabel').html($(this).attr('name'))
	 			$('.getFoto').val($(this).attr('name'))
	 			overlay.slideUp('slow');
	 		})

	 		$(document).on('click', '.file a.hapusFile', function(){
	 			nameFile = $(this).attr('name');

	 			$.ajax({
					type:"GET",
					data:{ q : nameFile },
					url:"<?php echo site_url('admin/delete_files') ?>",
					cache:false,
					dataType: 'json',
					success: function(res){
						if (res==="ok") { alert("Berhasil menghapus") }else{ alert("Tidak ada File") }			
					}
				});

				file();
	 		})
	 	});
	</script>
	<script>
		Dropzone.autoDiscover = false;
		var nameFile;
		var file= new Dropzone(".dropzone",{
			url: "<?php echo site_url('admin/upload_files') ?>",
			method:"post",
		    paramName:"userfile",
		    maxFilesize: 2,
		    acceptedFiles:"image/*, video/*, audio/*, application/pdf, application/zip",
		    dictInvalidFileType:"Image files only allowed",
			addRemoveLinks:true,
			autoProcessQueue: true
		});
		//file.processQueue();
		file.on("sending",function(){});
		file.on("success", function(file, textResponse){
			nameFile = textResponse;
		});
		file.on("removedfile",function(file, textResponse){

			$.ajax({
				type:"GET",
				data:{ q : nameFile },
				url:"<?php echo site_url('admin/delete_files') ?>",
				cache:false,
				dataType: 'json',
				success: function(res){
					if (res==="ok") { alert("Berhasil menghapus") }else{ alert("Tidak ada File") }			
				}
			});
		});
	</script>
	</body>
</html>