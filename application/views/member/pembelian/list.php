<?php echo $__header; ?>

<div class="container" style="margin-top: 100px">
	<div class="row">
		<div class="col-12">
		  	<h4 class="text-success"><b><i class="icon icon-bag"></i> NOTA PEMBELIAN</b></h4>
		</div>
	</div>
	
	<form>
	<div class="row">
		<div class="col-md-8">
			<a href="<?php echo base_url() ?>member/pembelianTambah" class="btn btn-primary"><i class="icon icon-plus"></i> Tambah Pembelian</a>
			<a href="<?php echo base_url() ?>member/pembelian/semua" class="btn btn-<?php echo ( $this->uri->segment(3) == '' OR $this->uri->segment(3) == 'semua' )? 'primary' : 'light'; ?>">Semua</a>
			<a href="<?php echo base_url() ?>member/pembelian/proses" class="btn btn-<?php echo ( $this->uri->segment(3) == 'proses' )? 'primary' : 'light'; ?>">Proses</a>
			<a href="<?php echo base_url() ?>member/pembelian/terima" class="btn btn-<?php echo ( $this->uri->segment(3) == 'terima' )? 'primary' : 'light'; ?>">Terima</a>
		</div>
		<div class="col-md-4">
			<div class="input-group">
				<select class="form-control" name="KOLOM"> 
					<option value="NOTA.NOTA_NO">Nota</option>
					<option value="NOTA.NOTA_CATATAN">Atas Nama</option>
					<option value="LEMBAGA.LEMBAGA_NAMA">Penerima</option>
				</select>
				<input type="text" class="form-control" placeholder="Enter keyword" name="keyword">
				<span class="input-group-btn">
					<button class="btn btn-secondary" type="submit" formaction="<?php echo base_url() ?>member/pembelian/<?php echo $this->uri->segment(3); ?>" formmethod="POST"><i class="icon icon-magnifier"></i> Cari</button>
				</span>
			</div>
		</div>
	</div>
	</form>

	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive"> 
	  	        <table class="table table-hover table-striped" style="width: 100%">
	  	        	<thead>
	  	        		<tr>
	  	        			<th>No</th>
	  	        			<th>Tanggal</th>
	  	        			<th>Nota</th>
	  	        			<th>Atas Nama</th>
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
	  	        			<td><?php echo $not->NOTA_CATATAN; ?></td>
	  	        			<td><?php echo $not->LEMBAGA_NAMA; ?></td>
	  	        			<td><?php echo __rp($not->NOTA_TOTAL); ?></td>
	  	        			<td><span class="badge badge-<?php echo ( $not->NOTA_STATUS == 'PROSES' )? 'danger' : 'success' ?>"><?php echo $not->NOTA_STATUS; ?></span></td>
	  	        			<td>
	  	        				<a href="<?php echo base_url() ?>member/pembelianDetail/<?php echo $not->NOTA_ID; ?>" class="btn btn-light">Detail</a>
	  	        				<?php if($not->NOTA_STATUS == 'TERIMA'){ ?>
	  	        				<a href="<?php echo base_url(); ?>member/sertifikatPembelian/<?php echo $not->NOTA_NO; ?>" class="btn btn-primary">Sertifikat</a>
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
</div>

<?php echo $__footer; ?>