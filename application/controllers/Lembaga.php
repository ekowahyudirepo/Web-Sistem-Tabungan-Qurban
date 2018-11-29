<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lembaga extends CI_Controller {

	public $title;

	public function __construct()
	{
		parent::__construct();

		// 	Set Time Default "Indonesia"
		date_default_timezone_set('Asia/Jakarta');

		// Load Model
		$this->load->model('M__grafik');

		//	Load library
		$config['first_link']      = 'Pertama';
		$config['last_link']       = 'Terakhir';
		$config['next_link']       = 'Selanjutnya';
		$config['prev_link']       = 'Sebelumnya';
		$config['full_tag_open']   = '<nav><ul class="pagination justify-content-end">';
		$config['full_tag_close']  = '</ul></nav>';
		$config['num_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']   = '</span></li>';
		$config['cur_tag_open']    = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']   = '</span></li>';
		$config['next_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['next_tag_close']  = '</span></li>';
		$config['prev_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['prev_tag_close']  = '</span></li>';
		$config['first_tag_open']  = '<li class="page-item"><span class="page-link">';
		$config['first_tag_close'] = '</span></li>';
		$config['last_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['last_tag_close']  = '</span></li>';

		$this->load->library('pagination', $config);
		$this->load->library('recaptcha');

		//	Load helper
		$this->load->helper('help');
	}

	public function is__login()
	{
		if ( ! $this->session->userdata('__ci_lembaga_id') ) {
			redirect('lembaga/masuk');
		}
	}

	/**
	*	Digunakan untuk mengambil url sebelumnya 
	*/ 
	public function kembali()
	{

		return $this->input->server('HTTP_REFERER');
	}

	public function dashboard()
	{

		$this->is__login();

		$res = []; 

		$tahun_terakhir = (!is_null($this->input->post('tahun_terakhir'))) ? $this->input->post('tahun_terakhir') : date('Y');
		$range = 5;

		for ($i= $range - 1; $i >= 0 ; $i--) { 
			$res[] = $tahun_terakhir - $i;
		}

		$kambing = [];
		for ($i=0; $i < count($res) ; $i++) { 
			$kambing[] = $this->M__grafik->jml_kurban($this->session->userdata('__ci_lembaga_id'),$res[$i],'KAMBING');
		}
		$sapi = [];
		for ($i=0; $i < count($res) ; $i++) { 
			$sapi[] = $this->M__grafik->jml_kurban($this->session->userdata('__ci_lembaga_id'),$res[$i],'SAPI');
		}

		$data['res']     = $res;
		$data['kambing'] = $kambing;
		$data['sapi']    = $sapi;

		$source = array(
			'__title'   => APP_NAME . ' ~ Halaman Dashboard Lembaga',
			'__menu'    => 'dashboard',
			'__css'     => array('bootstrap','simpleicon','confirm','back'),
			'__js'      => array('jquery','bootstrap','chartjs','chartjsutils','confirm','back')
		);
	
		$data['__header']  = $this->load->view('lembaga/header', $source, TRUE);
		$data['__sidebar'] = $this->load->view('lembaga/sidebar', $source, TRUE);

		$this->load->view('lembaga/dashboard', $data, FALSE);
	}

	public function masuk()
	{
		$data = array(
			'__title'   => APP_NAME . ' ~ Halaman Login Lembaga',
			'__css'     => array('bootstrap','simpleicon','back'),
			'__js'      => array('jquery','parsley'),

            'widget' => $this->recaptcha->getWidget(),
            'script' => $this->recaptcha->getScriptTag(),
        );

		$this->load->view('lembaga/login', $data, FALSE);
	}


	public function lembaga__masuk()
	{
		$recaptcha = $this->input->post('g-recaptcha-response');
         if (!empty($recaptcha)) 
         {
             $response = $this->recaptcha->verifyResponse($recaptcha);
             if (isset($response['success']) and $response['success'] === true) 
             {
             	$EMAIL	  = $this->input->post('EMAIL');
				$PASSWORD = __password($this->input->post('PASSWORD'));

								$this->db->where('LEMBAGA_EMAIL', $EMAIL);
								$this->db->where('LEMBAGA_PASSWORD', $PASSWORD);
				$this->query =  $this->db->get('LEMBAGA');

				if ($this->query->num_rows() == 0) 
				{
					$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Akun tidak tersedia</div>');

					redirect('lembaga/masuk');
				}
				else
				{
					$lembaga = $this->query->row();

					$array = array(
						'__ci_lembaga_id'    => $lembaga->LEMBAGA_ID,
						'__ci_lembaga_email' => $lembaga->LEMBAGA_EMAIL,
						'__ci_lembaga_nama'  => $lembaga->LEMBAGA_NAMA,
					);
					
					$this->session->set_userdata( $array );

					$this->session->set_flashdata('__alert', '<div class="alert alert-success alert-style">Selamat! Datang '.$lembaga->LEMBAGA_NAMA.'</div>');

					redirect('lembaga/dashboard');
				}
             }
         }
         else
         {
         	$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! CAPTCHA tidak sesuai</div>');

		    redirect('lembaga/masuk');
         }
		
        	$EMAIL	  = $this->input->post('EMAIL');
			$PASSWORD = __password($this->input->post('PASSWORD'));

			$this->query = 	$this->db->where('LEMBAGA_EMAIL', $EMAIL)
							->where('LEMBAGA_PASSWORD', $PASSWORD)
							->get('LEMBAGA');

			if ($this->query->num_rows() == 0) 
			{
				$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Akun tidak tersedia</div>');

				redirect('lembaga/masuk');
			}
			else
			{
				$lembaga = $this->query->row();

				$array = array(
					'__ci_lembaga_id'    => $lembaga->LEMBAGA_ID,
					'__ci_lembaga_email' => $lembaga->LEMBAGA_EMAIL,
					'__ci_lembaga_nama'  => $lembaga->LEMBAGA_NAMA,
				);
				
				$this->session->set_userdata( $array );

				$this->session->set_flashdata('__alert', '<div class="alert alert-success alert-style">Selamat! Datang '.$lembaga->LEMBAGA_NAMA.'</div>');

				redirect('lembaga/dashboard');
			}
            
	}

	public function lembaga__keluar()
	{
		$this->is__login();

		$this->session->sess_destroy();

		$this->session->set_flashdata('__alert', '<div class="alert alert-success alert-style">Selamat! Data berhasil keluar</div>');

		redirect('lembaga/masuk');
	}
















	public function penerimaan()
	{
		$this->is__login();

		if ($this->uri->segment(3) == '' ) {
			redirect('lembaga/penerimaan/semua');
		}

		$this->load->model('M__nota');

		// Konfigurasi paginasi
		$config['base_url']        = base_url('lembaga/penerimaan/'.$this->uri->segment(3).'');
		if ($this->uri->segment(3) == 'semua') 
		{
			$config['total_rows']      = $this->db->where('LEMBAGA_ID', $this->session->userdata('__ci_lembaga_id'))->get('NOTA')->num_rows();
		}
		else
		{
			$config['total_rows']      = $this->db->where('LEMBAGA_ID', $this->session->userdata('__ci_lembaga_id'))->where('NOTA_STATUS',$this->uri->segment(3))->get('NOTA')->num_rows();
		}
		$config['per_page']        = (is_null($this->session->userdata('per_page')))? 10 : $this->session->userdata('per_page');
		
		$config['uri_segment']     = 4;
		$pilih                     = $config['total_rows'] / $config['per_page'];
		$config['num_links']       = floor($pilih);
		
		$this->pagination->initialize($config);

		$data['page']              = ($this->uri->segment(4))? $this->uri->segment(4) : 0 ;

		$data['keyword']        = $this->input->post('keyword');

		$this->M__nota->limit   = $config['per_page'];
		$this->M__nota->offset  = $data['page'];
		$this->M__nota->kolom   = $this->input->post('KOLOM');
		$this->M__nota->keyword = $this->input->post('keyword');
		$this->M__nota->id      = $this->session->userdata('__ci_lembaga_id');

		switch ( $this->uri->segment(3) ) {

			case 'proses':
				$this->M__nota->status  = 'PROSES';
				break;

			case 'terima':
				$this->M__nota->status  = 'TERIMA';
				break;
			
			default:
				$this->M__nota->status  = 'SEMUA';
				break;
		}
		
		$data['query_nota']        = $this->M__nota->showLembaga();
		
		$data['limit']             = $data['query_nota']->num_rows();
		$data['total_rows']        = $config['total_rows'];
		$data['paginasi']          = $this->pagination->create_links();
		$data['per_page']          = $config['per_page'];

		$source = array(
			'__title'   => APP_NAME . ' ~ Halaman Penerimaan Lembaga',
			'__menu'    => 'penerimaan',
			'__css'     => array('bootstrap','simpleicon','confirm','back'),
			'__js'      => array('jquery','bootstrap','confirm','back')
		);
	
		$data['__header']  = $this->load->view('lembaga/header', $source, TRUE);
		$data['__sidebar'] = $this->load->view('lembaga/sidebar', $source, TRUE);

		$this->load->view('lembaga/penerimaan/list', $data, FALSE);
	}

	public function penerimaanDetail()
	{
		$this->is__login();

		$id = $this->uri->segment(3);

		$data['query_nota'] = $this->db
		->where('NOTA_ID', $id)
		->get('NOTA');

		$source = array(
			'__title'   => APP_NAME . ' ~ Halaman Detail Penerimaan Lembaga',
			'__menu'    => 'penerimaan',
			'__css'     => array('bootstrap','simpleicon','back'),
			'__js'      => array('jquery','bootstrap','back')
		);
	
		$data['__header']  = $this->load->view('lembaga/header', $source, TRUE);
		$data['__sidebar'] = $this->load->view('lembaga/sidebar', $source, TRUE);

		$this->load->view('lembaga/penerimaan/detail', $data, FALSE);
	}

	public function penerimaanKonfirmasi()
	{
		$this->is__login();

		$id = $this->uri->segment(3);

		$data['query_nota'] = $this->db
		->where('NOTA_ID', $id)
		->get('NOTA');

		$source = array(
			'__title'   => APP_NAME . ' ~ Halaman Detail Penerimaan Lembaga',
			'__menu'    => 'penerimaan',
			'__css'     => array('bootstrap','simpleicon','back'),
			'__js'      => array('jquery','bootstrap','back')
		);
	
		$data['__header']  = $this->load->view('lembaga/header', $source, TRUE);
		$data['__sidebar'] = $this->load->view('lembaga/sidebar', $source, TRUE);

		$this->load->view('lembaga/penerimaan/konfirmasi', $data, FALSE);
	}

	public function penerimaan__konfirmasi_status()
	{
		$object = array(
			'NOTA_STATUS'     => 'TERIMA' ,
			'NOTA_TGL_TERIMA' => date('Y-m-d')
		);

		$this->db->where('NOTA_ID', $this->uri->segment(3))->update('NOTA', $object);

		redirect('lembaga/penerimaanDetail/'.$this->uri->segment(3).'');
	}

	public function penerimaan__konfirmasi1()
	{
		$config['upload_path']   = './uploads/lembaga/bukti/';
		$config['allowed_types'] = 'jpg|png';
		$config['max_size']      = '2000';

		$this->load->library('upload', $config);

		if($this->upload->do_upload('GMB1'))
		{
			$object = array(
				'NOTA_GMB1'   => $this->upload->data('file_name'),
			);

			$this->query = $this->db->where('NOTA_ID', $this->input->post('ID'))->update('NOTA', $object);

			if ($this->query) 
			{
				$this->session->set_flashdata('__alert', '<div class="alert alert-info alert-style">Berhasil di tambah</div>');
			}
			else
			{
				$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Terjadi kesalahan mohon mencoba kembali</div>');
			}
		}
		else
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Terjadi kesalahan pada file mohon mencoba kembali</div>');
		}
		
		redirect($this->kembali());
	}

	public function penerimaan__konfirmasi2()
	{
		$config['upload_path']   = './uploads/lembaga/bukti/';
		$config['allowed_types'] = 'jpg|png';
		$config['max_size']      = '2000';

		$this->load->library('upload', $config);

		if($this->upload->do_upload('GMB2'))
		{
			$object = array(
				'NOTA_GMB2'   => $this->upload->data('file_name'),
			);

			$this->query = $this->db->where('NOTA_ID', $this->input->post('ID'))->update('NOTA', $object);

			if ($this->query) 
			{
				$this->session->set_flashdata('__alert', '<div class="alert alert-info alert-style">Berhasil di tambah</div>');
			}
			else
			{
				$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Terjadi kesalahan mohon mencoba kembali</div>');
			}
		}
		else
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Terjadi kesalahan pada file mohon mencoba kembali</div>');
		}
		
		redirect($this->kembali());
	}

	public function penerimaan__konfirmasi3()
	{
		$config['upload_path']   = './uploads/lembaga/bukti/';
		$config['allowed_types'] = 'jpg|png';
		$config['max_size']      = '2000';

		$this->load->library('upload', $config);

		if($this->upload->do_upload('GMB3'))
		{
			$object = array(
				'NOTA_GMB3'   => $this->upload->data('file_name'),
			);

			$this->query = $this->db->where('NOTA_ID', $this->input->post('ID'))->update('NOTA', $object);

			if ($this->query) 
			{
				$this->session->set_flashdata('__alert', '<div class="alert alert-info alert-style">Berhasil di tambah</div>');
			}
			else
			{
				$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Terjadi kesalahan mohon mencoba kembali</div>');
			}
		}
		else
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Terjadi kesalahan pada file mohon mencoba kembali</div>');
		}
		
		redirect($this->kembali());
	}

	public function penerimaan__konfirmasi4()
	{
		$config['upload_path']   = './uploads/lembaga/bukti/';
		$config['allowed_types'] = 'jpg|png';
		$config['max_size']      = '2000';

		$this->load->library('upload', $config);

		if($this->upload->do_upload('GMB4'))
		{
			$object = array(
				'NOTA_GMB4'   => $this->upload->data('file_name'),
			);

			$this->query = $this->db->where('NOTA_ID', $this->input->post('ID'))->update('NOTA', $object);

			if ($this->query) 
			{
				$this->session->set_flashdata('__alert', '<div class="alert alert-info alert-style">Berhasil di tambah</div>');
			}
			else
			{
				$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Terjadi kesalahan mohon mencoba kembali</div>');
			}
		}
		else
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Terjadi kesalahan pada file mohon mencoba kembali</div>');
		}
		
		redirect($this->kembali());
	}



	public function penerimaan__konfirmasi1_del()
	{
		$GMB1 = $this->db->where('NOTA_ID', $this->uri->segment(3))->get('NOTA')->row()->NOTA_GMB1;

		@unlink('./uploads/lembaga/bukti/'.$GMB1.'');

		$object = array(
			'NOTA_GMB1' => NULL , );

		$this->db->where('NOTA_ID', $this->uri->segment(3))->update('NOTA', $object);

		redirect($this->kembali());
	}

	public function penerimaan__konfirmasi2_del()
	{
		$GMB2 = $this->db->where('NOTA_ID', $this->uri->segment(3))->get('NOTA')->row()->NOTA_GMB2;

		@unlink('./uploads/lembaga/bukti/'.$GMB2.'');

		$object = array(
			'NOTA_GMB2' => NULL , );

		$this->db->where('NOTA_ID', $this->uri->segment(3))->update('NOTA', $object);

		redirect($this->kembali());
	}

	public function penerimaan__konfirmasi3_del()
	{
		$GMB3 = $this->db->where('NOTA_ID', $this->uri->segment(3))->get('NOTA')->row()->NOTA_GMB3;

		@unlink('./uploads/lembaga/bukti/'.$GMB3.'');

		$object = array(
			'NOTA_GMB3' => NULL , );

		$this->db->where('NOTA_ID', $this->uri->segment(3))->update('NOTA', $object);

		redirect($this->kembali());
	}

	public function penerimaan__konfirmasi4_del()
	{
		$GMB4 = $this->db->where('NOTA_ID', $this->uri->segment(3))->get('NOTA')->row()->NOTA_GMB4;

		@unlink('./uploads/lembaga/bukti/'.$GMB4.'');

		$object = array(
			'NOTA_GMB4' => NULL , );

		$this->db->where('NOTA_ID', $this->uri->segment(3))->update('NOTA', $object);

		redirect($this->kembali());
	}

}

/* End of file Lembaga.php */
/* Location: ./application/controllers/Lembaga.php */