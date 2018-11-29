<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M__tabungan extends CI_Model {

	public $limit, $offset, $kolom, $keyword, $status, $id, $order_by, $where, $start, $end;


	public function show()
	{
		$this->db->select('*');
		if ($this->keyword != '' OR isset($this->keyword)) {
			$this->db->like($this->kolom, $this->keyword, 'BOTH');
		}
		if ( $this->status == 'PROSES' OR $this->status == 'TERIMA' OR $this->status == 'TOLAK') {
			$this->db->where('TABUNGAN.TABUNGAN_STATUS', $this->status);
		}
		if ( $this->id != '' OR isset($this->id) ) {
			$this->db->where('MEMBER.MEMBER_ID', $this->id);
		}
		$this->db->join('MEMBER', 'MEMBER.MEMBER_ID = TABUNGAN.MEMBER_ID', 'left');
		$this->db->join('REKENING', 'REKENING.REKENING_ID = TABUNGAN.REKENING_ID', 'left');
		$this->db->order_by('TABUNGAN.TABUNGAN_ADD', 'desc');
		return $this->db->get('TABUNGAN', $this->limit, $this->offset);
	}

	public function filter()
	{
		$this->db->order_by('TABUNGAN.TABUNGAN_ADD', $this->order_by );
		if ( $this->where != 'semua'  ) {
			$this->db->where('TABUNGAN.TABUNGAN_STATUS', $this->where);
		}
		if ( $this->start != ''  ) {
			$this->db->where('TABUNGAN.TABUNGAN_ADD >=', strtotime($this->start));
			$this->db->where('TABUNGAN.TABUNGAN_ADD <=', strtotime($this->end));
		}
		$this->db->join('MEMBER', 'MEMBER.MEMBER_ID = TABUNGAN.MEMBER_ID', 'left');
		return $this->db->get('TABUNGAN');
	}

	public function saldo($id)
	{
		return $this->tabungan($id) - $this->nota($id);
	}

	public function tabungan($id)
	{
		return $this->db
				->select('SUM(TABUNGAN_NOMINAL) AS saldo')
				->where('TABUNGAN_STATUS','TERIMA')
				->where('MEMBER_ID', $id)
				->get('TABUNGAN')->row()->saldo;
	}

	public function nota($id)
	{
		return	$this->db->query("SELECT SUM(NOTA_TOTAL) AS total FROM NOTA WHERE NOTA_STATUS IN('PROSES','TERIMA') AND MEMBER_ID = ".$id." ")->row()->total;
	}
	
}

/* End of file M__tabungan.php */
/* Location: ./application/models/M__tabungan.php */