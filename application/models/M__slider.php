<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M__slider extends CI_Model {

	public $limit, $offset, $kolom, $keyword, $status;

	public function show()
	{
		$this->db->select('*');
		if ($this->keyword != '' OR isset($this->keyword)) {
			$this->db->like($this->kolom, $this->keyword, 'BOTH');
		}
		if ($this->status == 'TAMPIL' OR $this->status == 'SEMBUNYI') {
			$this->db->where('SLIDER_STATUS', $this->status);
		}
		$this->db->order_by('SLIDER_ADD', 'desc');
		return $this->db->get('SLIDER', $this->limit, $this->offset);
	}
	
}

/* End of file M__slider.php */
/* Location: ./application/models/M__slider.php */