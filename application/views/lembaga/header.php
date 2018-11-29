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
	<a href="<?php echo base_url().'lembaga/penerimaan/proses'; ?>"><i class="icon icon-bag"></i> Penerimaan
		<?php $saldo = $this->db->where('LEMBAGA_ID', $this->session->userdata('__ci_lembaga_id'))->where('NOTA_STATUS', 'PROSES')->get('NOTA');
		if ($saldo->num_rows() != 0) { ?>

		<span class="badge badge-danger">
			<?php echo $saldo->num_rows(); ?>
		</span>

		<?php } ?>
	</a>
</div>