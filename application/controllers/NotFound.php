<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class notFound extends CI_Controller {

	public function index()
	{
		$this->load->view('404');
	}

	public function get()
	{
		echo "segmemt 3".$this->uri->segment(3)."\n";
		echo "segmemt 4".$this->uri->segment(4)."\n";
	}

}

/* End of file 404.php */
/* Location: ./application/controllers/404.php */