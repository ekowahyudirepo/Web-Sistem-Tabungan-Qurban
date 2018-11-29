		<?php $mem = $query_mem->row() ?>
		<?php echo $__sidebar; ?>

	    <!-- Page Content  -->
	    <div id="content">

	        <?php echo $__header; ?>
	        <div class="card">
	        	<div class="card-body">
			    	<div class="row">
			    		<div class="col-12">
			    		  	<h4 class="text-primary" style="display: inline-block;"><b><i class="icon icon-user"></i> DETAIL IDENTITAS MEMBER</b></h4>
			    		</div>
			    	</div>
			    	
					<div class="row">
						<div class="col-md-6">
							<table class="table table-bordered">
								<tr>
									<th>Status Validasi</th>
									<td>
										<?php if($mem->MEMBER_STATUS == 'BARU'){ ?>
						    		  	<a href="<?php echo base_url() ?>admin/memberValidasi/<?php echo $mem->MEMBER_ID; ?>" class="btn btn-primary btn-sm">Validasi Identitas</a>
						    		  	<span class="badge badge-danger">Belum di Validasi</span>
							    		<?php }else{ ?>
							    		<span class="badge badge-success">Telah di Validasi</span>
							    		<?php } ?>
									</td>
								</tr>
								<tr>
									<th>NIK</th>
									<td><?php echo $mem->MEMBER_NIK; ?></td>
								</tr>
								<tr>
									<th>Nama</th>
									<td><?php echo $mem->MEMBER_NAMA; ?></td>
								</tr>
								<tr>
									<th>Jenis Kelamin</th>
									<td><?php echo $mem->MEMBER_JK; ?></td>
								</tr>
								<tr>
									<th>HP</th>
									<td><?php echo $mem->MEMBER_HP; ?></td>
								</tr>
								<tr>
									<th>Alamat</th>
									<td><?php echo $mem->MEMBER_DUSUN.' - '.$mem->MEMBER_DESA.' - '.$mem->MEMBER_KECAMATAN.' - '.$mem->MEMBER_KABUPATEN.' - '.$mem->MEMBER_PROVINSI.''; ?></td>
								</tr>
								<tr>
									<th>Bank</th>
									<td><?php echo $mem->MEMBER_BANK; ?></td>
								</tr>
								<tr>
									<th>No Rekening</th>
									<td><?php echo $mem->MEMBER_NO_REK; ?></td>
								</tr>
								<tr>
									<th>Atas Nama Rek.</th>
									<td><?php echo $mem->MEMBER_AN_REK; ?></td>
								</tr>
								<tr>
									<th>Tanggal Daftar</th>
									<td><?php echo __tgl_full($mem->MEMBER_ADD); ?></td>
								</tr>
								<tr>
									<th>Deposito</th>
									<td>
										<?php 
										$deposito = $this->M__tabungan->saldo($mem->MEMBER_ID);
										echo __rp($deposito); 
										?>
										<a href="<?php echo base_url() ?>admin/memberTabungan/<?php echo $mem->MEMBER_ID; ?>" class="btn btn-light">Lihat Detail</a>
									</td>
								</tr>
							</table>
						</div>
						<div class="col-md-6">
							<label>Foto Profil</label>
							<br>
							<img src="<?php echo base_url() ?>uploads/not.jpg" class="rounded-circle" style="width: 200px;">
						</div>
					</div>
				</div>
			</div>
	    </div>
	</div>
	</body>
</html>