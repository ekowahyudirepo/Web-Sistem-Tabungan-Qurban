	<?php $not = $query_nota->row() ?>

	<?php echo $__sidebar; ?>

	    <!-- Page Content  -->
	    <div id="content">

	        <?php echo $__header; ?>

	        <div class="card">
	        	<div class="card-body">
			    	<div class="row">
			    		<div class="col-12">
							<h3 class="text-primary" style="display: inline-block;"><b><i class="icon icon-bag"></i> DETAIL NOTA MEMBER</b></h3>
			    		  	<?php if($not->NOTA_STATUS == 'PROSES'){ ?>
			    		  	<a href="<?php echo base_url() ?>lembaga/penerimaanKonfirmasi/<?php echo $not->NOTA_ID; ?>" class="btn btn-primary float-right">Konfirmasi Penerimaan</a>
				    		<?php }else{ ?>
				    		<a href="#" class="btn btn-light disabled float-right">Telah di Konfirmasi</a>
				    		<?php } ?>
			    		  	<div class="clearfix"></div>
			    		</div>
			    	</div>

					<div class="row" style="margin-top: 10px;">
						<div class="col-md-6">
							<div class="card">
			    				<div class="card-body">
									<table class="table table-bordered">
										<tr>
											<th>No Nota</th>
											<td><?php echo $not->NOTA_NO; ?></td>
										</tr>
										<tr>
											<th>Akun</th>
											<td><?php 
													$member =  $this->db->where('MEMBER_ID', $not->MEMBER_ID)->get('MEMBER')->row();
											 	?> 
											 	<i class="icon icon-user-follow"></i> <?php echo $member->MEMBER_NIK; ?><br>
											 	<i class="icon icon-user-follow"></i> <?php echo $member->MEMBER_NAMA; ?><br>
											 	<i class="icon icon-phone"></i> <?php echo $member->MEMBER_HP; ?><br>	
											</td>
										</tr>
										<tr>
											<th>Catatan</th>
											<td><?php echo $not->NOTA_CATATAN; ?></td>
										</tr>
										<tr>
											<th>Tanggal Tambah</th>
											<td><?php echo __tgl_dmy($not->NOTA_ADD); ?></td>
										</tr>
										<tr>
											<th>Tujuan</th>
											<td><?php 
													$pen =  $this->db->where('LEMBAGA_ID', $not->LEMBAGA_ID)->get('LEMBAGA')->row();
											 	?> 
											 	<i class="icon icon-user-follow"></i> <?php echo $pen->LEMBAGA_NAMA; ?><br>
											 	<i class="icon icon-phone"></i> <?php echo $pen->LEMBAGA_HP; ?><br>		
											 </td>
										</tr>
										<tr>
											<th>Status</th>
											<td><span class="badge badge-<?php echo ( $not->NOTA_STATUS == 'PENDING' )? 'danger' : 'success' ?>"><?php echo $not->NOTA_STATUS; ?></span></td>
										</tr>
										<tr>
											<th>Tanggal Konfirmasi</th>
											<td><?php echo ($not->NOTA_TGL_TERIMA == '0000-00-00')? 'Belum dikonfirmasi' : __tgl_dmy($not->NOTA_TGL_TERIMA); ?></td>
										</tr>
									</table>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
			    				<div class="card-body">
									<table class="table table-bordered">
										<tr>
											<th>No</th>
											<th>Nama</th>
											<th>QTY</th>
										</tr>
										<?php 
										$no = 1;
										$keranjang = $this->db
										->join('HEWAN', 'HEWAN.HEWAN_ID = KERANJANG.HEWAN_ID', 'left')
										->where('NOTA_NO', $not->NOTA_NO)
										->get('KERANJANG');
										foreach( $keranjang->result() as $ker ){ ?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td><?php echo $ker->HEWAN_NAMA; ?></td>
											<td><?php echo $ker->KERANJANG_QTY; ?></td>
										</tr>
										<?php } ?>
									</table>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">

							<?php if(file_exists(FCPATH.'/uploads/lembaga/bukti/'.$not->NOTA_GMB1.'')){ ?>
							<div class="img-thumbnail">
								<img src="<?php echo base_url() ?>uploads/lembaga/bukti/<?php echo $not->NOTA_GMB1; ?>" class="img-fluid btn-overlay" alt="foto ke-1">
							</div>
							<?php }else{ ?>
							<span class="badge badge-info">File telah dihapus</span>
							<?php } ?>
						</div>
						<div class="col-md-6">
							<?php if(file_exists(FCPATH.'/uploads/lembaga/bukti/'.$not->NOTA_GMB2.'')){ ?>
							<div class="img-thumbnail">
								<img src="<?php echo base_url() ?>uploads/lembaga/bukti/<?php echo $not->NOTA_GMB2; ?>" class="img-fluid btn-overlay" alt="foto ke-2">
							</div>
							<?php }else{ ?>
							<span class="badge badge-info">File telah dihapus</span>
							<?php } ?>
						</div>
					</div>
					<div class="row foto">
						<div class="col-md-6">
							<?php if(file_exists(FCPATH.'/uploads/lembaga/bukti/'.$not->NOTA_GMB3.'')){ ?>
							<div class="img-thumbnail">
								<img src="<?php echo base_url() ?>uploads/lembaga/bukti/<?php echo $not->NOTA_GMB3; ?>" class="img-fluid btn-overlay" alt="foto ke-3">
							</div>
							<?php }else{ ?>
							<span class="badge badge-info">File telah dihapus</span>
							<?php } ?>
						</div>
						<div class="col-md-6">
							<?php if(file_exists(FCPATH.'/uploads/lembaga/bukti/'.$not->NOTA_GMB4.'')){ ?>
							<div class="img-thumbnail">
								<img src="<?php echo base_url() ?>uploads/lembaga/bukti/<?php echo $not->NOTA_GMB4; ?>" class="img-fluid btn-overlay" alt="foto ke-4">
							</div>
							<?php }else{ ?>
							<span class="badge badge-info">File telah dihapus</span>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>

			<div class="overlay">
				<div class="overlay-btn">
					<a href="#" class="unduh" download=""><i class="icon icon-cloud-download"></i></a>
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