		<?php echo $__sidebar; ?>

	    <!-- Page Content  -->
	    <div id="content">

	        <?php echo $__header; ?>
	        <div class="card">
	        	<div class="card-body">
			    	<div class="row">
			    		<div class="col-12">
			    		  	<h4 class="text-primary"><b><i class="icon icon-tag"></i> HARGA HEWAN QURBAN</b></h4>
			    		</div>
			    	</div>
			   	 	<form>
			    	<div class="row">
			    		<div class="col-md-8">
			    			<div class="btn-group">
								<a href="<?php echo base_url() ?>admin/hewan/semua" class="btn btn-<?php echo ( $this->uri->segment(3) == '' OR $this->uri->segment(3) == 'semua' )? 'primary' : 'light'; ?>">Semua</a>
								<a href="<?php echo base_url() ?>admin/hewan/tampil" class="btn btn-<?php echo ( $this->uri->segment(3) == 'tampil' )? 'primary' : 'light'; ?>">Tampil</a>
								<a href="<?php echo base_url() ?>admin/hewan/sembunyi" class="btn btn-<?php echo ( $this->uri->segment(3) == 'sembunyi' )? 'primary' : 'light'; ?>">Sembunyi</a>
							</div>			
						</div>
			    	</div>

			    	<div class="row">
						<div class="col-md-8">
							<div class="btn-group">
								<a href="<?php echo base_url() ?>admin/hewanTambah" class="btn btn-primary"><i class="icon icon-plus"></i> Tambah Data</a>
								<button type="submit" formaction="<?php echo base_url() ?>admin/hewan__status/sembunyi" formmethod="POST" class="btn btn-danger"><i class="icon icon-close"></i> Sembunyikan Terpilih</button>
								<button type="submit" formaction="<?php echo base_url() ?>admin/hewan__status/tampil" formmethod="POST" class="btn btn-success"><i class="icon icon-check"></i> Tampilkan Terpilih</button>
							</div>
						</div>
						<div class="col-md-4">
							<div class="input-group">
								<select class="form-control" name="KOLOM"> 
									<option value="HEWAN_NAMA">Nama</option>
									<option value="HEWAN_HARGA">Harga</option>
									<option value="HEWAN_BERAT">Berat</option>
								</select>
								<input type="text" class="form-control" placeholder="Enter keyword" name="keyword">
								<span class="input-group-btn">
									<button class="btn btn-secondary" type="submit" formaction="<?php echo base_url() ?>admin/hewan/<?php echo $this->uri->segment(3); ?>" formmethod="POST"><i class="icon icon-magnifier"></i> Cari</button>
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
					  	        			<th><input id="checkAll" type="checkbox"></th>
					  	        			<th>No</th>
					  	        			<th>Nama</th>
					  	        			<th>Harga</th>
					  	        			<th>Berat</th>
					  	        			<th>Urut</th>
					  	        			<th>Tampil/Sembunyi</th>
					  	        			<th>Opsi</th>
					  	        		</tr>
					  	        	</thead>
					  	        	<tbody>
					  	        		<?php $no = 1; ?>
					  	        		<?php foreach ($query_hewan->result() as $hew) { ?>
					  	        		<tr>
					  	        			<td><input type="checkbox" name="pilih[]" value="<?php echo $hew->HEWAN_ID; ?>"></td>
					  	        			<td><?php echo $no++; ?></td>
					  	        			<td><?php echo $hew->HEWAN_NAMA; ?></td>
					  	        			<td><?php echo __rp($hew->HEWAN_HARGA); ?></td>
					  	        			<td><?php echo $hew->HEWAN_BERAT; ?></td>
					  	        			<td><?php echo $hew->HEWAN_URUT; ?></td>
					  	        			<td><span class="badge badge-<?php echo ( $hew->HEWAN_STATUS == 'SEMBUNYI' )? 'danger' : 'success' ?>"><?php echo $hew->HEWAN_STATUS; ?></span></td>
					  	        			<td>
					  	        				<?php if( $this->db->where('HEWAN_ID', $hew->HEWAN_ID)->get('KERANJANG')->num_rows() == 0 ){ ?>
						  	        				<a href="<?php echo base_url() ?>admin/hewanEdit/<?php echo $hew->HEWAN_ID; ?>" class="btn btn-primary"><i class="icon icon-pencil"></i> Edit</a>
						  	        			<?php }else{ ?>
						  	        				<button class="btn btn-primary" disabled=""><i class="icon icon-pencil"></i> Edit</button>
						  	        			<?php } ?>
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