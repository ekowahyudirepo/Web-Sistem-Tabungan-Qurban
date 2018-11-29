		<?php echo $__sidebar; ?>

	    <!-- Page Content  -->
	    <div id="content">

	        <?php echo $__header; ?>
	        
	        <div class="card">
	        	<div class="card-body">
			    	<div class="row">
			    		<div class="col-12">
			    		  	<h4 class="text-primary"><b><i class="icon icon-wallet"></i> TABUNGAN MEMBER</b></h4>
			    		</div>
			    	</div>
			    	<form>
			    	<div class="row">
						<div class="col-md-8">
							<div class="btn-group">
								<a href="<?php echo base_url() ?>admin/tabungan/semua" class="btn btn-<?php echo ( $this->uri->segment(3) == '' OR $this->uri->segment(3) == 'semua' )? 'primary' : 'light'; ?>">Semua</a>
								<a href="<?php echo base_url() ?>admin/tabungan/proses" class="btn btn-<?php echo ( $this->uri->segment(3) == 'proses' )? 'primary' : 'light'; ?>">Proses</a>
								<a href="<?php echo base_url() ?>admin/tabungan/terima" class="btn btn-<?php echo ( $this->uri->segment(3) == 'terima' )? 'primary' : 'light'; ?>">Terima</a>
								<a href="<?php echo base_url() ?>admin/tabungan/tolak" class="btn btn-<?php echo ( $this->uri->segment(3) == 'tolak' )? 'primary' : 'light'; ?>">Tolak</a>
							</div>
						</div>
						<div class="col-md-4">
							<div class="input-group">
								<select class="form-control" name="KOLOM"> 
									<option value="MEMBER.MEMBER_NAMA">Nama</option>
									<option value="REKENING.REKENING_NAMA">Tujuan Bank</option>
									<option value="TABUNGAN.TABUNGAN_NOMINAL">Nominal</option>
									<option value="TABUNGAN.TABUNGAN_TGL">Tanggal Trasnfer</option>
								</select>
								<input type="text" class="form-control" placeholder="Enter keyword" name="keyword">
								<span class="input-group-btn">
									<button class="btn btn-secondary" type="submit" formaction="<?php echo base_url() ?>admin/tabungan/<?php echo $this->uri->segment(3); ?>" formmethod="POST"><i class="icon icon-magnifier"></i> Cari</button>
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
					  	        			<th>Tanggal Tambah</th>
					  	        			<th>Nama</th>
					  	        			<th>Tujuan Bank</th>
					  	        			<th>Nominal</th>
					  	        			<th>Tanggal Transfer</th>
					  	        			<th>Status</th>
					  	        			<th>Opsi</th>
					  	        		</tr>
					  	        	</thead>
					  	        	<tbody>
					  	        		<?php $no = 1; ?>
					  	        		<?php foreach ($query_tabungan->result() as $tab) { ?>
					  	        		<tr>
					  	        			<td><?php echo $no++; ?></td>
					  	        			<td><?php echo __tgl_full($tab->TABUNGAN_ADD); ?></td>
					  	        			<td><?php echo $tab->MEMBER_NAMA; ?></td>
					  	        			<td><?php echo $tab->REKENING_NAMA; ?></td>
					  	        			<td align="right"><?php echo __rp($tab->TABUNGAN_NOMINAL); ?></td>
					  	        			<td><?php echo __tgl_dmy($tab->TABUNGAN_TGL); ?></td>
					  	        			<td><span class="badge badge-<?php echo ( $tab->TABUNGAN_STATUS == 'PENDING' )? 'danger' : 'success' ?>"><?php echo $tab->TABUNGAN_STATUS; ?></span></td>
					  	        			<td>
					  	        				<a href="<?php echo base_url() ?>admin/tabunganDetail/<?php echo $tab->TABUNGAN_ID; ?>" class="btn btn-primary"><i class="icon icon-eye"></i> Detail</a>
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
	    </div>
	</div>
	</body>
</html>