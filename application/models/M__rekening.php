<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M__rekening extends CI_Model {

	public $limit, $offset, $kolom, $keyword, $status;

	public function show()
	{
		$this->db->select('*');
		if ($this->keyword != '' OR isset($this->keyword)) {
			$this->db->like($this->kolom, $this->keyword, 'BOTH');
		}
		if ($this->status == 'TAMPIL' OR $this->status == 'SEMBUNYI') {
			$this->db->where('REKENING_STATUS', $this->status);
		}
		$this->db->order_by('REKENING_NAMA', 'asc');
		return $this->db->get('REKENING', $this->limit, $this->offset);
	}
	
}

/* End of file M__rekening.php */
/* Location: ./application/models/M__rekening.php */