	<?php echo $__sidebar; ?>

	    <!-- Page Content  -->
	    <div id="content">

	        <?php echo $__header; ?>
	        <div class="card">
	        	<div class="card-body">
			    	<div class="row">
			    		<div class="col-12">
			    		  	<h4 class="text-primary"><b><i class="icon icon-user-following"></i> LEMBAGA</b></h4>
			    		</div>
			    	</div>
			    	<form>
			    	<div class="row">
			    		<div class="col-md-8">
			    			<div class="btn-group">
								<a href="<?php echo base_url() ?>admin/lembaga/semua" class="btn btn-<?php echo ( $this->uri->segment(3) == '' OR $this->uri->segment(3) == 'semua' )? 'primary' : 'light'; ?>">Semua</a>
								<a href="<?php echo base_url() ?>admin/lembaga/tampil" class="btn btn-<?php echo ( $this->uri->segment(3) == 'tampil' )? 'primary' : 'light'; ?>">Tampil</a>
								<a href="<?php echo base_url() ?>admin/lembaga/sembunyi" class="btn btn-<?php echo ( $this->uri->segment(3) == 'sembunyi' )? 'primary' : 'light'; ?>">Sembunyi</a>	
							</div>		
						</div>
			    	</div>
			    	<div class="row">
						<div class="col-md-8">
							<div class="btn-group">
								<a href="<?php echo base_url() ?>admin/lembagaTambah" class="btn btn-primary"><i class="icon icon-plus"></i> Tambah Data</a>
								<button type="submit" formaction="<?php echo base_url() ?>admin/lembaga__status/sembunyi" formmethod="POST" class="btn btn-danger"><i class="icon icon-close"></i> Sembunyikan Terpilih</button>
								<button type="submit" formaction="<?php echo base_url() ?>admin/lembaga__status/tampil" formmethod="POST" class="btn btn-success"><i class="icon icon-check"></i> Tampilkan Terpilih</button>
							</div>
						</div>
						<div class="col-md-4">
							<div class="input-group">
								<select class="form-control" name="KOLOM"> 
									<option value="LEMBAGA_NAMA">Nama</option>
									<option value="LEMBAGA_HP">HP</option>
									<option value="LEMBAGA_EMAIL">Email</option>
									<option value="LEMBAGA_ALAMAT">Alamat</option>
								</select>
								<input type="text" class="form-control" placeholder="Enter Keyword" name="keyword">
								<span class="input-group-btn">
									<button class="btn btn-secondary" type="submit" formaction="<?php echo base_url() ?>admin/lembaga/<?php echo $this->uri->segment(3); ?>" formmethod="POST"><i class="icon icon-magnifier"></i> Cari</button>
								</span>
							</div>
						</div>
					</div>
					<div class="row" style="margin-top: 10px;">
						<div class="col-md-12">
							<div class="table-responsive"> 
					  	        <table class="table table-striped">
					  	        	<thead>
					  	        		<tr>
					  	        			<th><input id="checkAll" type="checkbox"></th>
					  	        			<th>No</th>
					  	        			<th>Nama</th>
					  	        			<th>HP</th>
					  	        			<th>Email</th>
					  	        			<th>Alamat</th>
					  	        			<th>Lat</th>
					  	        			<th>Long</th>
					  	        			<th>Tampil/Sembunyi</th>
					  	        			<th>Opsi</th>
					  	        		</tr>
					  	        	</thead>
					  	        	<tbody>
					  	        		<?php $no = 1; ?>
					  	        		<?php foreach ($query_lembaga->result() as $pen) { ?>
					  	        		<tr>
					  	        			<td><input type="checkbox" name="pilih[]" value="<?php echo $pen->LEMBAGA_ID; ?>"></td>
					  	        			<td><?php echo $no++; ?></td>
					  	        			<td><?php echo $pen->LEMBAGA_NAMA; ?></td>
					  	        			<td><?php echo $pen->LEMBAGA_HP; ?></td>
					  	        			<td><?php echo $pen->LEMBAGA_EMAIL; ?></td>
					  	        			<td><?php echo $pen->LEMBAGA_ALAMAT; ?></td>
					  	        			<td><?php echo $pen->LEMBAGA_LAT; ?></td>
					  	        			<td><?php echo $pen->LEMBAGA_LONG; ?></td>
					  	        			<td><span class="badge badge-<?php echo ( $pen->LEMBAGA_STATUS == 'SEMBUNYI' )? 'danger' : 'success' ?>"><?php echo $pen->LEMBAGA_STATUS; ?></span></td>
					  	        			<td>
					  	        				<a href="<?php echo base_url() ?>admin/lembagaEdit/<?php echo $pen->LEMBAGA_ID; ?>" class="btn btn-primary"><i class="icon icon-pencil"></i> Edit</a>
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