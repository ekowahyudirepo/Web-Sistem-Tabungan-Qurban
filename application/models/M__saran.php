<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M__saran extends CI_Model {

	public $limit, $offset, $kolom, $keyword, $status;

	public function show()
	{
		$this->db->select('*');
		if ($this->keyword != '' OR isset($this->keyword)) {
			$this->db->like($this->kolom, $this->keyword, 'BOTH');
		}
		if ($this->status == 'BELUM' OR $this->status == 'SUDAH') {
			$this->db->where('SARAN_STATUS', $this->status);
		}
		
		$this->db->order_by('SARAN_ADD', 'asc');
		return $this->db->get('SARAN', $this->limit, $this->offset);
	}

	public function filter()
	{
		$this->db->order_by('SARAN.SARAN_ADD', $this->order_by );
		if ( $this->where != 'semua'  ) {
			$this->db->where('SARAN.SARAN_STATUS', $this->where);
		}
		if ( $this->start != ''  ) {
			$this->db->where('SARAN.SARAN_ADD >=', strtotime($this->start));
			$this->db->where('SARAN.SARAN_ADD <=', strtotime($this->end));
		}
		return $this->db->get('SARAN');
	}
	
}

/* End of file M__saran.php */
/* Location: ./application/models/M__saran.php */