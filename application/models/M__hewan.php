<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M__hewan extends CI_Model {

	public $limit, $offset, $kolom, $keyword, $status, $order_by, $where;

	public function show()
	{
		$this->db->select('*');
		if ($this->keyword != '' OR isset($this->keyword)) {
			$this->db->like($this->kolom, $this->keyword, 'BOTH');
		}
		if ($this->status == 'TAMPIL' OR $this->status == 'SEMBUNYI') {
			$this->db->where('HEWAN_STATUS', $this->status);
		}
		$this->db->order_by('HEWAN_NAMA', 'asc');
		return $this->db->get('HEWAN', $this->limit, $this->offset);
	}

	public function filter()
	{
		$this->db->order_by('HEWAN_NAMA', $this->order_by );
		if ( $this->where != 'semua'  ) {
			$this->db->where('HEWAN_STATUS', $this->where);
		}
		return $this->db->get('HEWAN');
	}
	
}

/* End of file M__hewan.php */
/* Location: ./application/models/M__hewan.php */