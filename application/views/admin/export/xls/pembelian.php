<?php

  // file name for download
  $filename = $this->input->post('nama_file').".xls";

  header("Content-Disposition: attachment; filename=".$filename."");
  header("Content-Type: application/vnd.ms-excel");

  if( $this->input->post('no') == 'on' ){ echo "#\t"; }
  if( $this->input->post('tgl_add') == 'on' ){ echo "Tanggal Tambah\t"; }
  if( $this->input->post('pekurban') == 'on' ){ echo "Pekurban\t"; }
  if( $this->input->post('lembaga') == 'on' ){ echo "Lembaga\t"; }
  if( $this->input->post('total') == 'on' ){ echo "Total\t"; }
  if( $this->input->post('tgl_terima') == 'on' ){ echo "Tanggal Terima\t"; }
  if( $this->input->post('catatan') == 'on' ){ echo "Catatan\t"; }
  if( $this->input->post('status') == 'on' ){ echo "Status\t"; }
  echo "\n";

  $no =1; foreach ( $query_pembelian->result() as $row) 
  {

  if( $this->input->post('no') == 'on' ){ echo $no++."\t"; }
  if( $this->input->post('tgl_add') == 'on' ){ echo __tgl_dmy($row->NOTA_ADD)."\t"; }
  if( $this->input->post('pekurban') == 'on' ){ echo $row->MEMBER_NAMA."\t"; }
  if( $this->input->post('lembaga') == 'on' ){ echo $row->LEMBAGA_NAMA."\t"; }
  if( $this->input->post('nominal') == 'on' ){ echo __rp($row->NOTA_TOTAL)."\t"; }
  if( $this->input->post('tgl_terima') == 'on' ){ echo __tgl_dmy($row->NOTA_TGL_TERIMA)."\t"; }
  if( $this->input->post('catatan') == 'on' ){ echo $row->NOTA_CATATAN."\t"; }
  if( $this->input->post('status') == 'on' ){ echo $row->NOTA_STATUS."\t"; }
  echo "\n";

  }

  exit;