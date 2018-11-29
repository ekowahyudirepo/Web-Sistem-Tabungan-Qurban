<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M__lembaga extends CI_Model {

	public $limit, $offset, $kolom, $keyword, $status, $order_by, $where;

	public function show()
	{
		$this->db->select('*');
		if ($this->keyword != '' OR isset($this->keyword)) {
			$this->db->like($this->kolom, $this->keyword, 'BOTH');
		}
		if ($this->status == 'TAMPIL' OR $this->status == 'SEMBUNYI') {
			$this->db->where('LEMBAGA_STATUS', $this->status);
		}
		$this->db->order_by('LEMBAGA_NAMA', 'asc');
		return $this->db->get('LEMBAGA', $this->limit, $this->offset);
	}

	public function filter()
	{
		$this->db->order_by('LEMBAGA_NAMA', $this->order_by );
		if ( $this->where != 'semua'  ) {
			$this->db->where('LEMBAGA_STATUS', $this->where);
		}
		return $this->db->get('LEMBAGA');
	}
	
}

/* End of file M__lembaga.php */
/* Location: ./application/models/M__lembaga.php */