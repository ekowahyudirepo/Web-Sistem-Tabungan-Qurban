<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M__member extends CI_Model {

	public $limit, $offset, $kolom, $keyword, $status, $order_by, $where, $start, $end;

	public function show()
	{
		$this->db->select('*');
		if ($this->keyword != '' OR isset($this->keyword)) {
			$this->db->like($this->kolom, $this->keyword, 'BOTH');
		}
		if ($this->status == 'BARU' OR $this->status == 'AKTIF' OR $this->status == 'BLOKIR') {
			$this->db->where('MEMBER_STATUS', $this->status);
		}
		$this->db->order_by('MEMBER_NAMA', 'asc');
		return $this->db->get('MEMBER', $this->limit, $this->offset);
	}

	public function filter()
	{
		$this->db->order_by('MEMBER_NAMA', $this->order_by );
		if ( $this->where != 'semua'  ) {
			$this->db->where('MEMBER_STATUS', $this->where);
		}
		if ( $this->start != ''  ) {
			$this->db->where('MEMBER_ADD >=', strtotime($this->start));
			$this->db->where('MEMBER_ADD <=', strtotime($this->end));
		}
		return $this->db->get('MEMBER');
	}
	
}

/* End of file M__penerima.php */
/* Location: ./application/models/M__penerima.php */