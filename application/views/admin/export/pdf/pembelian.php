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
		    <?php if( $this->input->post('lembaga') == 'on' ){ ?> <th>Lembaga</th> <?php } ?>
		    <?php if( $this->input->post('total') == 'on' ){ ?> <th>Total</th> <?php } ?>
		  	<?php if( $this->input->post('tgl_terima') == 'on' ){ ?> <th>Tanggal Terima</th> <?php } ?>
		  	<?php if( $this->input->post('catatan') == 'on' ){ ?> <th>Catatan</th> <?php } ?>
		  	<?php if( $this->input->post('status') == 'on' ){ ?> <th>Status</th> <?php } ?>
		</tr>
	</thead>
	<tbody>
	<?php $no =1; foreach ( $query_pembelian->result() as $row) { ?>
		<tr>
			<?php if( $this->input->post('no') == 'on' ){ ?> <td><?php echo $no++; ?></td> <?php } ?>
			<?php if( $this->input->post('tgl_add') == 'on' ){ ?> <td><?php echo __tgl_dmy($row->NOTA_ADD); ?></td> <?php } ?>
			<?php if( $this->input->post('pekurban') == 'on' ){ ?> <td><?php echo $row->MEMBER_NAMA; ?></td> <?php } ?>
			<?php if( $this->input->post('lembaga') == 'on' ){ ?> <td><?php echo $row->LEMBAGA_NAMA; ?></td> <?php } ?>
			<?php if( $this->input->post('total') == 'on' ){ ?> <td><?php echo __rp($row->NOTA_TOTAL); ?></td> <?php } ?>
			<?php if( $this->input->post('tgl_terima') == 'on' ){ ?> <td><?php echo __tgl_dmy($row->NOTA_TGL_TERIMA); ?></td> <?php } ?>
			<?php if( $this->input->post('catatan') == 'on' ){ ?> <td><?php echo $row->NOTA_CATATAN; ?></td> <?php } ?>
			<?php if( $this->input->post('status') == 'on' ){ ?> <td><?php echo $row->NOTA_STATUS; ?></td> <?php } ?>
		</tr>
	<?php } ?>
	</tbody>
</table>
</body>
</html>