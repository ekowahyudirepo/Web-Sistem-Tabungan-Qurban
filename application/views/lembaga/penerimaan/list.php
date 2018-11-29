        <?php echo $__sidebar; ?>

        <!-- Page Content  -->
        <div id="content">
          <?php echo $__header; ?>

          <form>
          	<div class="row">
          		<div class="col-lg-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title text-primary"><b>DATA PENERIMAAN</b></h4>
                      <div class="row">
                      	<div class="col-lg-8">
              						<div class="btn-group">
              							<a href="<?php echo base_url() ?>lembaga/penerimaan/semua" class="btn btn-<?php echo ( $this->uri->segment(3) == '' OR $this->uri->segment(3) == 'semua' )? 'primary' : 'light'; ?>">Semua</a>
              							<a href="<?php echo base_url() ?>lembaga/penerimaan/proses" class="btn btn-<?php echo ( $this->uri->segment(3) == 'proses' )? 'primary' : 'light'; ?>">Proses</a>
              							<a href="<?php echo base_url() ?>lembaga/penerimaan/terima" class="btn btn-<?php echo ( $this->uri->segment(3) == 'terima' )? 'primary' : 'light'; ?>">Terima</a>
              						</div>
              					</div>
              					<div class="col-lg-4">
              						<div class="form-group">
                                      <div class="input-group">
                                        <select class="form-control" name="KOLOM"> 
              							<option value="MEMBER.MEMBER_NAMA">Nama</option>
              							<option value="NOTA.NOTA_NO">No Nota</option>
              						  </select>
                                        <input type="text" class="form-control" placeholder="Enter keyword" name="keyword">
                                        <div class="input-group-append">
                                          <button class="btn btn-secondary" type="submit" formaction="<?php echo base_url() ?>lembaga/penerimaan/<?php echo $this->uri->segment(3); ?>" formmethod="POST"><i class="mdi mdi-magnify"></i> Cari</button>
                                        </div>
                                      </div>
                                    </div>
              						<div class="input-group">
              							
              							
              							<span class="input-group-btn">
              								
              							</span>
              						</div>
              					</div>
                      </div>
                      <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                          	<tr>
          	  	        			<th>No</th>
          	  	        			<th>Tanggal</th>
          	  	        			<th>Nota</th>
          	  	        			<th>Nama</th>
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
          	  	        			<td><span class="badge badge-<?php echo ( $not->NOTA_STATUS == 'PENDING' )? 'danger' : 'success' ?>"><?php echo $not->NOTA_STATUS; ?></span></td>
          	  	        			<td>
          	  	        				<a href="<?php echo base_url() ?>lembaga/penerimaanDetail/<?php echo $not->NOTA_ID; ?>" class="btn btn-primary"><i class="icon icon-eye"></i> Detail</a>
          	  	        			</td>
          	  	        		</tr>
          	  	        		<?php  } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
          	</div>
          </form>
        </div>
    </div>
  </body>
</html>