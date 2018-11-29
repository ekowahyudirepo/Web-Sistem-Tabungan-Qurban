<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M__nota extends CI_Model {

	public $limit, $offset, $kolom, $keyword, $status, $id, $order_by, $where, $start, $end;

	public function show()
	{
		$this->db->select('*');
		if ($this->keyword != '' OR isset($this->keyword)) {
			$this->db->like($this->kolom, $this->keyword, 'BOTH');
		}
		if ($this->status == 'PROSES' OR $this->status == 'TERIMA') {
			$this->db->where('NOTA.NOTA_STATUS', $this->status);
		}
		if ( $this->id != '' OR isset($this->id) ) {
			$this->db->where('MEMBER.MEMBER_ID', $this->id);
		}
		$this->db->join('MEMBER', 'MEMBER.MEMBER_ID = NOTA.MEMBER_ID', 'left');
		$this->db->join('LEMBAGA', 'LEMBAGA.LEMBAGA_ID = NOTA.LEMBAGA_ID', 'left');
		$this->db->order_by('NOTA.NOTA_ADD', 'asc');
		return $this->db->get('NOTA', $this->limit, $this->offset);
	}

	public function showLembaga()
	{
		$this->db->select('*');
		if ($this->keyword != '' OR isset($this->keyword)) {
			$this->db->like($this->kolom, $this->keyword, 'BOTH');
		}
		if ($this->status == 'PROSES' OR $this->status == 'TERIMA') {
			$this->db->where('NOTA.NOTA_STATUS', $this->status);
		}
		if ( $this->id != '' OR isset($this->id) ) {
			$this->db->where('LEMBAGA.LEMBAGA_ID', $this->id);
		}
		$this->db->join('MEMBER', 'MEMBER.MEMBER_ID = NOTA.MEMBER_ID', 'left');
		$this->db->join('LEMBAGA', 'LEMBAGA.LEMBAGA_ID = NOTA.LEMBAGA_ID', 'left');
		$this->db->order_by('NOTA.NOTA_ADD', 'asc');
		return $this->db->get('NOTA', $this->limit, $this->offset);
	}

	public function filter()
	{
		$this->db->order_by('NOTA.NOTA_ADD', $this->order_by );
		if ( $this->where != 'semua'  ) {
			$this->db->where('NOTA.NOTA_STATUS', $this->where);
		}
		if ( $this->start != ''  ) {
			$this->db->where('NOTA.NOTA_ADD >=', $this->start);
			$this->db->where('NOTA.NOTA_ADD <=', $this->end);
		}
		$this->db->join('MEMBER', 'MEMBER.MEMBER_ID = NOTA.MEMBER_ID', 'left');
		$this->db->join('LEMBAGA', 'LEMBAGA.LEMBAGA_ID = NOTA.LEMBAGA_ID', 'left');
		return $this->db->get('NOTA');
	}

}

/* End of file M__nota.php */
/* Location: ./application/models/M__nota.php */