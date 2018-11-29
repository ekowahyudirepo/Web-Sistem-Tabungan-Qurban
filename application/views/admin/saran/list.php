		<?php echo $__sidebar; ?>

	    <!-- Page Content  -->
	    <div id="content">

	        <?php echo $__header; ?>

	        <div class="card">
	        	<div class="card-body">
			    	<div class="row">
			    		<div class="col-12">
			    		  	<h4 class="text-primary"><b><i class="icon icon-envelope-letter"></i> SARAN PENGGUNA</b></h4>
			    		</div>
			    	</div>
			    	<form>
			    	<div class="row">
						<div class="col-md-8">
							<div class="btn-group">
								<a href="<?php echo base_url() ?>admin/saran/semua" class="btn btn-<?php echo ( $this->uri->segment(3) == '' OR $this->uri->segment(3) == 'semua' )? 'primary' : 'light'; ?>">Semua Saran</a>
								<a href="<?php echo base_url() ?>admin/saran/baru" class="btn btn-<?php echo ( $this->uri->segment(3) == 'baru' )? 'primary' : 'light'; ?>">Belum di baca</a>
								<a href="<?php echo base_url() ?>admin/saran/sudah" class="btn btn-<?php echo ( $this->uri->segment(3) == 'sudah' )? 'primary' : 'light'; ?>">Sudah di baca</a>
							</div>
						</div>
						<div class="col-md-4">
							<div class="input-group">
								<select class="form-control" name="KOLOM"> 
									<option value="SARAN_NAMA">Nama</option>
									<option value="SARAN_EMAIL">Email</option>
									<option value="SARAN_ISI">Isi</option>
								</select>
								<input type="text" class="form-control" placeholder="keyword..." name="keyword">
								<span class="input-group-btn">
									<button class="btn btn-secondary" type="submit" formaction="<?php echo base_url() ?>admin/saran/<?php echo $this->uri->segment(3); ?>" formmethod="POST"><i class="icon icon-magnifier"></i> Cari</button>
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
					  	        			<th>Nama</th>
					  	        			<th>Email</th>
					  	        			<th>Isi</th>
					  	        			<th>Status</th>
					  	        			<th>Opsi</th>
					  	        		</tr>
					  	        	</thead>
					  	        	<tbody>
					  	        		<?php $no = 1; ?>
					  	        		<?php foreach ($query_saran->result() as $sar) { ?>
					  	        		<tr>
					  	        			<td><?php echo $no++; ?></td>
					  	        			<td><?php echo $sar->SARAN_NAMA; ?></td>
					  	        			<td><?php echo $sar->SARAN_EMAIL; ?></td>
					  	        			<td><?php echo $sar->SARAN_ISI; ?></td>
					  	        			<td><span class="badge badge-<?php echo ( $sar->SARAN_STATUS == 'BELUM' )? 'danger' : 'success' ?>"><?php echo $sar->SARAN_STATUS; ?></span></td>
					  	        			<td>
					  	        				<a href="<?php echo base_url() ?>admin/saranBaca/<?php echo $sar->SARAN_ID; ?>" class="btn btn-primary"><i class="icon icon-eye"></i> Baca</a>
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