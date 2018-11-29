		<?php echo $__sidebar; ?>

	    <!-- Page Content  -->
	    <div id="content">

	        <?php echo $__header; ?>

	        <div class="card">
	        	<div class="card-body">
			    	<div class="row">
			    		<div class="col-12">
			    		  	<h4 class="text-primary"><b><i class="icon icon-credit-card"> </i> REKENING</b></h4>
			    		</div>
			    	</div>
			    	<form>
			    	<div class="row">
			    		<div class="col-md-8">
			    			<div class="btn-group">
								<a href="<?php echo base_url() ?>admin/rekening/semua" class="btn btn-<?php echo ( $this->uri->segment(3) == '' OR $this->uri->segment(3) == 'semua' )? 'primary' : 'light'; ?>">Semua</a>
								<a href="<?php echo base_url() ?>admin/rekening/tampil" class="btn btn-<?php echo ( $this->uri->segment(3) == 'tampil' )? 'primary' : 'light'; ?>">Tampil</a>
								<a href="<?php echo base_url() ?>admin/rekening/sembunyi" class="btn btn-<?php echo ( $this->uri->segment(3) == 'sembunyi' )? 'primary' : 'light'; ?>">Sembunyi</a>
							</div>		
						</div>
			    	</div>
			    	<div class="row">
						<div class="col-md-8">
							<div class="btn-group">
								<a href="<?php echo base_url() ?>admin/rekeningTambah" class="btn btn-primary"><i class="icon icon-plus"></i> Tambah Data</a>
								<button type="submit" formaction="<?php echo base_url() ?>admin/rekening__status/sembunyi" formmethod="POST" class="btn btn-danger"><i class="icon icon-close"></i> Sembunyikan Terpilih</button>
								<button type="submit" formaction="<?php echo base_url() ?>admin/rekening__status/tampil" formmethod="POST" class="btn btn-success"><i class="icon icon-check"></i> Tampilkan Terpilih</button>
							</div>
						</div>
						<div class="col-md-4">
							<div class="input-group">
								<select class="form-control" name="KOLOM"> 
									<option value="REKENING_NAMA">Nama</option>
									<option value="REKENING_NO">NO</option>
									<option value="REKENING_AN">AN</option>
								</select>
								<input type="text" class="form-control" placeholder="Enter keyword" name="keyword">
								<span class="input-group-btn">
									<button class="btn btn-secondary" type="submit" formaction="<?php echo base_url() ?>admin/rekening/<?php echo $this->uri->segment(3); ?>" formmethod="POST"><i class="icon icon-magnifier"></i> Cari</button>
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
					  	        			<th>NO</th>
					  	        			<th>AN</th>
					  	        			<th>Tampil/Sembunyi</th>
					  	        			<th>Opsi</th>
					  	        		</tr>
					  	        	</thead>
					  	        	<tbody>
					  	        		<?php $no = 1; ?>
					  	        		<?php foreach ($query_rekening->result() as $rek) { ?>
					  	        		<tr>
					  	        			<td><input type="checkbox" name="pilih[]" value="<?php echo $rek->REKENING_ID; ?>"></td>
					  	        			<td><?php echo $no++; ?></td>
					  	        			<td><?php echo $rek->REKENING_NAMA; ?></td>
					  	        			<td><?php echo $rek->REKENING_NO; ?></td>
					  	        			<td><?php echo $rek->REKENING_AN; ?></td>
					  	        			<td><span class="badge badge-<?php echo ( $rek->REKENING_STATUS == 'SEMBUNYI' )? 'danger' : 'success' ?>"><?php echo $rek->REKENING_STATUS; ?></span></td>
					  	        			<td>
					  	        				<a href="<?php echo base_url() ?>admin/rekeningEdit/<?php echo $rek->REKENING_ID; ?>" class="btn btn-primary"><i class="icon icon-pencil"></i> Edit</a>
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