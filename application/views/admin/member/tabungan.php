<?php echo $__sidebar; ?>

    <!-- Page Content  -->
    <div id="content">

        <?php echo $__header; ?>

        <div class="card">
	        <div class="card-body">
		    	<div class="row">
		    		<div class="col-12">
		    		  	<h4 class="text-primary"><b><i class="icon icon-note"></i> DETAIL TABUNGAN PEKURBAN</b></h4>
		    		</div>
		    	</div>
		    	<form>
		    	<div class="row">
					<div class="col-md-8">
						<div class="btn-group">
							<a href="<?php echo base_url() ?>admin/memberTabungan/<?php echo $this->uri->segment(3) ?>/semua" class="btn btn-<?php echo ( $this->uri->segment(4) == '' OR $this->uri->segment(4) == 'semua' )? 'primary' : 'light'; ?>">Semua</a>
							<a href="<?php echo base_url() ?>admin/memberTabungan/<?php echo $this->uri->segment(3) ?>/proses" class="btn btn-<?php echo ( $this->uri->segment(4) == 'proses' )? 'primary' : 'light'; ?>">Proses</a>
							<a href="<?php echo base_url() ?>admin/memberTabungan/<?php echo $this->uri->segment(3) ?>/terima" class="btn btn-<?php echo ( $this->uri->segment(4) == 'terima' )? 'primary' : 'light'; ?>">Terima</a>
							<a href="<?php echo base_url() ?>admin/memberTabungan/<?php echo $this->uri->segment(3) ?>/tolak" class="btn btn-<?php echo ( $this->uri->segment(4) == 'tolak' )? 'primary' : 'light'; ?>">Tolak</a>	
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group">
							<select class="form-control" name="KOLOM"> 
								<option value="TABUNGAN.TABUNGAN_TGL">Tanggal</option>
								<option value="TABUNGAN.TABUNGAN_NOMINAL">Nominal</option>
								<option value="TABUNGAN.TABUNGAN_CATATAN">Catatan</option>
							</select>
							<input type="text" class="form-control" placeholder="Enter keyword" name="keyword">
							<span class="input-group-btn">
								<button class="btn btn-secondary" type="submit" formaction="<?php echo base_url() ?>admin/memberTabungan/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(4); ?>" formmethod="POST"><i class="icon icon-magnifier"></i> Cari</button>
							</span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive"> 
				  	        <table class="table table-striped">
				  	        	<thead>
				  	        		<tr>
				  	        			<th>No</th>
				  	        			<th>Tanggal</th>
				  	        			<th>Nominal</th>
				  	        			<th>Bukti</th>
				  	        			<th>Catatan</th>
				  	        		</tr>
				  	        	</thead>
				  	        	<tbody>
				  	        		<?php $no = 1; ?>
			  	        		<?php foreach ($query_tabungan->result() as $tab) { ?>
			  	        		<tr>
			  	        			<td><?php echo $no++; ?></td>
			  	        			<td><?php echo __tgl_dmy($tab->TABUNGAN_TGL); ?></td>
			  	        			<td align="right"><?php echo __rp($tab->TABUNGAN_NOMINAL); ?></td>
			  	        			<td><a class="btn btn-light btn-overlay" src="<?php echo base_url() ?>uploads/member/bukti/<?php echo $tab->TABUNGAN_BUKTI; ?>"><i class="icon icon-picture"></i> Lihat</a></td>
			  	        			<td><?php echo $tab->TABUNGAN_CATATAN; ?></td>
			  	        		</tr>
			  	        		<?php } ?>
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
    </div>

    <div class="overlay">
		<div class="overlay-btn">
			<a href="#" download=""><i class="icon icon-cloud-download"></i></a>
			<a href="#" class="tutup"><i class="icon icon-close"></i></a>
		</div>
		<div class="overlay-content">
			<img src="" class="img-fluid">
		</div>
	</div>
</div>

	<?php 
		echo __js('jquery'); 
		echo __js('checkall'); 
		echo __js('__checkall'); 
		echo __js('bootstrap'); 
		echo __js('back'); 
	?>
	<script>
		$(function(){
			// variable
			const base_url = window.location.origin+'/ci__sitaqur/';

			// Halaman Pembelian Detail
			// Zoom Image
			var el ,
				overlay = $('.overlay');
				content = $('.overlay-content');
				img     = $('.overlay-content img');
				unduh   = $('.overlay-btn a.unduh');

				$(document).on('click', '.btn-overlay', function(e){
					/* Act on the event */
					e.preventDefault();

					el = $(this).attr('src');

					overlay.fadeIn('slow', function() {
						img.attr('src',''+base_url+'assets/AjaxLoader.gif');
						unduh.attr('href', el);
						img.attr('src', el);

					});
				})

				$(document).on('click', '.overlay a.tutup', function(e) {
					/* Act on the event */
					e.preventDefault();
					overlay.fadeOut('slow', function() {
						
					});
				});
			})
	</script>
	</body>
</html>