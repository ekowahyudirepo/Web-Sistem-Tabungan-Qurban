<?php

  // file name for download
  $filename = $this->input->post('nama_file').".xls";

  header("Content-Disposition: attachment; filename=".$filename."");
  header("Content-Type: application/vnd.ms-excel");

  if( $this->input->post('no') == 'on' ){ echo "#\t"; }
  if( $this->input->post('tgl_add') == 'on' ){ echo "Tanggal Tambah\t"; }
  if( $this->input->post('nama') == 'on' ){ echo "Nama\t"; }
  if( $this->input->post('email') == 'on' ){ echo "Email\t"; }
  if( $this->input->post('isi') == 'on' ){ echo "Isi\t"; }
  if( $this->input->post('status') == 'on' ){ echo "Status\t"; }
  echo "\n";

  $no =1; foreach ( $query_saran->result() as $row) 
  {

  if( $this->input->post('no') == 'on' ){ echo $no++."\t"; }
  if( $this->input->post('tgl_add') == 'on' ){ echo __tgl_full($row->SARAN_ADD)."\t"; }
  if( $this->input->post('nama') == 'on' ){ echo $row->SARAN_NAMA."\t"; }
  if( $this->input->post('email') == 'on' ){ echo __rp($row->SARAN_EMAIL)."\t"; }
  if( $this->input->post('isi') == 'on' ){ echo $row->SARAN_ISI."\t"; }
  if( $this->input->post('status') == 'on' ){ echo $row->SARAN_STATUS."\t"; }
  echo "\n";

  }

  exit;