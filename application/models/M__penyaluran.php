<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M__penyaluran extends CI_Model {

	public $limit, $offset, $kolom, $keyword;

	public function show()
	{
		$this->db->select('*');
		if ($this->keyword != '' OR isset($this->keyword)) {
			$this->db->like($this->kolom, $this->keyword, 'BOTH');
		}
		
		$this->db->join('KERANJANG', 'KERANJANG.NOTA_NO = NOTA.NOTA_NO', 'left');
		$this->db->join('HEWAN', 'HEWAN.HEWAN_ID = KERANJANG.HEWAN_ID', 'left');
		$this->db->join('LEMBAGA', 'LEMBAGA.LEMBAGA_ID = NOTA.LEMBAGA_ID', 'left');
		$this->db->join('MEMBER', 'MEMBER.MEMBER_ID = NOTA.MEMBER_ID', 'left');
		$this->db->order_by('NOTA.NOTA_TGL_TERIMA', 'desc');
		return $this->db->get('NOTA', $this->limit, $this->offset);
	}
	
}

/* End of file M__penyaluran.php */
/* Location: ./application/models/M__penyaluran.php */