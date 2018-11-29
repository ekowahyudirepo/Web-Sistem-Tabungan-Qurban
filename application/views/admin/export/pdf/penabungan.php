<?php $logo = $this->db->get('INFO')->row()->INFO_LOGO; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Data Penabungan</title>
	<style>
		@import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";
		body { font-family: 'Poppins', sans-serif; font-size: 12px;}
		img{ width: 300px; }
		table{ border-collapse: collapse; border: 1px solid black }
		table th{ padding: 7px; }
		table td{ padding: 5px; }
	</style>
</head>
<body>
<small>Tanggal Cetak : <?php echo date('Y F d H:i:s'); ?></small><br><br>
<img src="./uploads/<?php echo $logo; ?>">
<h1># DATA PENABUNGAN</h1>
<br>
<br>
<table border="1" width="100%">
	<thead>
		<tr>
			<?php if( $this->input->post('no') == 'on' ){ ?> <th>#</th> <?php } ?>
			<?php if( $this->input->post('tgl_add') == 'on' ){ ?> <th>Tanggal Tambah</th> <?php } ?>
		    <?php if( $this->input->post('pekurban') == 'on' ){ ?> <th>Pekurban</th> <?php } ?>
		    <?php if( $this->input->post('nominal') == 'on' ){ ?> <th>Nominal</th> <?php } ?>
		  	<?php if( $this->input->post('tgl_transfer') == 'on' ){ ?> <th>Tanggal Transfer</th> <?php } ?>
		  	<?php if( $this->input->post('catatan') == 'on' ){ ?> <th>Catatan</th> <?php } ?>
		  	<?php if( $this->input->post('status') == 'on' ){ ?> <th>Status</th> <?php } ?>
		</tr>
	</thead>
	<tbody>
	<?php $no =1; foreach ( $query_penabungan->result() as $row) { ?>
		<tr>
			<?php if( $this->input->post('no') == 'on' ){ ?> <td><?php echo $no++; ?></td> <?php } ?>
			<?php if( $this->input->post('tgl_add') == 'on' ){ ?> <td><?php echo __tgl_full($row->TABUNGAN_ADD); ?></td> <?php } ?>
			<?php if( $this->input->post('pekurban') == 'on' ){ ?> <td><?php echo $row->MEMBER_NAMA; ?></td> <?php } ?>
			<?php if( $this->input->post('nominal') == 'on' ){ ?> <td><?php echo __rp($row->TABUNGAN_NOMINAL); ?></td> <?php } ?>
			<?php if( $this->input->post('tgl_transfer') == 'on' ){ ?> <td><?php echo __tgl_dmy($row->TABUNGAN_TGL); ?></td> <?php } ?>
			<?php if( $this->input->post('catatan') == 'on' ){ ?> <td><?php echo $row->TABUNGAN_CATATAN; ?></td> <?php } ?>
			<?php if( $this->input->post('status') == 'on' ){ ?> <td><?php echo $row->TABUNGAN_STATUS; ?></td> <?php } ?>
		</tr>
	<?php } ?>
	</tbody>
</table>
</body>
</html>