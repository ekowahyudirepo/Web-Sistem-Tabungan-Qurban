			<?php echo $__sidebar; ?>

		    <!-- Page Content  -->
		    <div id="content">

		        <?php echo $__header; ?>
		        
		        <div class="card">
	        		<div class="card-body">
				    	<div class="row">
				    		<div class="col-12">
				    		  	<h4 class="text-primary"><b><i class="icon icon-bag"></i> NOTA MEMBER</b></h4>
				    		</div>
				    	</div>
				    	<form>
				    	<div class="row">
							<div class="col-md-8">
								<div class="btn-group">
									<a href="<?php echo base_url() ?>admin/pembelian/semua" class="btn btn-<?php echo ( $this->uri->segment(3) == '' OR $this->uri->segment(3) == 'semua' )? 'primary' : 'light'; ?>">Semua</a>
									<a href="<?php echo base_url() ?>admin/pembelian/proses" class="btn btn-<?php echo ( $this->uri->segment(3) == 'proses' )? 'primary' : 'light'; ?>">Proses</a>
									<a href="<?php echo base_url() ?>admin/pembelian/terima" class="btn btn-<?php echo ( $this->uri->segment(3) == 'terima' )? 'primary' : 'light'; ?>">Terima</a>
								</div>
							</div>
							<div class="col-md-4">
								<div class="input-group">
									<select class="form-control" name="KOLOM"> 
										<option value="MEMBER.MEMBER_NAMA">Nama</option>
										<option value="LEMBAGA.LEMBAGA_NAMA">Lembaga</option>
										<option value="NOTA.NOTA_NO">No. Nota</option>
										<option value="NOTA.NOTA_TOTAL">Total</option>
									</select>
									<input type="text" class="form-control" placeholder="Enter keyword" name="keyword">
									<span class="input-group-btn">
										<button class="btn btn-secondary" type="submit" formaction="<?php echo base_url() ?>admin/pembelian/<?php echo $this->uri->segment(3); ?>" formmethod="POST"><i class="icon icon-magnifier"></i> Cari</button>
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
						  	        			<th>Nota</th>
						  	        			<th>Nama</th>
						  	        			<th>Penerima</th>
						  	        			<th>Total</th>
						  	        			<th>Status</th>
						  	        			<th>Opsi</th>
						  	        		</tr>
						  	        	</thead>
						  	        	<tbody>
						  	        		<?php $no = 1; ?>
						  	        		<?php foreach ($query_nota->result() as $not) { ?>
						  	        		<tr>
						  	        			<td><?php echo $no++; ?></td>
						  	        			<td><?php echo __tgl_dmy($not->NOTA_ADD); ?></td>
						  	        			<td><?php echo $not->NOTA_NO; ?></td>
						  	        			<td><?php echo $not->MEMBER_NAMA; ?></td>
						  	        			<td><?php echo $not->LEMBAGA_NAMA; ?></td>
						  	        			<td align="right"><?php echo __rp($not->NOTA_TOTAL); ?></td>
						  	        			<td><span class="badge badge-<?php echo ( $not->NOTA_STATUS == 'PENDING' )? 'danger' : 'success' ?>"><?php echo $not->NOTA_STATUS; ?></span></td>
						  	        			<td>
						  	        				<a href="<?php echo base_url() ?>admin/pembelianDetail/<?php echo $not->NOTA_ID; ?>" class="btn btn-primary"><i class="icon icon-eye"></i> Detail</a>
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