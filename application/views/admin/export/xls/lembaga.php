<?php

  // file name for download
  $filename = $this->input->post('nama_file').".xls";

  header("Content-Disposition: attachment; filename=".$filename."");
  header("Content-Type: application/vnd.ms-excel");

  if( $this->input->post('no') == 'on' ){ echo "#\t"; }
  if( $this->input->post('nama') == 'on' ){ echo "Nama\t"; }
  if( $this->input->post('hp') == 'on' ){ echo "No HP\t"; }
  if( $this->input->post('email') == 'on' ){ echo "Email\t"; }
  if( $this->input->post('alamat') == 'on' ){ echo "Alamat\t"; }
  if( $this->input->post('status') == 'on' ){ echo "Status\t"; }
  echo "\n";

  $no =1; foreach ( $query_lembaga->result() as $row) 
  {

  if( $this->input->post('no') == 'on' ){ echo $no++."\t"; }
  if( $this->input->post('nama') == 'on' ){ echo $row->LEMBAGA_NAMA."\t"; }
  if( $this->input->post('hp') == 'on' ){ echo "(0)".$row->LEMBAGA_HP."\t"; }
  if( $this->input->post('email') == 'on' ){ echo $row->LEMBAGA_EMAIL."\t"; }
  if( $this->input->post('alamat') == 'on' ){ echo $row->LEMBAGA_ALAMAT."\t"; }
  if( $this->input->post('status') == 'on' ){ echo $row->LEMBAGA_STATUS."\t"; }
  echo "\n";

  }

  exit;