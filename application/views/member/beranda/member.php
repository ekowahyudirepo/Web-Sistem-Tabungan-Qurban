<?php echo $__header; ?>

<div class="container" style="margin-top: 100px">
	<div class="row">
		<div class="col-md-8">
			<h3 class="text-success"><b><i class="icon icon-people"></i> DAFTAR MEMBER</b></h3>
		</div>
		<div class="col-md-4">
			<form>
			<div class="input-group">
				<select class="form-control" name="kolom">
					<option value="MEMBER_NAMA">Nama</option>
					<option value="MEMBER_PROVINSI">Provinsi</option>
					<option value="MEMBER_KABUPATEN">Kabupaten</option>
					<option value="MEMBER_KECAMATAN">Kecamatan</option>
					<option value="MEMBER_DESA">Desa</option>
					<option value="MEMBER_DUSUN">Dusun</option>
				</select>
				<input type="text" class="form-control" placeholder="Enter keyword" name="keyword">
				<span class="input-group-btn">
					<button class="btn btn-secondary" type="submit" formaction="<?php echo base_url() ?>memberList" formmethod="POST"><i class="icon icon-magnifier"></i> Cari</button>
				</span>
			</div>
			</form>
		</div>
	</div>
	<div class="row" style="margin-top: 20px;">
		<div class="col-md-12">      
			<div class="table-responsive"> 
	  	        <table class="table table-hover table-striped">
	  	        	<thead>
	  	        		<tr>
	  	        			<th>No</th>
	  	        			<th>Nama</th>
	  	        			<th>Alamat</th>
	  	        		</tr>
	  	        	</thead>
	  	        	<tbody>
	  	        		<?php $no = 1; ?>
	  	        		<?php foreach ($query_member->result() as $mem) { ?>
	  	        		<tr>
	  	        			<td><?php echo $no++; ?></td>
	  	        			<td><?php echo $mem->MEMBER_NAMA; ?></td>
	  	        			<td><?php echo $mem->MEMBER_DUSUN.' - '.$mem->MEMBER_DESA.' - '.$mem->MEMBER_KECAMATAN.' - '.$mem->MEMBER_KABUPATEN.' - '.$mem->MEMBER_PROVINSI.''; ?></td>
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
</div>

<!-- Footer -->
<?php echo $__footer; ?>