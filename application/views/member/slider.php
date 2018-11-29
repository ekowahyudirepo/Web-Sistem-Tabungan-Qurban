<div class="owl-carousel slider owl-theme">
	<?php foreach($this->db->where('SLIDER_STATUS', 'TAMPIL')->get('SLIDER')->result() as $sli){ ?>
	<div class="item">
		<a href="<?php echo $sli->SLIDER_LINK; ?>">
			<img class="img-fluid" src="<?php echo base_url() ?>uploads/<?php echo $sli->SLIDER_GMB; ?>" width="100%" alt="<?php echo $sli->SLIDER_GMB; ?>">
		</a>
	</div>
	<?php } ?>
</div>
	