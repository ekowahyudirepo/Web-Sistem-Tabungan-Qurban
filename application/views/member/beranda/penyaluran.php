<?php echo $__header; ?>

<div class="container" style="margin-top: 100px">
	<div class="row">
		<div class="col-md-8">
			<h3 class="text-success"><b><i class="icon icon-refresh"></i> PENYALURAN</b></h3>
		</div>
		<div class="col-md-4">
			<form>
			<div class="input-group">
			    <select class="form-control" name="kolom">
			        <option value="MEMBER.MEMBER_NAMA">Nama Pekurban</option>
			        <option value="LEMBAGA.LEMBAGA_NAMA">Nama Lembaga</option>
			    </select>
				<input type="text" class="form-control" placeholder="Enter keyword" name="keyword">
				<span class="input-group-btn">
					<button class="btn btn-secondary" type="submit" formaction="<?php echo base_url() ?>penyaluranList" formmethod="POST"><i class="icon icon-magnifier"></i> Cari</button>
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
	  	        			<th>Tanggal</th>
	  	        			<th>Nama</th>
	  	        			<th>Lembaga</th>
	  	        			<th>Nama Hewan</th>
	  	        			<th>QTY</th>
	  	        		</tr>
	  	        	</thead>
	  	        	<tbody>
	  	        		<?php $no = 1; ?>
	  	        		<?php foreach ($query_penyaluran->result() as $pen) { ?>
	  	        		<tr>
	  	        			<td><?php echo $no++; ?></td>
	  	        			<td><?php echo __tgl_dmy($pen->NOTA_TGL_TERIMA); ?></td>
	  	        			<td><?php echo $pen->MEMBER_NAMA; ?></td>
	  	        			<td><?php echo $pen->LEMBAGA_NAMA; ?></td>
	  	        			<td><?php echo $pen->HEWAN_NAMA; ?></td>
	  	        			<td><?php echo $pen->KERANJANG_QTY; ?></td>
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

<?php echo $__footer; ?>