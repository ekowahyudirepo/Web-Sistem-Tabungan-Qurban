<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M__mail extends CI_Model {

	public $dari, $ke, $subjek, $pesan;

	public function send()
	{
		$this->load->library('email');
		
		$this->email->from( $this->dari , 'SITAQUR CENTER');
		$this->email->to( $this->ke );
		
		$this->email->subject( $this->subjek );
		$this->email->message( $this->pesan );
		
		$this->email->send();
	}

}

/* End of file M__mail.php */
/* Location: ./application/models/M__mail.php */