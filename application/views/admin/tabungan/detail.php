		<?php $tab = $query_tab->row() ?>
		<?php echo $__sidebar; ?>

	    <!-- Page Content  -->
	    <div id="content">

	        <?php echo $__header; ?>
	        
	        <div class="card">
	        	<div class="card-body">
			    	<div class="row">
			    		<div class="col-12">
			    		  	<h4 class="text-primary" style="display: inline-block;"><b><i class="icon icon-bag"></i> DETAIL TABUNGAN MEMBER</b></h4>

			    		  	<?php if($tab->TABUNGAN_STATUS == 'PROSES'){ ?>
			    		  	<a href="<?php echo base_url() ?>admin/tabunganValidasi/<?php echo $tab->TABUNGAN_ID; ?>" class="btn btn-primary float-right">Validasi Tabungan</a>
				    		<?php }else{ ?>
				    		<a href="#" class="btn btn-light disabled float-right">Telah di Validasi</a>
				    		<?php } ?>
			    		  	<div class="clearfix"></div>
			    		</div>
			    	</div>
			    	
					<div class="row">
						<div class="col-md-6">
							<table class="table table-bordered">
								<tr>
									<th>Akun</th>
									<td><?php 
											$member =  $this->db->where('MEMBER_ID', $tab->MEMBER_ID)->get('MEMBER')->row();
									 	?> 
									 	<i class="icon icon-user-follow"></i> <?php echo $member->MEMBER_NIK; ?><br>
									 	<i class="icon icon-user-follow"></i> <?php echo $member->MEMBER_NAMA; ?><br>
									 	<i class="icon icon-phone"></i> <?php echo $member->MEMBER_HP; ?><br>
									 	<hr>
									 	<i class="icon icon-credit-card"></i> <?php echo $member->MEMBER_BANK; ?><br>	
									 	<i class="icon icon-credit-card"></i> <?php echo $member->MEMBER_NO_REK; ?><br>	
									 	<i class="icon icon-credit-card"></i> <?php echo $member->MEMBER_AN_REK; ?><br>	
									</td>
								</tr>
								<tr>
									<th>Catatan</th>
									<td><?php echo $tab->TABUNGAN_CATATAN; ?></td>
								</tr>
								<tr>
									<th>Tanggal Tambah</th>
									<td><?php echo __tgl_full($tab->TABUNGAN_ADD); ?></td>
								</tr>
								<tr>
									<th>Tanggal Transfer</th>
									<td><?php echo __tgl_dmy($tab->TABUNGAN_TGL); ?></td>
								</tr>
								<tr>
									<th>Nominal</th>
									<td><?php echo __rp($tab->TABUNGAN_NOMINAL); ?>		
									 </td>
								</tr>
								<tr>
									<th>Status</th>
									<td><span class="badge badge-<?php echo ( $tab->TABUNGAN_STATUS == 'PENDING' )? 'danger' : 'success' ?>"><?php echo $tab->TABUNGAN_STATUS; ?></span></td>
								</tr>
							</table>
						</div>
						<div class="col-md-6">
							<?php if(file_exists(FCPATH.'/uploads/member/bukti/'.$tab->TABUNGAN_BUKTI.'')){ ?>
							<img src="<?php echo base_url() ?>uploads/member/bukti/<?php echo $tab->TABUNGAN_BUKTI; ?>" class="img-fluid btn-overlay" alt="foto ke-1">
							<?php }else{ ?>
							<span class="badge badge-info">File telah dihapus</span>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>


			<div class="overlay">
				<div class="overlay-btn">
					<a href="#" class="tutup"><i class="icon icon-close"></i></a>
				</div>
				<div class="overlay-content">
					<img src="" class="img-fluid">
				</div>
			</div>
	    </div>
	</div>

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

				overlay.slideDown('slow', function() {
					img.attr('src',''+base_url+'assets/AjaxLoader.gif');
					unduh.attr('href', el);
					img.attr('src', el);

				});
			})

			$(document).on('click', '.overlay a.tutup', function(e) {
				/* Act on the event */
				e.preventDefault();
				overlay.slideUp('slow', function() {
					
				});
			});
		});
	</script>

	</body>
</html>