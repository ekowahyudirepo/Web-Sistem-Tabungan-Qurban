<?php $logo = $this->db->get('INFO')->row()->INFO_LOGO; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Data Saran</title>
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
<h1># DATA SARAN</h1>
<br>
<br>
<table border="1" width="100%">
	<thead>
		<tr>
			<?php if( $this->input->post('no') == 'on' ){ ?> <th>#</th> <?php } ?>
			<?php if( $this->input->post('tgl_add') == 'on' ){ ?> <th>Tanggal Tambah</th> <?php } ?>
		    <?php if( $this->input->post('nama') == 'on' ){ ?> <th>Nama</th> <?php } ?>
		    <?php if( $this->input->post('email') == 'on' ){ ?> <th>Email</th> <?php } ?>
		  	<?php if( $this->input->post('isi') == 'on' ){ ?> <th>Isi</th> <?php } ?>
		  	<?php if( $this->input->post('status') == 'on' ){ ?> <th>Status</th> <?php } ?>
		</tr>
	</thead>
	<tbody>
	<?php $no =1; foreach ( $query_saran->result() as $row) { ?>
		<tr>
			<?php if( $this->input->post('no') == 'on' ){ ?> <td><?php echo $no++; ?></td> <?php } ?>
			<?php if( $this->input->post('tgl_add') == 'on' ){ ?> <td><?php echo __tgl_full($row->SARAN_ADD); ?></td> <?php } ?>
			<?php if( $this->input->post('nama') == 'on' ){ ?> <td><?php echo $row->SARAN_NAMA; ?></td> <?php } ?>
			<?php if( $this->input->post('email') == 'on' ){ ?> <td><?php echo $row->SARAN_EMAIL; ?></td> <?php } ?>
			<?php if( $this->input->post('isi') == 'on' ){ ?> <td><?php echo $row->SARAN_ISI; ?></td> <?php } ?>
			<?php if( $this->input->post('status') == 'on' ){ ?> <td><?php echo $row->SARAN_STATUS; ?></td> <?php } ?>
		</tr>
	<?php } ?>
	</tbody>
</table>
</body>
</html>