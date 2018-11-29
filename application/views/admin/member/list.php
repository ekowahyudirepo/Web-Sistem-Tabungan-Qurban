<?php echo $__sidebar; ?>

    <!-- Page Content  -->
    <div id="content">

        <?php echo $__header; ?>
        <div class="card">
	        <div class="card-body">
		    	<div class="row">
		    		<div class="col-12">
		    		  	<h4 class="text-primary"><b><i class="icon icon-user-follow"></i> SHOHIBBUL QURBAN</b></h4>
		    		</div>
		    	</div>
		    	<form>
		    	<div class="row">
		    		<div class="col-md-8">
		    			<div class="btn-group">
							<a href="<?php echo base_url() ?>admin/member/semua" class="btn btn-<?php echo ( $this->uri->segment(3) == '' OR $this->uri->segment(3) == 'semua' )? 'primary' : 'light'; ?>">Semua</a>
							<a href="<?php echo base_url() ?>admin/member/baru" class="btn btn-<?php echo ( $this->uri->segment(3) == 'baru' )? 'primary' : 'light'; ?>">Baru</a>
							<a href="<?php echo base_url() ?>admin/member/aktif" class="btn btn-<?php echo ( $this->uri->segment(3) == 'aktif' )? 'primary' : 'light'; ?>">Aktif</a>
							<a href="<?php echo base_url() ?>admin/member/blok" class="btn btn-<?php echo ( $this->uri->segment(3) == 'blok' )? 'primary' : 'light'; ?>">Blokir</a>	
						</div>		
					</div>
		    	</div>
		    	<div class="row">
					<div class="col-md-8">
						<div class="btn-group">
							<button type="submit" formaction="<?php echo base_url() ?>admin/member__status/blokir" formmethod="POST" class="btn btn-danger"><i class="icon icon-close"></i> Blok Terpilih</button>
							<button type="submit" formaction="<?php echo base_url() ?>admin/member__status/aktif" formmethod="POST" class="btn btn-success"><i class="icon icon-check"></i> Aktif Terpilih</button>
							<button type="submit" formaction="<?php echo base_url() ?>admin/member__status/baru" formmethod="POST" class="btn btn-info"><i class="icon icon-check"></i> Baru Terpilih</button>
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group">
							<select class="form-control" name="KOLOM"> 
								<option value="MEMBER_NIK">NIK</option>
								<option value="MEMBER_NAMA">Nama</option>
								<option value="MEMBER_HP">HP</option>
								<option value="MEMBER_EMAIL">Email</option>
								<option value="MEMBER_PROVINSI">Provinsi</option>
								<option value="MEMBER_KABUPATEN">Kabupaten</option>
								<option value="MEMBER_KECAMATAN">Kecamatan</option>
								<option value="MEMBER_DESA">Desa</option>
								<option value="MEMBER_DUSUN">Dusun</option>
							</select>
							<input type="text" class="form-control" placeholder="Enter keyword" name="keyword">
							<span class="input-group-btn">
								<button class="btn btn-secondary" type="submit" formaction="<?php echo base_url() ?>admin/member/<?php echo $this->uri->segment(3); ?>" formmethod="POST"><i class="icon icon-magnifier"></i> Cari</button>
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
				  	        			<th>NIK</th>
				  	        			<th>Nama</th>
				  	        			<th>HP</th>
				  	        			<th>Email</th>
				  	        			<th>Alamat</th>
				  	        			<th>Verifikasi</th>
				  	        			<th>Status</th>
				  	        			<th>Tanggal</th>
				  	        			<th>Opsi</th>
				  	        		</tr>
				  	        	</thead>
				  	        	<tbody>
				  	        		<?php $no = 1; ?>
				  	        		<?php foreach ($query_member->result() as $mem) { ?>
				  	        		<tr>
				  	        			<td><input type="checkbox" name="pilih[]" value="<?php echo $mem->MEMBER_ID; ?>"></td>
				  	        			<td><?php echo $no++; ?></td>
				  	        			<td><?php echo $mem->MEMBER_NIK; ?></td>
				  	        			<td><?php echo $mem->MEMBER_NAMA; ?></td>
				  	        			<td><?php echo $mem->MEMBER_HP; ?></td>
				  	        			<td><?php echo $mem->MEMBER_EMAIL; ?></td>
				  	        			<td><?php echo $mem->MEMBER_DUSUN.' - '.$mem->MEMBER_DESA.' - '.$mem->MEMBER_KECAMATAN.' - '.$mem->MEMBER_KABUPATEN.' - '.$mem->MEMBER_PROVINSI.''; ?></td>
				  	        			<td><span class="badge badge-<?php echo ( $mem->MEMBER_VERIFIKASI == 'BELUM' )? 'warning' : 'success' ?>"><?php echo $mem->MEMBER_VERIFIKASI; ?></span></td>
				  	        			<td><span class="badge badge-<?php echo ( $mem->MEMBER_STATUS == 'BLOK' )? 'danger' : 'success' ?>"><?php echo $mem->MEMBER_STATUS; ?></span></td>
				  	        			<td><?php echo __tgl_full($mem->MEMBER_ADD); ?></td>
				  	        			<td>
				  	        				<a href="<?php echo base_url() ?>admin/memberDetail/<?php echo $mem->MEMBER_ID; ?>" class="btn btn-primary"><i class="icon icon-eye"></i> Detail</a>
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

	<?php 
		echo __js('jquery'); 
		echo __js('checkall'); 
		echo __js('__checkall'); 
		echo __js('bootstrap'); 
		echo __js('back'); 
	?>
		
	</body>
</html>