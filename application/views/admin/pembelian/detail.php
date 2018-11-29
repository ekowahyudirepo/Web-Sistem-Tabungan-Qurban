<?php $not = $query_nota->row() ?>
<?php echo $__sidebar; ?>

    <!-- Page Content  -->
    <div id="content">

        <?php echo $__header; ?>
        <div class="card">
        	<div class="card-body">
		    	<div class="row">
		    		<div class="col-12">
		    		  	<h4 class="text-primary"><b><i class="icon icon-bag"></i> DETAIL NOTA MEMBER</b></h4>
		    		</div>
		    	</div>   	
				<div class="row">
					<div class="col-md-6">
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
								<th>Tanggal</th>
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
					<div class="col-md-6">
						<table class="table table-bordered">
							<tr>
								<th>No</th>
								<th>Nama</th>
								<th>Harga</th>
								<th>QTY</th>
								<th>Sub Total</th>
							</tr>
							<?php 
							$no = 1;
							$total = 0;
							$keranjang = $this->db
							->join('HEWAN', 'HEWAN.HEWAN_ID = KERANJANG.HEWAN_ID', 'left')
							->where('NOTA_NO', $not->NOTA_NO)
							->get('KERANJANG');
							foreach( $keranjang->result() as $ker ){ ?>
							<tr>
								<?php $total += $ker->HEWAN_HARGA * $ker->KERANJANG_QTY; 
								?>
								<td><?php echo $no++; ?></td>
								<td><?php echo $ker->HEWAN_NAMA; ?></td>
								<td><?php echo __rp($ker->HEWAN_HARGA); ?></td>
								<td><?php echo $ker->KERANJANG_QTY; ?></td>
								<td align="right"><?php echo __rp($ker->HEWAN_HARGA * $ker->KERANJANG_QTY); ?></td>
							</tr>
							<?php } ?>
							<tr>
								<td colspan="4" align="center">Total</td>
								<td align="right"><?php echo __rp($total); ?></td>
							</tr>
						</table>
					</div>
				</div>
				<div class="row foto">
					<div class="col-md-6">
						<?php if(file_exists(FCPATH.'/uploads/lembaga/bukti/'.$not->NOTA_GMB1.'')){ ?>
						<img src="<?php echo base_url() ?>uploads/lembaga/bukti/<?php echo $not->NOTA_GMB1; ?>" class="img-fluid btn-overlay" alt="foto ke-1">
						<?php }else{ ?>
						<span class="badge badge-info">File telah dihapus</span>
						<?php } ?>
					</div>
					<div class="col-md-6">
						<?php if(file_exists(FCPATH.'/uploads/lembaga/bukti/'.$not->NOTA_GMB2.'')){ ?>
						<img src="<?php echo base_url() ?>uploads/lembaga/bukti/<?php echo $not->NOTA_GMB2; ?>" class="img-fluid btn-overlay" alt="foto ke-2">
						<?php }else{ ?>
						<span class="badge badge-info">File telah dihapus</span>
						<?php } ?>
					</div>
				</div>
				<div class="row foto">
					<div class="col-md-6">
						<?php if(file_exists(FCPATH.'/uploads/lembaga/bukti/'.$not->NOTA_GMB3.'')){ ?>
						<img src="<?php echo base_url() ?>uploads/lembaga/bukti/<?php echo $not->NOTA_GMB3; ?>" class="img-fluid btn-overlay" alt="foto ke-3">
						<?php }else{ ?>
						<span class="badge badge-info">File telah dihapus</span>
						<?php } ?>
					</div>
					<div class="col-md-6">
						<?php if(file_exists(FCPATH.'/uploads/lembaga/bukti/'.$not->NOTA_GMB4.'')){ ?>
						<img src="<?php echo base_url() ?>uploads/lembaga/bukti/<?php echo $not->NOTA_GMB4; ?>" class="img-fluid btn-overlay" alt="foto ke-4">
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

	<?php 
		echo __js('jquery'); 
		echo __js('checkall'); 
		echo __js('__checkall'); 
		echo __js('bootstrap'); 
		echo __js('back'); 
	?>
	<script>
	 	jQuery(document).ready(function($) {
	 		var el ,
	 			overlay = $('.overlay');
	 			img     = $('.overlay img');
	 			unduh   = $('.overlay a.unduh');

	 		$('.foto img').click(function(){
	 			el = $(this).attr('src');

	 			overlay.slideDown('slow', function() {
	 				unduh.attr('href', el);
	 				img.attr('src', el);

	 			});
	 		})

	 		$('.overlay a.tutup').click(function(e) {
	 			/* Act on the event */
	 			e.preventDefault();
	 			overlay.slideUp('slow', function() {
	 				
	 			});
	 		});
	 	});
	</script>
	</body>
</html>