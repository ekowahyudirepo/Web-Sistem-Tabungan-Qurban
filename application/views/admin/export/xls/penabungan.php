<?php

  // file name for download
  $filename = $this->input->post('nama_file').".xls";

  header("Content-Disposition: attachment; filename=".$filename."");
  header("Content-Type: application/vnd.ms-excel");

  if( $this->input->post('no') == 'on' ){ echo "#\t"; }
  if( $this->input->post('tgl_add') == 'on' ){ echo "Tanggal Tambah\t"; }
  if( $this->input->post('pekurban') == 'on' ){ echo "Pekurban\t"; }
  if( $this->input->post('nominal') == 'on' ){ echo "Nominal\t"; }
  if( $this->input->post('tgl_transfer') == 'on' ){ echo "Tanggal Transfer\t"; }
  if( $this->input->post('catatan') == 'on' ){ echo "Catatan\t"; }
  if( $this->input->post('status') == 'on' ){ echo "Status\t"; }
  echo "\n";

  $no =1; foreach ( $query_penabungan->result() as $row) 
  {

  if( $this->input->post('no') == 'on' ){ echo $no++."\t"; }
  if( $this->input->post('tgl_add') == 'on' ){ echo __tgl_full($row->TABUNGAN_ADD)."\t"; }
  if( $this->input->post('pekurban') == 'on' ){ echo $row->MEMBER_NAMA."\t"; }
  if( $this->input->post('nominal') == 'on' ){ echo __rp($row->TABUNGAN_NOMINAL)."\t"; }
  if( $this->input->post('tgl_transfer') == 'on' ){ echo __tgl_dmy($row->TABUNGAN_TGL)."\t"; }
  if( $this->input->post('catatan') == 'on' ){ echo $row->TABUNGAN_CATATAN."\t"; }
  if( $this->input->post('status') == 'on' ){ echo $row->TABUNGAN_STATUS."\t"; }
  echo "\n";

  }

  exit;