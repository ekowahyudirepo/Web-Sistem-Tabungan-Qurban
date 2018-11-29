	<?php echo $__sidebar; ?>

    <!-- Page Content  -->
    <div id="content">

        <?php echo $__header; ?>

        <div class="card">
        	<div class="card-body">
		    	<div class="row">
		    		<div class="col-12">
		    		  	<h4 class="text-primary"><b><i class="icon icon-layers"></i> SLIDER</b></h4>
		    		</div>
		    	</div>
		        <form>
		    	<div class="row">
		    		<div class="col-md-8">
		    			<div class="btn-group">
							<a href="<?php echo base_url() ?>admin/slider/semua" class="btn btn-<?php echo ( $this->uri->segment(3) == '' OR $this->uri->segment(3) == 'semua' )? 'primary' : 'light'; ?>">Semua</a>
							<a href="<?php echo base_url() ?>admin/slider/tampil" class="btn btn-<?php echo ( $this->uri->segment(3) == 'tampil' )? 'primary' : 'light'; ?>">Tampil</a>
							<a href="<?php echo base_url() ?>admin/slider/sembunyi" class="btn btn-<?php echo ( $this->uri->segment(3) == 'sembunyi' )? 'primary' : 'light'; ?>">Sembunyi</a>
						</div>			
					</div>
		    	</div>
		    	<div class="row">
					<div class="col-md-8">
						<div class="btn-group">
							<a href="<?php echo base_url() ?>admin/sliderTambah" class="btn btn-primary"><i class="icon icon-plus"></i> Tambah Data</a>
							<button type="submit" formaction="<?php echo base_url() ?>admin/slider__status/sembunyi" formmethod="POST" class="btn btn-danger"><i class="icon icon-close"></i> Sembunyikan Terpilih</button>
							<button type="submit" formaction="<?php echo base_url() ?>admin/slider__status/tampil" formmethod="POST" class="btn btn-success"><i class="icon icon-check"></i> Tampilkan Terpilih</button>
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group">
							<select class="form-control" name="KOLOM"> 
								<option value="SLIDER_LINK">LINK</option>
							</select>
							<input type="text" class="form-control" placeholder="Enter keyword" name="keyword">
							<span class="input-group-btn">
								<button class="btn btn-secondary" type="submit" formaction="<?php echo base_url() ?>admin/slider/<?php echo $this->uri->segment(3); ?>" formmethod="POST"><i class="icon icon-magnifier"></i> Cari</button>
							</span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive"> 
				  	        <table class="table table-hover" style="width: 100%">
				  	        	<thead>
				  	        		<tr>
				  	        			<th><input id="checkAll" type="checkbox"></th>
				  	        			<th>No</th>
				  	        			<th width="100px">Gambar</th>
				  	        			<th>Link</th>
				  	        			<th>Tampil/Sembunyi</th>
				  	        			<th>Tanggal</th>
				  	        			<th>Opsi</th>
				  	        		</tr>
				  	        	</thead>
				  	        	<tbody>
				  	        		<?php $no = 1; ?>
				  	        		<?php foreach ($query_slider->result() as $sli) { ?>
				  	        		<tr>
				  	        			<td><input type="checkbox" name="pilih[]" value="<?php echo $sli->SLIDER_ID; ?>"></td>
				  	        			<td><?php echo $no++; ?></td>
				  	        			<td class="foto"><img src="<?php echo base_url() ?>uploads/<?php echo $sli->SLIDER_GMB; ?>" class="img-fluid"></td>
				  	        			<td><?php echo $sli->SLIDER_LINK; ?></td>
				  	        			<td><span class="badge badge-<?php echo ( $sli->SLIDER_STATUS == 'SEMBUNYI' )? 'danger' : 'success' ?>"><?php echo $sli->SLIDER_STATUS; ?></span></td>
				  	        			<td><?php echo __tgl_full($sli->SLIDER_ADD); ?></td>
				  	        			<td>
				  	        				<a href="<?php echo base_url() ?>admin/sliderEdit/<?php echo $sli->SLIDER_ID; ?>" class="btn btn-primary"><i class="icon icon-pencil"></i> Edit</a>
				  	        			</td>
				  	        		</tr>
				  	        		<?php  } ?>
				  	        	</tbody>
				  	        </table>      
				  	        Menampilkan <?php echo $limit; ?> 
							dari <?php echo $total_rows; ?> data 
							<?php echo ( is_null($keyword))? '' : 'Dari pencarian : '. $keyword; ?>              

							<?php echo $paginasi; ?>           
				  	    </div>
					</div>
				</div>
				</form>
			</div>
		</div>

		<div class="overlay">
			<div class="overlay-btn">
				<a href="#" class="unduh" download=""><i class="icon icon-cloud-download"></i></a>
				<a href="#" class="tutup"><i class="icon icon-close"></i></a>
			</div>
			<div class="overlay-content">
				<img src="" class="img-fluid btn-overlay">
			</div>
		</div>
    </div>
</div>

	<script>
	 	jQuery(document).ready(function($) {
	 		var el ,
	 			overlay = $('.overlay');
	 			img     = $('.overlay img');
	 			unduh   = $('.overlay a.unduh');

	 		$(document).on('click', '.foto img', function(){
	 			el = $(this).attr('src');

	 			overlay.slideDown('slow', function() {
	 				unduh.attr('href', el);
	 				img.attr('src', el);

	 			});
	 		})

	 		$(document).on('click', '.overlay a.tutup',function(e) {
	 			/* Act on the event */
	 			e.preventDefault();
	 			overlay.slideUp('slow', function() {
	 				
	 			});
	 		});
	 	});
	</script>
	</body>
</html>