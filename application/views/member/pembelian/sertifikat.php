<?php 
	$info = $this->db->get('INFO')->row();
	$not  = $query_nota->row(); 


	include('./assets/barcode/BarcodeGenerator.php');
	include('./assets/barcode/BarcodeGeneratorPNG.php');

	$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
?>



<!DOCTYPE html>
<html>
<head>
	<title><?php echo $not->NOTA_NO; ?></title>
	<style>
		@page{
			margin: 25px 25px;
		}
		body{
			font-family: sans-serif;
		}
	</style>
</head>
<body>
<div class="card" style="border: 3px solid green;padding: 30px;text-align: center;">
	<img src="./uploads/<?php echo $info->INFO_LOGO; ?>" width="150;" alt="<?php echo $info->INFO_LOGO; ?>">
	<br>
	<br>
	<?php echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($not->NOTA_NO, $generator::TYPE_CODE_128)) . '">'; ?>
	<br>
	<br>
	<h1 style="font-size: 32px;color: gold">SERTIFIKAT PARTISIPASI</h1>
	<br>
	<br>
	<p>Ucapan Terima Kasih di Sampaikan Kepada</p>
	<h4><b><?php echo $this->session->userdata('__ci_member_nama'); ?> # <?php echo $this->session->userdata('__ci_member_id'); ?></b></h4>
	<p>Berkurban Atas Nama</p>
	<h4><b><?php echo $not->NOTA_CATATAN; ?></b></h4>
	<p>Di Lembaga</p>
	<h4><b><?php echo $not->LEMBAGA_NAMA; ?></b></h4>
	<br>
	<p>Demikian sertifikat sebagai bukti partisipasi dan Semoga amal ibadah kurban diterima olah Allah SWT.</p>
	<br>
	<p>Dikeluarkan Oleh QURBANAPP.COM, <?php echo __tgl_dmy($not->NOTA_TGL_TERIMA); ?></p>
	<br>
	<br>
	<br>
	<br>
	<h4 style="margin: 0;"><u>QURBANAPP.COM</u></h4>
	<small style="margin: 0;font-size: 8px">Nomor Sertifikat : <?php echo $not->NOTA_NO; ?></small>
</div>
</body>
</html>