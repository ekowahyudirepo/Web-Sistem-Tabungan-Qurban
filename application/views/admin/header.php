<?php echo $this->session->userdata('__alert'); ?>

<div class="preloader">
	<div class="icon">
		<img width="70px;" src="<?php echo base_url() ?>assets/loading.svg">
	</div>
</div>

<div class="icon-header" style="margin-bottom: 20px;color: white;background: linear-gradient(to right, blue , green);">
	<a href="#" id="sidebarCollapse">
	    <i class="icon icon-menu"></i>
	</a>
	
	<a href="<?php echo base_url().'admin/tabungan/proses'; ?>"><i class="icon icon-wallet"></i> Penabungan
		<?php $saldo = $this->db->where('TABUNGAN_STATUS', 'PROSES')->get('TABUNGAN');
		if ($saldo->num_rows() != 0) { ?>

		<span class="badge badge-danger">
			<?php echo $saldo->num_rows(); ?>
		</span>

		<?php } ?>
	</a>

	<a href="<?php echo base_url().'admin/pembelian/proses'; ?>"><i class="icon icon-bag"></i> Pembelian
		<?php $saldo = $this->db->where('NOTA_STATUS', 'PROSES')->get('NOTA');
		if ($saldo->num_rows() != 0) { ?>

		<span class="badge badge-danger">
			<?php echo $saldo->num_rows(); ?>
		</span>

		<?php } ?>
	</a>

	<a href="<?php echo base_url().'admin/saran/baru'; ?>">
		<i class="icon icon-user-following"></i> Saran
		<?php $saldo = $this->db->where('SARAN_STATUS', 'BELUM')->get('SARAN');
		if ($saldo->num_rows() != 0) { ?>

		<span class="badge badge-danger">
			<?php echo $saldo->num_rows(); ?>
		</span>

		<?php } ?>
	</a>
</div>