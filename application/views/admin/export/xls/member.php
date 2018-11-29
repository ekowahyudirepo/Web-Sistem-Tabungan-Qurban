<?php

  // file name for download
  $filename = $this->input->post('nama_file').".xls";

  header("Content-Disposition: attachment; filename=".$filename."");
  header("Content-Type: application/vnd.ms-excel");

  if( $this->input->post('no') == 'on' ){ echo "#\t"; }
  if( $this->input->post('nik') == 'on' ){ echo "NIK\t"; }
  if( $this->input->post('nama') == 'on' ){ echo "Nama\t"; }
  if( $this->input->post('hp') == 'on' ){ echo "No HP\t"; }
  if( $this->input->post('email') == 'on' ){ echo "Email\t"; }
  if( $this->input->post('alamat') == 'on' ){ echo "Alamat\t"; }
  if( $this->input->post('status') == 'on' ){ echo "Status\t"; }
  echo "\n";

  $no =1; foreach ( $query_member->result() as $row) 
  {

  if( $this->input->post('no') == 'on' ){ echo $no++."\t"; }
  if( $this->input->post('nik') == 'on' ){ echo $row->MEMBER_NIK."\t"; }
  if( $this->input->post('nama') == 'on' ){ echo $row->MEMBER_NAMA."\t"; }
  if( $this->input->post('hp') == 'on' ){ echo "(0)".$row->MEMBER_HP."\t"; }
  if( $this->input->post('email') == 'on' ){ echo $row->MEMBER_EMAIL."\t"; }
  if( $this->input->post('alamat') == 'on' ){ echo $row->MEMBER_ALAMAT."\t"; }
  if( $this->input->post('status') == 'on' ){ echo $row->MEMBER_STATUS."\t"; }
  echo "\n";

  }

  exit;