<?php

  // file name for download
  $filename = $this->input->post('nama_file').".xls";

  header("Content-Disposition: attachment; filename=".$filename."");
  header("Content-Type: application/vnd.ms-excel");

  if( $this->input->post('no') == 'on' ){ echo "#\t"; }
  if( $this->input->post('nama') == 'on' ){ echo "Nama\t"; }
  if( $this->input->post('harga') == 'on' ){ echo "Harga\t"; }
  if( $this->input->post('berat') == 'on' ){ echo "Berat\t"; }
  if( $this->input->post('status') == 'on' ){ echo "Status\t"; }
  echo "\n";

  $no =1; foreach ( $query_hewan->result() as $row) 
  {

  if( $this->input->post('no') == 'on' ){ echo $no++."\t"; }
  if( $this->input->post('nama') == 'on' ){ echo $row->HEWAN_NAMA."\t"; }
  if( $this->input->post('harga') == 'on' ){ echo "(0)".$row->HEWAN_HARGA."\t"; }
  if( $this->input->post('berat') == 'on' ){ echo $row->HEWAN_BERAT."\t"; }
  if( $this->input->post('status') == 'on' ){ echo $row->HEWAN_STATUS."\t"; }
  echo "\n";

  }

  exit;