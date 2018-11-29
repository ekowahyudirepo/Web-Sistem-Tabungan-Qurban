<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here

		// 	Set Time Default "Indonesia"
		date_default_timezone_set('Asia/Jakarta');

		//	Load model
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
		if ( ! $this->session->userdata('__ci_admin_id') ) {
			redirect('admin/masuk');
		}
	}

	/**
	*	Digunakan untuk mengambil url sebelumnya 
	*/ 
	public function kembali()
	{

		return $this->input->server('HTTP_REFERER');
	}
	
	public function index()
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
			$kambing[] = $this->M__grafik->jml_kurban((!is_null($this->input->post('lembaga_id'))) ? $this->input->post('lembaga_id') : '',$res[$i],'KAMBING');
		}
		$sapi = [];
		for ($i=0; $i < count($res) ; $i++) { 
			$sapi[] = $this->M__grafik->jml_kurban((!is_null($this->input->post('lembaga_id'))) ? $this->input->post('lembaga_id') : '',$res[$i],'SAPI');
		}

		$data['res']     = $res;
		$data['kambing'] = $kambing;
		$data['sapi']    = $sapi;

		$data['query_hewan'] = $this->db->where('HEWAN_STATUS', 'TAMPIL')->get('HEWAN');
		$data['query_lembaga'] = $this->db->get('LEMBAGA');


		$source = array(
			'__title'   => APP_NAME . ' ~ Halaman Dashboard Admin',
			'__menu'    => 'dashboard',
			'__css'     => array('bootstrap','simpleicon','confirm','back'),
			'__js'      => array('jquery','bootstrap','chartjs','chartjsutils','confirm','back')
		);
	
		$data['__header']  = $this->load->view('admin/header', $source, TRUE);
		$data['__sidebar'] = $this->load->view('admin/sidebar', $source, TRUE);

		$this->load->view('admin/dashboard', $data, FALSE);
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
			$kambing[] = $this->M__grafik->jml_kurban((!is_null($this->input->post('lembaga_id'))) ? $this->input->post('lembaga_id') : '',$res[$i],'KAMBING');
		}
		$sapi = [];
		for ($i=0; $i < count($res) ; $i++) { 
			$sapi[] = $this->M__grafik->jml_kurban((!is_null($this->input->post('lembaga_id'))) ? $this->input->post('lembaga_id') : '',$res[$i],'SAPI');
		}

		$data['res']     = $res;
		$data['kambing'] = $kambing;
		$data['sapi']    = $sapi;

		$data['query_hewan'] = $this->db->where('HEWAN_STATUS', 'TAMPIL')->get('HEWAN');
		$data['query_lembaga'] = $this->db->get('LEMBAGA');


		$source = array(
			'__title'   => APP_NAME . ' ~ Halaman Dashboard Admin',
			'__menu'    => 'dashboard',
			'__css'     => array('bootstrap','simpleicon','confirm','back'),
			'__js'      => array('jquery','bootstrap','chartjs','chartjsutils','confirm','back')
		);
	
		$data['__header']  = $this->load->view('admin/header', $source, TRUE);
		$data['__sidebar'] = $this->load->view('admin/sidebar', $source, TRUE);

		$this->load->view('admin/dashboard', $data, FALSE);
	}


	public function masuk()
	{
		$data = array(
			'__title'   => APP_NAME . ' ~ Halaman Login Admin',
			'__css'     => array('bootstrap','simpleicon','back'),
			'__js'      => array('jquery','parsley'),

            'widget' => $this->recaptcha->getWidget(),
            'script' => $this->recaptcha->getScriptTag(),
        );

		$this->load->view('admin/login', $data, FALSE);
	}

	public function admin__masuk()
	{
		$recaptcha = $this->input->post('g-recaptcha-response');
         if (!empty($recaptcha)) 
         {
             $response = $this->recaptcha->verifyResponse($recaptcha);
             if (isset($response['success']) and $response['success'] === true) 
             {
             	$USERNAME = $this->input->post('USERNAME');
				$PASSWORD = __password($this->input->post('PASSWORD'));

								$this->db->where('ADMIN_USERNAME', $USERNAME);
								$this->db->where('ADMIN_PASSWORD', $PASSWORD);
				$this->query =  $this->db->get('ADMIN');

				if ($this->query->num_rows() == 0) 
				{
					$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Akun tidak tersedia</div>');

					redirect('admin/masuk');
				}
				else
				{
					$admin = $this->query->row();

					$array = array(
						'__ci_admin_id'    => $admin->ADMIN_ID,
						'__ci_admin_nama'  => $admin->ADMIN_NAMA,
					);
					
					$this->session->set_userdata( $array );

					$this->session->set_flashdata('__alert', '<div class="alert alert-success alert-style">Selamat! Datang '.$admin->ADMIN_NAMA.'</div>');

					redirect('admin');
				}
             }

         }
         else
         {
         	$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! CAPTCHA tidak sesuai</div>');

		    redirect('admin/masuk');
         }

        	$USERNAME = $this->input->post('USERNAME');
			$PASSWORD = __password($this->input->post('PASSWORD'));

			$this->query = 	$this->db->where('ADMIN_USERNAME', $USERNAME)
							->where('ADMIN_PASSWORD', $PASSWORD)
							->get('ADMIN');

			if ($this->query->num_rows() == 0) 
			{
				$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Akun tidak tersedia</div>');

				redirect('admin/masuk');
			}
			else
			{
				$admin = $this->query->row();

				$array = array(
					'__ci_admin_id'    => $admin->ADMIN_ID,
					'__ci_admin_nama'  => $admin->ADMIN_NAMA,
				);
				
				$this->session->set_userdata( $array );

				$this->session->set_flashdata('__alert', '<div class="alert alert-success alert-style">Selamat! Datang '.$admin->ADMIN_NAMA.'</div>');

				redirect('admin/dashboard');
			}
            
	}

	public function admin__keluar()
	{
		$this->is__login();

		$this->session->sess_destroy();

		$this->session->set_flashdata('__alert', '<div class="alert alert-success alert-style">Selamat! Data berhasil keluar</div>');

		redirect('admin/masuk');
	}












	public function lembaga()
	{
		$this->is__login();

		if ($this->uri->segment(3) == '' ) {
			redirect('admin/lembaga/semua');
		}

		$this->load->model('M__lembaga');

		// Konfigurasi paginasi
		$config['base_url']        = base_url('admin/lembaga/'.$this->uri->segment(3).'');
		if ($this->uri->segment(3) == 'semua') 
		{
			$config['total_rows']      = $this->db->get('LEMBAGA')->num_rows();
		}
		else
		{
			$config['total_rows']      = $this->db->where('LEMBAGA_STATUS',$this->uri->segment(3))->get('LEMBAGA')->num_rows();
		}
		$config['per_page']        = (is_null($this->session->userdata('per_page')))? 10 : $this->session->userdata('per_page');
		
		$config['uri_segment']     = 4;
		$pilih                     = $config['total_rows'] / $config['per_page'];
		$config['num_links']       = floor($pilih);
		
		$this->pagination->initialize($config);

		$data['page']              = ($this->uri->segment(4))? $this->uri->segment(4) : 0 ;

		$data['keyword'] = $this->input->post('keyword');

		$this->M__lembaga->limit   = $config['per_page'];
		$this->M__lembaga->offset  = $data['page'];
		$this->M__lembaga->kolom   = $this->input->post('KOLOM');
		$this->M__lembaga->keyword = $this->input->post('keyword');

		switch ( $this->uri->segment(3) ) {
			case 'tampil':
				$this->M__lembaga->status  = 'TAMPIL';
				break;

			case 'sembunyi':
				$this->M__lembaga->status  = 'SEMBUNYI';
				break;
			
			default:
				$this->M__lembaga->status  = 'SEMUA';
				break;
		}
		
		$data['query_lembaga']     = $this->M__lembaga->show();
		
		$data['limit']             = $data['query_lembaga']->num_rows();
		$data['total_rows']        = $config['total_rows'];
		$data['paginasi']          = $this->pagination->create_links();
		$data['per_page']          = $config['per_page'];


		$source = array(
			'__title'   => APP_NAME . ' ~ Halaman Manajemen Lembaga Admin',
			'__menu'    => 'lembaga',
			'__css'     => array('bootstrap','simpleicon','confirm','back'),
			'__js'      => array('jquery','bootstrap','checkall','__checkall','confirm','back')
		);
	
		$data['__header']  = $this->load->view('admin/header', $source, TRUE);
		$data['__sidebar'] = $this->load->view('admin/sidebar', $source, TRUE);

		$this->load->view('admin/lembaga/list', $data, FALSE);
	}

	public function lembagaTambah()
	{
		$source = array(
			'__title'   => APP_NAME . ' ~ Halaman Manajemen Lembaga Admin',
			'__menu'    => 'lembaga',
			'__css'     => array('bootstrap','simpleicon','confirm','back'),
			'__js'      => array('jquery','bootstrap','parsley','confirm','back')
		);
	
		$data['__header']  = $this->load->view('admin/header', $source, TRUE);
		$data['__sidebar'] = $this->load->view('admin/sidebar', $source, TRUE);

		$this->load->view('admin/lembaga/tambah', $data, FALSE);
	}

	public function lembaga__add()
	{
		$object = array(
			'LEMBAGA_ID'       => '' , 
			'LEMBAGA_NAMA'     => strtoupper($this->input->post('NAMA')) , 
			'LEMBAGA_HP'       => $this->input->post('HP') , 
			'LEMBAGA_EMAIL'    => $this->input->post('EMAIL') , 
			'LEMBAGA_PASSWORD' => __password($this->input->post('EMAIL') ) ,
			'LEMBAGA_ALAMAT'   => strtoupper($this->input->post('ALAMAT')) ,
			'LEMBAGA_LAT'      => strtoupper($this->input->post('LAT')) , 
			'LEMBAGA_LONG'     => strtoupper($this->input->post('LONG')) ,
			'LEMBAGA_STATUS'     => 'SEMBUNYI' ,
		);

		$this->query = $this->db->insert('LEMBAGA', $object);

		if ($this->query) 
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-success alert-style">Selamat! Data berhasil ditambah</div>');
		}
		else
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Data gagal ditambah, coba lagi</div>');
			
		}

		redirect( $this->kembali() );
	}

	public function lembagaEdit()
	{
		$this->is__login(); 

		$id = $this->uri->segment(3);

		$data['query_lembaga'] = $this->db->where('LEMBAGA_ID', $id )->get('LEMBAGA');

		$source = array(
			'__title'   => APP_NAME . ' ~ Halaman Manajemen Lembaga Admin',
			'__menu'    => 'lembaga',
			'__css'     => array('bootstrap','simpleicon','confirm','back'),
			'__js'      => array('jquery','bootstrap','parsley','confirm','back')
		);
	
		$data['__header']  = $this->load->view('admin/header', $source, TRUE);
		$data['__sidebar'] = $this->load->view('admin/sidebar', $source, TRUE);

		$this->load->view('admin/lembaga/edit', $data, FALSE);
	}

	public function lembaga__up()
	{
		$this->is__login();

		$id = $this->input->post('ID');

		$object = array(
			'LEMBAGA_NAMA'     => strtoupper($this->input->post('NAMA')) , 
			'LEMBAGA_HP'       => $this->input->post('HP') , 
			'LEMBAGA_EMAIL'    => $this->input->post('EMAIL') , 
			'LEMBAGA_PASSWORD' => __password($this->input->post('EMAIL') ) ,
			'LEMBAGA_ALAMAT'   => strtoupper($this->input->post('ALAMAT')) , 
			'LEMBAGA_LAT'      => strtoupper($this->input->post('LAT')) , 
			'LEMBAGA_LONG'   => strtoupper($this->input->post('LONG')) ,
		);

		$this->query = $this->db->where('LEMBAGA_ID', $id )->update('LEMBAGA', $object);

		if ($this->query) 
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-success alert-style">Selamat! Data berhasil dirubah</div>');
		}
		else
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Data gagal dirubah, coba lagi</div>');
			
		}

		redirect( $this->kembali() );
	}

	public function lembaga__status()
	{
		$this->is__login();

		$id = array();

		$id = $this->input->post('pilih');

		$object = array('LEMBAGA_STATUS' => strtoupper($this->uri->segment(3)));

		for($i=0;$i<count($id);$i++){

			$this->query = $this->db
							->where('LEMBAGA_ID', $id[$i])
							->update('LEMBAGA', $object);

		}

		if ($this->query) 
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-success alert-style">Selamat! Data berhasil dirubah</div>');
		}
		else
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Data gagal dirubah, coba lagi</div>');
			
		}

		redirect( $this->kembali() );
	}












	public function member()
	{
		$this->is__login();

		if ($this->uri->segment(3) == '' ) {
			redirect('admin/member/semua');
		}

		$this->load->model('M__member');

		// Konfigurasi paginasi
		$config['base_url']        = base_url('admin/member/'.$this->uri->segment(3).'');
		if ($this->uri->segment(3) == 'semua') 
		{
			$config['total_rows']      = $this->db->get('MEMBER')->num_rows();
		}
		else
		{
			$config['total_rows']      = $this->db->where('MEMBER_STATUS',$this->uri->segment(3))->get('MEMBER')->num_rows();
		}
		$config['per_page']        = (is_null($this->session->userdata('per_page')))? 10 : $this->session->userdata('per_page');
		
		$config['uri_segment']     = 4;
		$pilih                     = $config['total_rows'] / $config['per_page'];
		$config['num_links']       = floor($pilih);
		
		$this->pagination->initialize($config);

		$data['page']              = ($this->uri->segment(4))? $this->uri->segment(4) : 0 ;
		$data['keyword']           = $this->input->post('keyword');
		
		$this->M__member->limit    = $config['per_page'];
		$this->M__member->offset   = $data['page'];
		$this->M__member->kolom    = $this->input->post('KOLOM');
		$this->M__member->keyword  = $this->input->post('keyword');

		switch ( $this->uri->segment(3) ) {
			case 'baru':
				$this->M__member->status  = 'BARU';
				break;

			case 'aktif':
				$this->M__member->status  = 'AKTIF';
				break;

			case 'blokir':
				$this->M__member->status  = 'BLOKIR';
				break;
			
			default:
				$this->M__member->status  = 'SEMUA';
				break;
		}
		
		$data['query_member']      = $this->M__member->show();
		
		$data['limit']             = $data['query_member']->num_rows();
		$data['total_rows']        = $config['total_rows'];
		$data['paginasi']          = $this->pagination->create_links();
		$data['per_page']          = $config['per_page'];


		$source = array(
			'__title'   => APP_NAME . ' ~ Halaman Manajemen Member Admin',
			'__menu'    => 'member',
			'__css'     => array('bootstrap','simpleicon','confirm','back'),
			'__js'      => array('jquery','bootstrap','checkall','__checkall','confirm','back')
		);
	
		$data['__header']  = $this->load->view('admin/header', $source, TRUE);
		$data['__sidebar'] = $this->load->view('admin/sidebar', $source, TRUE);

		$this->load->view('admin/member/list', $data, FALSE);
	}

	public function member__status()
	{
		$this->is__login();
		
		$id     = array();
		
		$id     = $this->input->post('pilih');
		
		$object = array('MEMBER_STATUS' => strtoupper($this->uri->segment(3)));

		for($i=0;$i<count($id);$i++){

			$this->query = $this->db
							->where('MEMBER_ID', $id[$i])
							->update('MEMBER', $object);

		}

		redirect( $this->kembali() );
	}

	public function memberDetail()
	{
		$this->load->model('M__tabungan');

		$data['query_mem'] = $this->db->where('MEMBER_ID', $this->uri->segment(3))->get('MEMBER');
		$source = array(
			'__title'   => APP_NAME . ' ~ Halaman Manajemen Member Admin',
			'__menu'    => 'member',
			'__css'     => array('bootstrap','simpleicon','confirm','back'),
			'__js'      => array('jquery','bootstrap','confirm','back')
		);
	
		$data['__header']  = $this->load->view('admin/header', $source, TRUE);
		$data['__sidebar'] = $this->load->view('admin/sidebar', $source, TRUE);

		$this->load->view('admin/member/detail', $data, FALSE);
	}

	public function memberValidasi()
	{
		$id = $this->uri->segment(3);

		$object = array('MEMBER_STATUS' => 'AKTIF' );

		$this->db->where('MEMBER_ID', $id )->update('MEMBER', $object);

		redirect($this->kembali());
	}

	public function memberTabungan()
	{
		$this->is__login();

		if ( $this->uri->segment(4) == '' ) {
			redirect('admin/memberTabungan/'.$this->uri->segment(3).'/semua');
		}

		if ($this->uri->segment(3) == '' ) {
			redirect('admin/member/semua');
		}

		$this->load->model('M__tabungan');

		// Konfigurasi paginasi
		$config['base_url']        = base_url('admin/memberTabungan/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'');
		if ($this->uri->segment(4) == 'semua') 
		{
			$config['total_rows']      = $this->db->where('MEMBER_ID', $this->uri->segment(3))->get('TABUNGAN')->num_rows();
		}
		else
		{
			$config['total_rows']      = $this->db->where('MEMBER_ID', $this->uri->segment(3))->where('TABUNGAN_STATUS',$this->uri->segment(4))->get('TABUNGAN')->num_rows();
		}
		$config['per_page']        = (is_null($this->session->userdata('per_page')))? 10 : $this->session->userdata('per_page');
		
		$config['uri_segment']     = 5;
		$pilih                     = $config['total_rows'] / $config['per_page'];
		$config['num_links']       = floor($pilih);
		
		$this->pagination->initialize($config);

		$data['page']              = ($this->uri->segment(4))? $this->uri->segment(5) : 0 ;

		$data['keyword'] = $this->input->post('keyword');

		$this->M__tabungan->limit   = $config['per_page'];
		$this->M__tabungan->offset  = $data['page'];
		$this->M__tabungan->kolom   = $this->input->post('KOLOM');
		$this->M__tabungan->keyword = $this->input->post('keyword');
		$this->M__tabungan->id      = $this->uri->segment(3);
		switch ( $this->uri->segment(4) ) {
			case 'proses':
				$this->M__tabungan->status  = 'PROSES';
				break;

			case 'terima':
				$this->M__tabungan->status  = 'TERIMA';
				break;

			case 'tolak':
				$this->M__tabungan->status  = 'TOLAK';
				break;
			
			default:
				$this->M__tabungan->status  = 'SEMUA';
				break;
		}
		
		$data['query_tabungan']     = $this->M__tabungan->show();
		
		$data['limit']             = $data['query_tabungan']->num_rows();
		$data['total_rows']        = $config['total_rows'];
		$data['paginasi']          = $this->pagination->create_links();
		$data['per_page']          = $config['per_page'];


		$source = array(
			'__title'   => APP_NAME . ' ~ Halaman Manajemen Tabungan Admin',
			'__menu'    => 'member',
			'__css'     => array('bootstrap','simpleicon','confirm','back'),
			'__js'      => array('jquery','bootstrap','confirm','back')
		);
	
		$data['__header']  = $this->load->view('admin/header', $source, TRUE);
		$data['__sidebar'] = $this->load->view('admin/sidebar', $source, TRUE);

		$this->load->view('admin/member/tabungan', $data, FALSE);
	}









	public function tabungan()
	{
		$this->is__login();

		if ($this->uri->segment(3) == '' ) {
			redirect('admin/tabungan/semua');
		}

		$this->load->model('M__tabungan');

		// Konfigurasi paginasi
		$config['base_url']        = base_url('admin/tabungan/'.$this->uri->segment(3).'');
		if ($this->uri->segment(3) == 'semua') 
		{
			$config['total_rows']      = $this->db->get('TABUNGAN')->num_rows();
		}
		else
		{
			$config['total_rows']      = $this->db->where('TABUNGAN_STATUS',$this->uri->segment(3))->get('TABUNGAN')->num_rows();
		}
		$config['per_page']        = (is_null($this->session->userdata('per_page')))? 10 : $this->session->userdata('per_page');
		
		$config['uri_segment']     = 4;
		$pilih                     = $config['total_rows'] / $config['per_page'];
		$config['num_links']       = floor($pilih);
		
		$this->pagination->initialize($config);

		$data['page']              = ($this->uri->segment(4))? $this->uri->segment(4) : 0 ;

		$data['keyword'] = $this->input->post('keyword');

		$this->M__tabungan->limit   = $config['per_page'];
		$this->M__tabungan->offset  = $data['page'];
		$this->M__tabungan->kolom   = $this->input->post('KOLOM');
		$this->M__tabungan->keyword = $this->input->post('keyword');

		switch ( $this->uri->segment(3) ) {

			case 'proses':
				$this->M__tabungan->status  = 'PROSES';
				break;

			case 'terima':
				$this->M__tabungan->status  = 'TERIMA';
				break;

			case 'tolak':
				$this->M__tabungan->status  = 'TOLAK';
				break;
			
			default:
				$this->M__tabungan->status  = 'SEMUA';
				break;
		}
		
		$data['query_tabungan']     = $this->M__tabungan->show();
		
		$data['limit']             = $data['query_tabungan']->num_rows();
		$data['total_rows']        = $config['total_rows'];
		$data['paginasi']          = $this->pagination->create_links();
		$data['per_page']          = $config['per_page'];


		$source = array(
			'__title'   => APP_NAME . ' ~ Halaman Manajemen Tabungan Admin',
			'__menu'    => 'tabungan',
			'__css'     => array('bootstrap','simpleicon','confirm','back'),
			'__js'      => array('jquery','bootstrap','confirm','back')
		);
	
		$data['__header']  = $this->load->view('admin/header', $source, TRUE);
		$data['__sidebar'] = $this->load->view('admin/sidebar', $source, TRUE);

		$this->load->view('admin/tabungan/list', $data, FALSE);
	}

	public function tabunganDetail()
	{
		$this->is__login();

		$id = $this->uri->segment(3);

		$data['query_tab'] = $this->db
		->where('TABUNGAN_ID', $id)
		->get('TABUNGAN');

		$source = array(
			'__title'   => APP_NAME . ' ~ Halaman Manajemen Tabungan Admin',
			'__menu'    => 'tabungan',
			'__css'     => array('bootstrap','simpleicon','confirm','back'),
			'__js'      => array('jquery','bootstrap','confirm','back')
		);
	
		$data['__header']  = $this->load->view('admin/header', $source, TRUE);
		$data['__sidebar'] = $this->load->view('admin/sidebar', $source, TRUE);

		$this->load->view('admin/tabungan/detail', $data, FALSE);
	}

	public function tabunganValidasi()
	{
		$this->is__login();

		$id = $this->uri->segment(3);

		$data['query_tab'] = $this->db
		->where('TABUNGAN_ID', $id)
		->get('TABUNGAN');

		$source = array(
			'__title'   => APP_NAME . ' ~ Halaman Manajemen Tabungan Admin',
			'__menu'    => 'tabungan',
			'__css'     => array('bootstrap','simpleicon','confirm','back'),
			'__js'      => array('jquery','bootstrap','confirm','back')
		);
	
		$data['__header']  = $this->load->view('admin/header', $source, TRUE);
		$data['__sidebar'] = $this->load->view('admin/sidebar', $source, TRUE);

		$this->load->view('admin/tabungan/validasi', $data, FALSE);
	}

	public function tabungan__validasi_status()
	{
		$this->is__login();

		$id = array();

		$id = $this->input->post('ID');

		$object = array(
			'TABUNGAN_STATUS'  => $this->input->post('STATUS') ,
			'TABUNGAN_CATATAN' => $this->input->post('CATATAN') ,
		);

		$this->query = $this->db
							->where('TABUNGAN_ID', $id)
							->update('TABUNGAN', $object);
							
		$tab = $this->db
					->where('TABUNGAN.TABUNGAN_ID', $id)
					->join('MEMBER', 'MEMBER.MEMBER_ID = TABUNGAN.MEMBER_ID', 'left')
					->get('TABUNGAN')->row();

		if ($this->query) 
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-success alert-style">Selamat! Data berhasil divalidasi</div>');
			
			$from   = $this->db->get('INFO')->row()->INFO_EMAIL;
			$to     = $tab->MEMBER_EMAIL;
			$subjek = 'TAMBAH SALDO TABUNGAN';

			$pesan  = '<h1>TAMBAH SALDO TABUNGAN</h1>';
			$pesan .= '<p>Assalamu\'alaikum wr. wb</p>';
			$pesan .= '<p>Tabungan anda sejumlah '.__rp($tab->TABUNGAN_NOMINAL).' dengan tanggal tambah tabungan '.__tgl_dmy($tab->TABUNGAN_TGL).' <b>DI'.$tab->TABUNGAN_STATUS.'</b></p>';
			$pesan .= '<p>Catatan : '.$tab->TABUNGAN_CATATAN.'<p>';
			$pesan .= '<p>Terus tingkatkan tabungan dan raih qurban impian anda.</p><br><br>';
			$pesan .= '<p>Demikian informasi dari kami, terima kasih atas perhatiannya.</p>';
			$pesan .= '<p>Wassalamu\'alaikum wr. wb</p>';

			$this->load->library('email');
            
            $config['mailtype'] = 'html';
            $this->email->initialize($config);
            $this->email->to($to);
            $this->email->from($from,'no_reply.cs@qurbanapp.com');
            $this->email->subject($subjek);
            $this->email->message($pesan);
            $this->email->send();
		}
		else
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Data gagal divalidasi, coba lagi</div>');
			
		}

		redirect('admin/tabunganDetail/'.$id.'');
	}








	public function pembelian()
	{
		$this->is__login();

		if ($this->uri->segment(3) == '' ) {
			redirect('admin/pembelian/semua');
		}

		$this->load->model('M__nota');

		// Konfigurasi paginasi
		$config['base_url']        = base_url('admin/pembelian/'.$this->uri->segment(3).'');
		if ($this->uri->segment(3) == 'semua') 
		{
			$config['total_rows']      = $this->db->get('NOTA')->num_rows();
		}
		else
		{
			$config['total_rows']      = $this->db->where('NOTA_STATUS',$this->uri->segment(3))->get('NOTA')->num_rows();
		}
		$config['per_page']        = (is_null($this->session->userdata('per_page')))? 10 : $this->session->userdata('per_page');
		
		$config['uri_segment']     = 4;
		$pilih                     = $config['total_rows'] / $config['per_page'];
		$config['num_links']       = floor($pilih);
		
		$this->pagination->initialize($config);

		$data['page']              = ($this->uri->segment(4))? $this->uri->segment(4) : 0 ;

		$data['keyword'] = $this->input->post('keyword');

		$this->M__nota->limit   = $config['per_page'];
		$this->M__nota->offset  = $data['page'];
		$this->M__nota->kolom   = $this->input->post('KOLOM');
		$this->M__nota->keyword = $this->input->post('keyword');

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
		
		$data['query_nota']        = $this->M__nota->show();
		
		$data['limit']             = $data['query_nota']->num_rows();
		$data['total_rows']        = $config['total_rows'];
		$data['paginasi']          = $this->pagination->create_links();
		$data['per_page']          = $config['per_page'];


		$source = array(
			'__title'   => APP_NAME . ' ~ Halaman Manajemen Pembelian Admin',
			'__menu'    => 'pembelian',
			'__css'     => array('bootstrap','simpleicon','confirm','back'),
			'__js'      => array('jquery','bootstrap','confirm','back')
		);
	
		$data['__header']  = $this->load->view('admin/header', $source, TRUE);
		$data['__sidebar'] = $this->load->view('admin/sidebar', $source, TRUE);

		$this->load->view('admin/pembelian/list', $data, FALSE);
	}

	public function pembelianDetail()
	{
		$this->is__login();

		$id = $this->uri->segment(3);

		$data['query_nota'] = $this->db
		->where('NOTA_ID', $id)
		->get('NOTA');

		$source = array(
			'__title'   => APP_NAME . ' ~ Halaman Manajemen Pembelian Admin',
			'__menu'    => 'pembelian',
			'__css'     => array('bootstrap','simpleicon','confirm','back'),
			'__js'      => array('jquery','bootstrap','confirm','back')
		);
	
		$data['__header']  = $this->load->view('admin/header', $source, TRUE);
		$data['__sidebar'] = $this->load->view('admin/sidebar', $source, TRUE);

		$this->load->view('admin/pembelian/detail', $data, FALSE);
	}

	



	public function hewan()
	{
		$this->is__login();

		if ($this->uri->segment(3) == '' ) {
			redirect('admin/hewan/semua');
		}

		$this->load->model('M__hewan');

		// Konfigurasi paginasi
		$config['base_url']        = base_url('admin/hewan/'.$this->uri->segment(3).'');
		if ($this->uri->segment(3) == 'semua') 
		{
			$config['total_rows']      = $this->db->get('HEWAN')->num_rows();
		}
		else
		{
			$config['total_rows']      = $this->db->where('HEWAN_STATUS',$this->uri->segment(3))->get('HEWAN')->num_rows();
		}
		$config['per_page']        = (is_null($this->session->userdata('per_page')))? 10 : $this->session->userdata('per_page');
		
		$config['uri_segment']     = 4;
		$pilih                     = $config['total_rows'] / $config['per_page'];
		$config['num_links']       = floor($pilih);
		
		$this->pagination->initialize($config);

		$data['page']              = ($this->uri->segment(4))? $this->uri->segment(4) : 0 ;

		$data['keyword'] = $this->input->post('keyword');

		$this->M__hewan->limit   = $config['per_page'];
		$this->M__hewan->offset  = $data['page'];
		$this->M__hewan->kolom   = $this->input->post('KOLOM');
		$this->M__hewan->keyword = $this->input->post('keyword');

		switch ( $this->uri->segment(3) ) {
			case 'tampil':
				$this->M__hewan->status  = 'TAMPIL';
				break;

			case 'sembunyi':
				$this->M__hewan->status  = 'SEMBUNYI';
				break;
			
			default:
				$this->M__hewan->status  = 'SEMUA';
				break;
		}
		
		$data['query_hewan']     = $this->M__hewan->show();
		
		$data['limit']             = $data['query_hewan']->num_rows();
		$data['total_rows']        = $config['total_rows'];
		$data['paginasi']          = $this->pagination->create_links();
		$data['per_page']          = $config['per_page'];


		$source = array(
			'__title'   => APP_NAME . ' ~ Halaman Manajemen Harga Hewan Admin',
			'__menu'    => 'hewan',
			'__css'     => array('bootstrap','simpleicon','confirm','back'),
			'__js'      => array('jquery','bootstrap','checkall','__checkall','confirm','back')
		);
	
		$data['__header']  = $this->load->view('admin/header', $source, TRUE);
		$data['__sidebar'] = $this->load->view('admin/sidebar', $source, TRUE);

		$this->load->view('admin/hewan/list', $data, FALSE);
	}

	public function hewanTambah()
	{
		$source = array(
			'__title'   => APP_NAME . ' ~ Halaman Manajemen Harga Hewan Admin',
			'__menu'    => 'hewan',
			'__css'     => array('bootstrap','simpleicon','parsley','confirm','back'),
			'__js'      => array('jquery','bootstrap','parsley','maskmoney','confirm','back')
		);
	
		$data['__header']  = $this->load->view('admin/header', $source, TRUE);
		$data['__sidebar'] = $this->load->view('admin/sidebar', $source, TRUE);

		$this->load->view('admin/hewan/tambah', $data, FALSE);
	}

	public function hewan__add()
	{
		$object = array(
			'HEWAN_ID'       => '' , 
			'HEWAN_NAMA'     => strtoupper($this->input->post('NAMA')) ,
			'HEWAN_JENIS'    => strtoupper($this->input->post('JENIS')) ,  
			'HEWAN_HARGA'    => str_replace(array('.',',00','Rp',' '), '',$this->input->post('HARGA')) , 
			'HEWAN_BERAT'    => strtoupper($this->input->post('BERAT')) ,
			'HEWAN_URUT'     => strtoupper($this->input->post('URUT')) , 
			'HEWAN_STATUS'   => 'SEMBUNYI' , 
			'HEWAN_ADD'      => time()
		);

		$this->query = $this->db->insert('HEWAN', $object);

		if ($this->query) 
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-success alert-style">Selamat! Data berhasil ditambah</div>');
		}
		else
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Data gagal ditambah, coba lagi</div>');
			
		}

		redirect( $this->kembali() );
	}

	public function hewanEdit()
	{
		$this->is__login(); 

		$id = $this->uri->segment(3);

		if( $this->db->where('HEWAN_ID', $id)->get('KERANJANG')->num_rows() != 0 ){

			$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Data tidak dizinkan untuk dirubah</div>');

			redirect('admin/hewan');

		}

		$data['query_hewan'] = $this->db->where('HEWAN_ID', $id )->get('HEWAN');

		$source = array(
			'__title'   => APP_NAME . ' ~ Halaman Manajemen Harga Hewan Admin',
			'__menu'    => 'hewan',
			'__css'     => array('bootstrap','simpleicon','parsley','confirm','back'),
			'__js'      => array('jquery','bootstrap','parsley','maskmoney','confirm','back')
		);
	
		$data['__header']  = $this->load->view('admin/header', $source, TRUE);
		$data['__sidebar'] = $this->load->view('admin/sidebar', $source, TRUE);

		$this->load->view('admin/hewan/edit', $data, FALSE);
	}

	public function hewan__up()
	{
		$this->is__login();

		$id = $this->input->post('ID');

		$object = array(
			'HEWAN_NAMA'     => strtoupper($this->input->post('NAMA')) , 
			'HEWAN_JENIS'    => strtoupper($this->input->post('JENIS')) , 
			'HEWAN_HARGA'    => str_replace(array('.',',00','Rp',' '), '',$this->input->post('HARGA')) , 
			'HEWAN_BERAT'    => strtoupper($this->input->post('BERAT')) ,  
			'HEWAN_URUT'     => strtoupper($this->input->post('URUT')) ,
		);
		
		$this->query = $this->db->where('HEWAN_ID', $id )->update('HEWAN', $object);

		if ($this->query) 
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-success alert-style">Selamat! Data berhasil dirubah</div>');
		}
		else
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Data gagal dirubah, coba lagi</div>');
			
		}

		redirect( $this->kembali() );
	}

	public function hewan__status()
	{
		$this->is__login();

		$id = array();

		$id = $this->input->post('pilih');

		$object = array('HEWAN_STATUS' => strtoupper($this->uri->segment(3)));

		for($i=0;$i<count($id);$i++){

			$this->query = $this->db
							->where('HEWAN_ID', $id[$i])
							->update('HEWAN', $object);

		}

		if ($this->query) 
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-success alert-style">Selamat! Data berhasil dirubah</div>');
		}
		else
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Data gagal dirubah, coba lagi</div>');
			
		}

		redirect( $this->kembali() );
	}







	public function rekening()
	{
		$this->is__login();

		if ($this->uri->segment(3) == '' ) {
			redirect('admin/rekening/semua');
		}

		$this->load->model('M__rekening');

		// Konfigurasi paginasi
		$config['base_url']        = base_url('admin/rekening/'.$this->uri->segment(3).'');
		if ($this->uri->segment(3) == 'semua') 
		{
			$config['total_rows']      = $this->db->get('REKENING')->num_rows();
		}
		else
		{
			$config['total_rows']      = $this->db->where('REKENING_STATUS',$this->uri->segment(3))->get('REKENING')->num_rows();
		}
		$config['per_page']        = (is_null($this->session->userdata('per_page')))? 10 : $this->session->userdata('per_page');
		
		$config['uri_segment']     = 4;
		$pilih                     = $config['total_rows'] / $config['per_page'];
		$config['num_links']       = floor($pilih);
		
		$this->pagination->initialize($config);

		$data['page']              = ($this->uri->segment(4))? $this->uri->segment(4) : 0 ;

		$data['keyword'] = $this->input->post('keyword');

		$this->M__rekening->limit   = $config['per_page'];
		$this->M__rekening->offset  = $data['page'];
		$this->M__rekening->kolom   = $this->input->post('KOLOM');
		$this->M__rekening->keyword = $this->input->post('keyword');

		switch ( $this->uri->segment(3) ) {
			case 'tampil':
				$this->M__rekening->status  = 'TAMPIL';
				break;

			case 'sembunyi':
				$this->M__rekening->status  = 'SEMBUNYI';
				break;
			
			default:
				$this->M__rekening->status  = 'SEMUA';
				break;
		}
		
		$data['query_rekening']     = $this->M__rekening->show();
		
		$data['limit']             = $data['query_rekening']->num_rows();
		$data['total_rows']        = $config['total_rows'];
		$data['paginasi']          = $this->pagination->create_links();
		$data['per_page']          = $config['per_page'];


		$source = array(
			'__title'   => APP_NAME . ' ~ Halaman Manajemen Rekening Admin',
			'__menu'    => 'pengaturan',
			'__css'     => array('bootstrap','simpleicon','confirm','back'),
			'__js'      => array('jquery','bootstrap','checkall','__checkall','confirm','back')
		);
	
		$data['__header']  = $this->load->view('admin/header', $source, TRUE);
		$data['__sidebar'] = $this->load->view('admin/sidebar', $source, TRUE);

		$this->load->view('admin/rekening/list', $data, FALSE);
	}

	public function rekeningTambah()
	{
		$source = array(
			'__title'   => APP_NAME . ' ~ Halaman Manajemen Rekening Admin',
			'__menu'    => 'pengaturan',
			'__css'     => array('bootstrap','simpleicon','confirm','back'),
			'__js'      => array('jquery','bootstrap','confirm','back')
		);
	
		$data['__header']  = $this->load->view('admin/header', $source, TRUE);
		$data['__sidebar'] = $this->load->view('admin/sidebar', $source, TRUE);

		$this->load->view('admin/rekening/tambah', $data, FALSE);
	}

	public function rekening__add()
	{
		$object = array(
			'REKENING_ID'     => '' , 
			'REKENING_NAMA'   => strtoupper($this->input->post('NAMA')) , 
			'REKENING_NO'     => $this->input->post('NO') , 
			'REKENING_AN'     => strtoupper($this->input->post('AN')) , 
			'REKENING_STATUS' => 'SEMBUNYI' ,
			'REKENING_ADD'    => time(), 
		);

		$this->query = $this->db->insert('REKENING', $object);

		if ($this->query) 
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-success alert-style">Selamat! Data berhasil ditambah</div>');
		}
		else
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Data gagal ditambah, coba lagi</div>');
			
		}

		redirect( $this->kembali() );
	}

	public function rekeningEdit()
	{
		$this->is__login(); 

		$id = $this->uri->segment(3);

		$data['query_rekening'] = $this->db->where('REKENING_ID', $id )->get('REKENING');

		$source = array(
			'__title'   => APP_NAME . ' ~ Halaman Manajemen Rekening Admin',
			'__menu'    => 'pengaturan',
			'__css'     => array('bootstrap','simpleicon','confirm','back'),
			'__js'      => array('jquery','bootstrap','confirm','back')
		);
	
		$data['__header']  = $this->load->view('admin/header', $source, TRUE);
		$data['__sidebar'] = $this->load->view('admin/sidebar', $source, TRUE);

		$this->load->view('admin/rekening/edit', $data, FALSE);
	}

	public function rekening__up()
	{
		$this->is__login();

		$id = $this->input->post('ID');

		$object = array(
			'REKENING_NAMA'   => strtoupper($this->input->post('NAMA')) , 
			'REKENING_NO'     => $this->input->post('NO') , 
			'REKENING_AN'     => strtoupper($this->input->post('AN')) ,
		);

		$this->query = $this->db->where('REKENING_ID', $id )->update('REKENING', $object);

		if ($this->query) 
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-success alert-style">Selamat! Data berhasil dirubah</div>');
		}
		else
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Data gagal dirubah, coba lagi</div>');
			
		}

		redirect( $this->kembali() );
	}

	public function rekening__status()
	{
		$this->is__login();

		$id = array();

		$id = $this->input->post('pilih');

		$object = array('REKENING_STATUS' => strtoupper($this->uri->segment(3)));

		for($i=0;$i<count($id);$i++){

			$this->query = $this->db
							->where('REKENING_ID', $id[$i])
							->update('REKENING', $object);

		}

		if ($this->query) 
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-success alert-style">Selamat! Data berhasil dirubah</div>');
		}
		else
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Data gagal dirubah, coba lagi</div>');
			
		}

		redirect( $this->kembali() );
	}







	public function saran()
	{
		$this->is__login();

		if ($this->uri->segment(3) == '' ) {
			redirect('admin/saran/semua');
		}

		$this->load->model('M__saran');

		// Konfigurasi paginasi
		$config['base_url']        = base_url('admin/saran/'.$this->uri->segment(3).'');
		if ($this->uri->segment(3) == 'semua') 
		{
			$config['total_rows']      = $this->db->get('SARAN')->num_rows();
		}
		else
		{
			$config['total_rows']      = $this->db->where('SARAN_STATUS',$this->uri->segment(3))->get('SARAN')->num_rows();
		}
		$config['per_page']        = (is_null($this->session->userdata('per_page')))? 10 : $this->session->userdata('per_page');
		
		$config['uri_segment']     = 4;
		$pilih                     = $config['total_rows'] / $config['per_page'];
		$config['num_links']       = floor($pilih);
		
		$this->pagination->initialize($config);

		$data['page']              = ($this->uri->segment(4))? $this->uri->segment(4) : 0 ;

		$data['keyword'] = $this->input->post('keyword');

		$this->M__saran->limit   = $config['per_page'];
		$this->M__saran->offset  = $data['page'];
		$this->M__saran->kolom   = $this->input->post('KOLOM');
		$this->M__saran->keyword = $this->input->post('keyword');
		switch ( $this->uri->segment(3) ) {
			case 'baru':
				$this->M__saran->status  = 'BELUM';
				break;

			case 'sudah':
				$this->M__saran->status  = 'SUDAH';
				break;
			
			default:
				$this->M__saran->status  = 'SEMUA';
				break;
		}
		
		
		$data['query_saran']     = $this->M__saran->show();
		
		$data['limit']             = $data['query_saran']->num_rows();
		$data['total_rows']        = $config['total_rows'];
		$data['paginasi']          = $this->pagination->create_links();
		$data['per_page']          = $config['per_page'];


		$source = array(
			'__title'   => APP_NAME . ' ~ Halaman Manajemen Saran Admin',
			'__menu'    => 'saran',
			'__css'     => array('bootstrap','simpleicon','confirm','back'),
			'__js'      => array('jquery','bootstrap','confirm','back')
		);
	
		$data['__header']  = $this->load->view('admin/header', $source, TRUE);
		$data['__sidebar'] = $this->load->view('admin/sidebar', $source, TRUE);

		$this->load->view('admin/saran/list', $data, FALSE);
	}

	public function saranBaca()
	{
		$id = $this->uri->segment(3);

		$data['query_saran'] = $this->db
		->where('SARAN_ID', $id)
		->get('SARAN');

		$object = array('SARAN_STATUS' => 'SUDAH');
		$this->db
		->where('SARAN_ID', $id)
		->update('SARAN', $object);

		$source = array(
			'__title'   => APP_NAME . ' ~ Halaman Manajemen Saran Admin',
			'__menu'    => 'saran',
			'__css'     => array('bootstrap','simpleicon','confirm','back'),
			'__js'      => array('jquery','bootstrap','confirm','back')
		);
	
		$data['__header']  = $this->load->view('admin/header', $source, TRUE);
		$data['__sidebar'] = $this->load->view('admin/sidebar', $source, TRUE);

		$this->load->view('admin/saran/baca', $data, FALSE);
	}





	public function slider()
	{
		$this->is__login();

		if ($this->uri->segment(3) == '' ) {
			redirect('admin/slider/semua');
		}

		$this->load->model('M__slider');

		// Konfigurasi paginasi
		$config['base_url']        = base_url('admin/slider/'.$this->uri->segment(3).'');
		if ($this->uri->segment(3) == 'semua') 
		{
			$config['total_rows']      = $this->db->get('SLIDER')->num_rows();
		}
		else
		{
			$config['total_rows']      = $this->db->where('SLIDER_STATUS',$this->uri->segment(3))->get('SLIDER')->num_rows();
		}
		$config['per_page']        = (is_null($this->session->userdata('per_page')))? 10 : $this->session->userdata('per_page');
		
		$config['uri_segment']     = 4;
		$pilih                     = $config['total_rows'] / $config['per_page'];
		$config['num_links']       = floor($pilih);
		
		$this->pagination->initialize($config);

		$data['page']              = ($this->uri->segment(4))? $this->uri->segment(4) : 0 ;

		$data['keyword'] = $this->input->post('keyword');

		$this->M__slider->limit   = $config['per_page'];
		$this->M__slider->offset  = $data['page'];

		switch ( $this->uri->segment(3) ) {
			case 'tampil':
				$this->M__slider->status  = 'TAMPIL';
				break;

			case 'sembunyi':
				$this->M__slider->status  = 'SEMBUNYI';
				break;
			
			default:
				$this->M__slider->status  = 'SEMUA';
				break;
		}
		
		
		$data['query_slider']     = $this->M__slider->show();
		
		$data['limit']             = $data['query_slider']->num_rows();
		$data['total_rows']        = $config['total_rows'];
		$data['paginasi']          = $this->pagination->create_links();
		$data['per_page']          = $config['per_page'];

		$source = array(
			'__title'   => APP_NAME . ' ~ Halaman Manajemen Slider Admin',
			'__menu'    => 'pengaturan',
			'__css'     => array('bootstrap','simpleicon','confirm','back'),
			'__js'      => array('jquery','bootstrap','checkall','__checkall','confirm','back')
		);
	
		$data['__header']  = $this->load->view('admin/header', $source, TRUE);
		$data['__sidebar'] = $this->load->view('admin/sidebar', $source, TRUE);

		$this->load->view('admin/pengaturan/slider/list', $data, FALSE);
	}

	public function sliderTambah()
	{
		$this->is__login();

		$source = array(
			'__title'   => APP_NAME . ' ~ Halaman Manajemen Slider Admin',
			'__menu'    => 'pengaturan',
			'__css'     => array('bootstrap','simpleicon','dropzone-basis','dropzone','confirm','back'),
			'__js'      => array('jquery','bootstrap','dropzone','parsley','confirm','back')
		);
	
		$data['__header']  = $this->load->view('admin/header', $source, TRUE);
		$data['__sidebar'] = $this->load->view('admin/sidebar', $source, TRUE);

		$this->load->view('admin/pengaturan/slider/tambah', $data, FALSE);
	}

	public function slider__add()
	{
		$object = array(
			'SLIDER_GMB'    => $this->input->post('GMB') ,
			'SLIDER_LINK'   => $this->input->post('LINK') , 
			'SLIDER_STATUS' => 'SEMBUNYI' ,
			'SLIDER_ADD'    => time()
		);

		$this->query = $this->db->insert('SLIDER', $object);

		if ($this->query) 
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-success alert-style">Selamat! Data berhasil ditambah</div>');
		}
		else
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Data gagal ditambah, coba lagi</div>');
			
		}

		redirect('admin/slider/semua');
	}

	public function slider__status()
	{
		$this->is__login();

		$id = array();

		$id = $this->input->post('pilih');

		$object = array('SLIDER_STATUS' => strtoupper($this->uri->segment(3)));

		for($i=0;$i<count($id);$i++){

			$this->query = $this->db
							->where('SLIDER_ID', $id[$i])
							->update('SLIDER', $object);

		}

		if ($this->query) 
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-success alert-style">Selamat! Data berhasil dirubah</div>');
		}
		else
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Data gagal dirubah, coba lagi</div>');
			
		}

		redirect( $this->kembali() );
	}

	public function sliderEdit()
	{
		$this->is__login(); 

		$id = $this->uri->segment(3);

		$data['query_slider'] = $this->db->where('SLIDER_ID', $id )->get('SLIDER');

		$source = array(
			'__title'   => APP_NAME . ' ~ Halaman Manajemen Slider Admin',
			'__menu'    => 'pengaturan',
			'__css'     => array('bootstrap','simpleicon','confirm','back'),
			'__js'      => array('jquery','bootstrap','confirm','back')
		);
	
		$data['__header']  = $this->load->view('admin/header', $source, TRUE);
		$data['__sidebar'] = $this->load->view('admin/sidebar', $source, TRUE);

		$this->load->view('admin/pengaturan/slider/edit', $data, FALSE);
	}

	public function slider__up()
	{
		$this->is__login(); 

		$id = $this->input->post('ID');

		$object = array(
			'SLIDER_GMB'  => $this->input->post('GMB') ,
			'SLIDER_LINK' => $this->input->post('LINK') , 
		);

		$this->query = $this->db->where('SLIDER_ID', $id)->update('SLIDER', $object);

		if ($this->query) 
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-success alert-style">Selamat! Data berhasil dirubah</div>');
		}
		else
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Data gagal dirubah, coba lagi</div>');
			
		}

		redirect('admin/slider/semua');
	}






	public function info()
	{
		$this->is__login();

		$page = 'info';
		
		$source = array(
			'__title'   => APP_NAME . ' ~ Halaman Manajemen Info Admin',
			'__menu'    => 'pengaturan',
			'__css'     => array('bootstrap','simpleicon','summernote','confirm','back'),
			'__js'      => array('jquery','popper','bootstrap','summernote','parsley','confirm','back')
		);
	
		$data['__header']  = $this->load->view('admin/header', $source, TRUE);
		$data['__sidebar'] = $this->load->view('admin/sidebar', $source, TRUE);

		switch ($this->uri->segment(3)) {
			case 'kontak':
				$page = 'kontak';
				break;

			case 'ketentuan':
				$page = 'ketentuan';
				break;

			case 'tentang':
				$page = 'tentang';
				break;
			
			default:
				$page = 'info';
				break;
		}

		$this->load->view('admin/pengaturan/info/'.$page.'', $data, FALSE);
	}

	public function info__up()
	{
		$this->is__login(); 

		switch ($this->uri->segment(3)) {
			case 'kontak':
				$object = array(
					'INFO_LOGO'      => $this->input->post('LOGO') ,
					'INFO_META_DESC' => $this->input->post('DESC') ,
					'INFO_EMAIL'     => $this->input->post('EMAIL') ,
					'INFO_HP'        => $this->input->post('HP') ,
					'INFO_ALAMAT'    => $this->input->post('ALAMAT') ,
					'INFO_FB'        => $this->input->post('FB') ,
					'INFO_INSTAGRAM' => $this->input->post('INSTAGRAM') ,
					'INFO_YOUTUBE'   => $this->input->post('YOUTUBE')
				);
				break;

			case 'ketentuan':
				$object = array(
					'INFO_KETENTUAN'         => $this->input->post('KETENTUAN')
				);
				break;

			case 'tentang':
				$object = array(
					'INFO_TENTANG'         => $this->input->post('TENTANG')
				);
				break;
			
			case 'info':
				$object = array(
					'INFO_RUN_TEXT'        => $this->input->post('RUN_TEXT') ,
					'INFO_RUN_TEXT_STATUS' => $this->input->post('RUN_TEXT_STATUS') 
				);
				break;
		}

		$this->db->update('INFO', $object);

		redirect($this->kembali());
	}






	public function upload_files(){
		$config['upload_path']   = './uploads/';
		$config['allowed_types'] = 'jpg|png';

		$this->load->library('upload', $config);

		if( $this->upload->do_upload('userfile') )
		{
			$object = array(
				'UPLOADS_FILE' => $this->upload->data('file_name') ,
				'UPLOADS_ADD'  => time() 
			);
			$this->db->insert('UPLOADS', $object);

			echo $this->upload->data('file_name');
		}
	}

	public function delete_files(){
		$nama = $this->input->get('q');

		if(file_exists( $file = FCPATH.'/uploads/'.$nama))
		{
			$this->db->where('UPLOADS_FILE', $nama )->delete('UPLOADS');

			@unlink($file);

			echo "ok";
		}
		else
		{
			echo "no";
		}
	}

	public function file()
	{
		return $this->load->view('admin/file', $data='', FALSE);
	}





	public function device()
	{
		$device = ''; 

		switch ($this->uri->segment(3)) {
			case 'tablet':
				$device = 'tablet';
				break;
			case 'laptop':
				$device = 'laptop';
				break;
			
			default:
				$device = 'mobile';
				break;
		}
		
		$this->load->view('admin/device/'.$device.'');
	}

	public function backupRestore()
	{
		$source = array(
			'__title'   => APP_NAME . ' ~ Halaman Manajemen Backup & Restore Admin',
			'__menu'    => 'backup',
			'__css'     => array('bootstrap','simpleicon','confirm','back'),
			'__js'      => array('jquery','bootstrap','confirm','back')
		);
	
		$data['__header']  = $this->load->view('admin/header', $source, TRUE);
		$data['__sidebar'] = $this->load->view('admin/sidebar', $source, TRUE);

		$this->load->view('admin/tools/backup', $data, FALSE);
	}

	public function backup()
	{
		$this->load->dbutil();

		$setting = array(
			'format' => 'txt',
		);

		$backup = $this->dbutil->backup($setting);

		$this->load->helper('file');

		@write_file('./dbbackup/backup_'.date('Y-m-d-His').'.sql', $backup );

		redirect($this->kembali());
	}

	public function deleteBackup()
	{
		@unlink('./dbbackup/'. $this->input->post('file'));

		redirect($this->kembali());
	}

	public function restore()
	{
		$file = file_get_contents('./dbbackup/'. $this->input->post('file').'');

		$string = rtrim($file, "\n;");

		$string_query = str_replace(array('&nbsp;','&copy;'), array(' ','©'), $string );

		$array_query  = explode(";", $string_query);

		foreach ($array_query as $query) {
			$this->db->query($query);
		}

		redirect('admin/backupRestore');
	}

	
	public function downloadZip()
	{
		$this->load->library('zip');

		$file = file_get_contents('./dbbackup/'. $this->input->post('file').'');

		$this->zip->add_data(''. $this->input->post('file').'', $file );

		$this->zip->download(''.$this->input->post('file').'.zip');
	}




	// lAPORAN
	public function export()
	{
		$source = array(
			'__title'   => APP_NAME . ' ~ Halaman Manajemen Export Admin',
			'__menu'    => 'export',
			'__css'     => array('bootstrap','simpleicon','confirm','back'),
			'__js'      => array('jquery','bootstrap','parsley','confirm','back')
		);
	
		$data['__header']  = $this->load->view('admin/header', $source, TRUE);
		$data['__sidebar'] = $this->load->view('admin/sidebar', $source, TRUE);

		$this->load->view('admin/export/list', $data, FALSE);
	}






	// Pdf 
	public function pdfLembaga()
	{
		$this->is__login();

		$this->load->library('Pdf');

		$this->load->model('M__lembaga');

		$this->M__lembaga->order_by = $this->input->post('order_by');
		$this->M__lembaga->where    = $this->input->post('where');

		$data['query_lembaga'] = $this->M__lembaga->filter();

		$html = $this->load->view('admin/export/pdf/lembaga', $data, TRUE);

		$this->pdf->generate($html, normal_string($this->input->post('nama_file')) , true, 'A4','landscape');
		
	}

	public function xlsLembaga()
	{
		$this->is__login();

		$this->load->model('M__lembaga');

		$this->M__lembaga->order_by = $this->input->post('order_by');
		$this->M__lembaga->where    = $this->input->post('where');

		$data['query_lembaga'] = $this->M__lembaga->filter();

		$this->load->view('admin/export/xls/lembaga', $data, FALSE);	
	}

	public function pdfMember()
	{
		$this->is__login();

		$this->load->library('Pdf');

		$this->load->model('M__member');

		$this->M__member->start    = $this->input->post('start');
		$this->M__member->end      = $this->input->post('end');
		$this->M__member->order_by = $this->input->post('order_by');
		$this->M__member->where    = $this->input->post('where');

		$data['query_member'] = $this->M__member->filter();

		$html = $this->load->view('admin/export/pdf/member', $data, TRUE);

		$this->pdf->generate($html, normal_string($this->input->post('nama_file')) , true, 'A4','landscape');
	}

	public function xlsMember()
	{
		$this->is__login();

		$this->load->model('M__member');

		$this->M__member->start    = $this->input->post('start');
		$this->M__member->end      = $this->input->post('end');
		$this->M__member->order_by = $this->input->post('order_by');
		$this->M__member->where    = $this->input->post('where');

		$data['query_member'] = $this->M__member->filter();

		$this->load->view('admin/export/xls/member', $data, FALSE);	
	}

	public function pdfHewan()
	{
		$this->is__login();

		$this->load->library('Pdf');

		$this->load->model('M__hewan');

		$this->M__hewan->order_by = $this->input->post('order_by');
		$this->M__hewan->where    = $this->input->post('where');

		$data['query_hewan'] = $this->M__hewan->filter();

		$html = $this->load->view('admin/export/pdf/hewan', $data, TRUE);

		$this->pdf->generate($html, normal_string($this->input->post('nama_file')) , true, 'A4','landscape');
	}

	public function xlsHewan()
	{
		$this->is__login();

		$this->load->model('M__hewan');

		$this->M__hewan->order_by = $this->input->post('order_by');
		$this->M__hewan->where    = $this->input->post('where');

		$data['query_hewan'] = $this->M__hewan->filter();

		$this->load->view('admin/export/xls/hewan', $data, FALSE);	
	}

	public function pdfPenabungan()
	{
		$this->is__login();

		$this->load->library('Pdf');

		$this->load->model('M__tabungan');

		$this->M__tabungan->start    = $this->input->post('start');
		$this->M__tabungan->end      = $this->input->post('end');
		$this->M__tabungan->order_by = $this->input->post('order_by');
		$this->M__tabungan->where    = $this->input->post('where');

		$data['query_penabungan'] = $this->M__tabungan->filter();

		$html = $this->load->view('admin/export/pdf/penabungan', $data, TRUE);

		$this->pdf->generate($html, normal_string($this->input->post('nama_file')) , true, 'A4','landscape');
	}

	public function xlsPenabungan()
	{
		$this->is__login();

		$this->load->model('M__tabungan');

		$this->M__tabungan->start    = $this->input->post('start');
		$this->M__tabungan->end      = $this->input->post('end');
		$this->M__tabungan->order_by = $this->input->post('order_by');
		$this->M__tabungan->where    = $this->input->post('where');

		$data['query_penabungan'] = $this->M__tabungan->filter();

		$this->load->view('admin/export/xls/penabungan', $data, FALSE);	
	}

	public function pdfPembelian()
	{
		$this->is__login();

		$this->load->library('Pdf');

		$this->load->model('M__nota');

		$this->M__nota->start    = $this->input->post('start');
		$this->M__nota->end      = $this->input->post('end');
		$this->M__nota->order_by = $this->input->post('order_by');
		$this->M__nota->where    = $this->input->post('where');

		$data['query_pembelian'] = $this->M__nota->filter();

		$html = $this->load->view('admin/export/pdf/pembelian', $data, TRUE);

		$this->pdf->generate($html, normal_string($this->input->post('nama_file')) , true, 'A4','landscape');
	}

	public function xlsPembelian()
	{
		$this->is__login();

		$this->load->model('M__nota');

		$this->M__nota->start    = $this->input->post('start');
		$this->M__nota->end      = $this->input->post('end');
		$this->M__nota->order_by = $this->input->post('order_by');
		$this->M__nota->where    = $this->input->post('where');

		$data['query_pembelian'] = $this->M__nota->filter();

		$this->load->view('admin/export/xls/pembelian', $data, FALSE);	
	}

	public function pdfSaran()
	{
		$this->is__login();

		$this->load->library('Pdf');

		$this->load->model('M__saran');

		$this->M__saran->start    = $this->input->post('start');
		$this->M__saran->end      = $this->input->post('end');
		$this->M__saran->order_by = $this->input->post('order_by');
		$this->M__saran->where    = $this->input->post('where');

		$data['query_saran'] = $this->M__saran->filter();

		$html = $this->load->view('admin/export/pdf/saran', $data, TRUE);

		$this->pdf->generate($html, normal_string($this->input->post('nama_file')) , true, 'A4','landscape');
	}

	public function xlsSaran()
	{
		$this->is__login();

		$this->load->model('M__saran');

		$this->M__saran->start    = $this->input->post('start');
		$this->M__saran->end      = $this->input->post('end');
		$this->M__saran->order_by = $this->input->post('order_by');
		$this->M__saran->where    = $this->input->post('where');

		$data['query_saran'] = $this->M__saran->filter();

		$this->load->view('admin/export/xls/saran', $data, FALSE);	
	}

}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */