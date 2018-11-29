<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

	private $query;

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		date_default_timezone_set('Asia/Jakarta');

		//	Load model
		$this->load->model('M__member');
		$this->load->model('M__tabungan');

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
		$this->load->library('cart');
		$this->load->library('recaptcha');

		//	Load helper
		$this->load->helper('help');


		if (! $this->cek__ip($this->input->ip_address())) {

			if ($this->agent->is_browser())
			{
				$device = 'BROWSER'; 
		        $agent  = $this->agent->browser().' '.$this->agent->version();
			}
			elseif ($this->agent->is_robot())
			{
				$device = 'ROBOT'; 
		        $agent  = $this->agent->robot();
			}
			elseif ($this->agent->is_mobile())
			{
				$device = 'MOBILE'; 
		        $agent  = $this->agent->mobile();
			}
			else
			{
				$device = 'Unidentified Device'; 
			    $agent  = 'Unidentified User Agent';	
			}

			$object = array(
				'PENGUNJUNG_IP'       => $this->input->ip_address() ,
				'PENGUNJUNG_DEVICE'   => $device,
				'PENGUNJUNG_AGENT'    => $agent,
				'PENGUNJUNG_FLATFORM' => $this->agent->platform(),
				'PENGUNJUNG_TGL'      => date('Y-m-d')
			 );
			
			$this->db->insert('PENGUNJUNG', $object);
		}
	}

	public function is__login()
	{
		if ( ! $this->session->userdata('__ci_member_id') ) {
			redirect('member/masuk');
		}
	}

	/**
	*	Digunakan untuk mengambil url sebelumnya 
	*/ 
	public function kembali()
	{
		return $this->input->server('HTTP_REFERER');
	}

	public function valid__token($token)
	{
		if ($this->encrypt->decode($token) === TOKEN ) {
			return true;
		}else{
			return false;
		}
	}

	public function index()
	{

		$this->is__login();

		$data['query_lem'] = $this->db
		->where('LEMBAGA_STATUS', 'TAMPIL')
		->get('LEMBAGA');
		
		$data['query_hewan'] = $this->db->where('HEWAN_STATUS', 'TAMPIL')
		->order_by('HEWAN_URUT', 'asc')
		->get('HEWAN');

		$source = array(
			'__title'   => APP_NAME . '~ Beranda',
			'__css'     => array('bootstrap','simpleicon','owl','owltheme','confirm','front'),
			'__js'      => array('jquery','bootstrap','owl','confirm','front')
		);
	
		$data['__header'] = $this->load->view('member/header', $source, TRUE);
		$data['__slider'] = $this->load->view('member/slider', $source, TRUE);
		$data['__footer'] = $this->load->view('member/footer', $source, TRUE);

		$this->load->view('member/beranda', $data, FALSE);
	}

	public function masuk()
	{
        $data = array(
        	'__title'=> APP_NAME . '~ Halaman Login Member',
			'__css'  => array('bootstrap','simpleicon','front'),
			'__js'   => array('jquery','bootstrap','parsley','front'),

            'widget' => $this->recaptcha->getWidget(),
            'script' => $this->recaptcha->getScriptTag()
        );
        
		$this->load->view('member/login', $data, FALSE);
	}


	public function member__masuk()
	{
		$recaptcha = $this->input->post('g-recaptcha-response');
         if (!empty($recaptcha)) 
         {
             $response = $this->recaptcha->verifyResponse($recaptcha);
             if (isset($response['success']) and $response['success'] === true) 
             {
                 $EMAIL	  = $this->input->post('EMAIL');
				$PASSWORD = __password($this->input->post('PASSWORD'));

								$this->db->where('MEMBER_EMAIL', $EMAIL);
								$this->db->where('MEMBER_PASSWORD', $PASSWORD);
				$this->query =  $this->db->get('MEMBER');

				
				if ($this->query->num_rows() == 0) 
				{
					$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Akun tidak tersedia</div>');

					redirect('member/masuk');
				}
				else
				{

					$member = $this->query->row();

					if ( $member->MEMBER_VERIFIKASI == 'BELUM' ) 
					{
						$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Akun belum terverifikasi silahkan ikuti link verifikasi yang terdapat pada email yang anda gunakan untuk mendaftar</div>');

						redirect('member/masuk');
					}
					else
					{
						if ( $member->MEMBER_STATUS == 'BLOKIR' ) 
						{
							$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Akun telah diblokir silahkan hubungi administrator kami</div>');

							redirect('member/masuk');
						}
						else
						{
							$array = array(
								'__ci_member_id'    => $member->MEMBER_ID,
								'__ci_member_email' => $member->MEMBER_EMAIL,
								'__ci_member_nama'  => $member->MEMBER_NAMA,
								'__ci_member_foto'  => $member->MEMBER_FOTO,
							);
							
							$this->session->set_userdata( $array );

							$this->session->set_flashdata('__alert', '<div class="alert alert-success alert-style">Selamat! Datang '.$member->MEMBER_NAMA.'</div>');

							redirect('member');
						}
					}
				}
             }
         }
         else
         {
         	$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! CAPTCHA tidak sesuai</div>');

		    redirect('member/masuk');
         }

			if ( $this->valid__token($this->input->post('token')) ) 
			{
	            $EMAIL	  = $this->input->post('EMAIL');
				$PASSWORD = __password($this->input->post('PASSWORD'));

				$this->query =	$this->db->where('MEMBER_EMAIL', $EMAIL)
								->where('MEMBER_PASSWORD', $PASSWORD)
								->get('MEMBER');
				
				if ($this->query->num_rows() == 0) 
				{
					$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Akun tidak tersedia</div>');

					redirect('member/masuk');
				}
				else
				{

					$member = $this->query->row();

					if ( $member->MEMBER_VERIFIKASI == 'BELUM' ) 
					{
						$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Akun belum terverifikasi silahkan ikuti link verifikasi yang terdapat pada email yang anda gunakan untuk mendaftar</div>');

						redirect('member/masuk');
					}
					else
					{
						if ( $member->MEMBER_STATUS == 'BLOKIR' ) 
						{
							$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Akun telah diblokir silahkan hubungi administrator kami</div>');

							redirect('member/masuk');
						}
						else
						{
							$array = array(
								'__ci_member_id'    => $member->MEMBER_ID,
								'__ci_member_email' => $member->MEMBER_EMAIL,
								'__ci_member_nama'  => $member->MEMBER_NAMA,
								'__ci_member_foto'  => $member->MEMBER_FOTO,
							);
							
							$this->session->set_userdata( $array );

							$this->session->set_flashdata('__alert', '<div class="alert alert-success alert-style">Selamat! Datang '.$member->MEMBER_NAMA.'</div>');

							redirect('member');
						}
					}
				}
			}
			else
			{
				$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Token tidak valid</div>');
			}

			redirect('member/masuk');
	}

	public function registrasi()
	{
		$data = array(
			'__title'=> APP_NAME . ' ~ Halaman Registrasi Member',
			'__css'  => array('bootstrap','simpleicon','confirm','front'),
			'__js'   => array('jquery','bootstrap','parsley','confirm','front'),
		);

		$this->load->view('member/registrasi', $data, FALSE);
	}

	public function member__reg()
	{
		$object = array(
			'MEMBER_NAMA'       => strtoupper($this->input->post('NAMA')) ,
			'MEMBER_EMAIL'      => $this->input->post('EMAIL') ,
			'MEMBER_VERIFIKASI' => 'BELUM' ,
			'MEMBER_STATUS'     => 'BARU' ,
			'MEMBER_PASSWORD'   => __password($this->input->post('PASSWORD')) ,
			'MEMBER_HP'         => $this->input->post('HP') ,
			'MEMBER_JK'         => $this->input->post('JK') , 
			'MEMBER_ADD'        => time() ,
		);

		// print_r($object);

		$this->query = $this->db->insert('MEMBER', $object);

		if ($this->query) 
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-success alert-style">Selamat! Kami telah mengirim email verifikasi ke '.$this->input->post('EMAIL').'</div>');


			$from   = $this->db->get('INFO')->row()->INFO_EMAIL;
			$to     = $this->input->post('EMAIL');
			$subjek = 'VERIFIKASI EMAIL REGISTRASI';

			$pesan  = '<h1>VERIFIKASI EMAIL REGISTRASI</h1>';
			$pesan .= '<p>Assalamu\'alaikum wr. wb</p>';
			$pesan .= '<p>Selamat anda akan segera menjadi member SITAQUR, silahkan verifikasi pendaftaran anda dengan menekan tombol verifikasi dibawah ini</p>';
			$pesan .= '<a href="'.base_url()."member/member__verifikasi?email_anda=".$this->input->post('EMAIL').'" style="padding: 10px;background-color: #28a745;color: white;text-decoration: none;">VERIFIKASI</a>';
			$pesan .= '<p><b>Atau</b> kunjungi link diwabah ini</p>';
			$pesan .= '<a href="'.base_url()."member/member__verifikasi?email_anda=".$this->input->post('EMAIL').'">'.base_url()."member/member__verifikasi?email_anda=".$this->input->post('EMAIL').'</a>';
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
			$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Gagal mendaftar silahkan coba lagi</div>');
		}
		

		redirect('member/registrasi');
	}

	public function member__cek_email($email)
	{
		$x = $this->db->where('MEMBER_EMAIL', $email )->get('MEMBER')->num_rows();
		if ( $x == 1 ) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function member__verifikasi()
	{
		$email = $this->input->get('email_anda');

		$object = array(
			'MEMBER_VERIFIKASI' => 'SUDAH' , 
		);

		if( $this->member__cek_email($email) )
		{
			$this->db->where('MEMBER_EMAIL', $email)->update('MEMBER', $object);
			$this->session->set_flashdata('__alert', '<div class="alert alert-success alert-style">Selamat! Berhasil memverifikasi pendaftaran silahkan mencoba login</div>');
		}
		else
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Gagal memverifikasi silahkan coba lagi</div>');
		}

		redirect('member/registrasi');
	}

	public function lupaPassword()
	{
		$this->load->view('member/forget','', FALSE);	
	}

	public function member__lupa_password()
	{
		$email = $this->input->post('EMAIL');

		if( $this->member__cek_email($email) )
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-success alert-style">Selamat! Kami telah mengirim link petunjuk pengantuan password baru ke email '.$email.'</div>');
			
			$from   = $this->db->get('INFO')->row()->INFO_EMAIL;
			$to     = $this->input->post('EMAIL');
			$subjek = 'KONFIRMASI LUPA SANDI';

			$pesan  = '<h1>KONFIRMASI LUPA SANDI</h1>';
			$pesan .= '<p>Assalamu\'alaikum wr. wb</p>';
			$pesan .= '<p>Kami mendengar anda kehilangan akun anda , silahkan tekan tombol KONFIRMASI dibawah ini dan ikuti panduan selanjutnya</p>';
			$pesan .= '<a href="'.base_url().'member/lupaPassword?q='.base64_encode($email).'&token='.md5('SITAQUR').'" style="padding: 10px;background-color: #28a745;color: white;text-decoration: none;">KONFIRMASI </a>';
			$pesan .= '<p><b>Atau</b> kunjungi link diwabah ini</p>';
			$pesan .= '<a href="'.base_url().'member/lupaPassword?q='.base64_encode($email).'&token='.md5('SITAQUR').'">'.base_url().'member/lupaPassword?q='.base64_encode($email).'&token='.md5('SITAQUR').'</a>';
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
			$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Email yang anda masukkan tidak terdaftar pada sistem kami</div>');
		}

		redirect('member/masuk');
	}

	public function member__lupa_passwod_konfirmasi()
	{
		$email           = base64_decode($this->input->post('EMAIL'));
		$password_baru   = $this->input->post('PASSWORD_BARU');
		$password_ulangi = $this->input->post('PASSWORD_ULANGI');

		if( $this->member__cek_email($email) )
		{
			if ($password_baru == $password_ulangi ) 
			{
				$object = array('MEMBER_PASSWORD' => __password($password_ulangi));
				$this->db->where('MEMBER_EMAIL', $email )->update('MEMBER', $object);

				$this->session->set_flashdata('__alert', '<div class="alert alert-success alert-style">Selamat! Berhasil memperbarui password silahkan coba login</div>');
			}
			else
			{
				$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! password tidak sama silahkan coba lagi</div>');
			}
		}
		else
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Link tidak valid temukan link valid di email anda</div>');
		}

		redirect($this->kembali());
	}

	public function keluar()
	{
		$this->is__login();

		$this->session->sess_destroy();
		redirect('');
	}

	public function profil()
	{
		$this->is__login();

		$id = $this->session->userdata('__ci_member_id');

		$data['query_mbr'] = $this->db->where('MEMBER_ID', $id )->get('MEMBER');

		$source = array(
			'__title'   => APP_NAME .' ~ Halaman Profil Member',
			'__css'     => array('bootstrap','simpleicon','confirm','front'),
			'__js'      => array('jquery','bootstrap','parsley','confirm','front')
		);
	
		$data['__header'] = $this->load->view('member/header', $source, TRUE);
		$data['__footer'] = $this->load->view('member/footer', $source, TRUE);

		$this->load->view('member/profil', $data, FALSE);
	}

	public function member__profil_up()
	{
		$id = $this->input->post('ID');

		$object = array(
			'MEMBER_NIK'       => strtoupper($this->input->post('NIK')) ,
			'MEMBER_NAMA'      => strtoupper($this->input->post('NAMA')) ,
			'MEMBER_HP'        => strtoupper($this->input->post('HP')) ,
			'MEMBER_JK'        => strtoupper($this->input->post('JK')) ,
			'MEMBER_PROVINSI'  => strtoupper($this->input->post('PROVINSI')) ,
			'MEMBER_KABUPATEN' => strtoupper($this->input->post('KABUPATEN')) ,
			'MEMBER_KECAMATAN' => strtoupper($this->input->post('KECAMATAN')) ,
			'MEMBER_DESA'      => strtoupper($this->input->post('DESA')) ,
			'MEMBER_DUSUN'     => strtoupper($this->input->post('DUSUN')) ,
			'MEMBER_BANK'      => strtoupper($this->input->post('BANK')) ,
			'MEMBER_NO_REK'    => strtoupper($this->input->post('NO_REK')) ,
			'MEMBER_AN_REK'    => strtoupper($this->input->post('AN_REK')) ,
		);

		$array = array(
			'__ci_member_nama' => strtoupper($this->input->post('NAMA'))
		);
		
		$this->session->set_userdata( $array );

		$this->query = $this->db->where('MEMBER_ID', $id)->update('MEMBER', $object);

		if ($this->query) 
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-info alert-style">Identitas berhasil diperbarui</div>');
		}else
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Identitas gagal diperbarui</div>');
		}

		redirect($this->kembali());
	}

	public function member__foto_up()
	{
		$config['upload_path']   = './uploads/member/foto/';
		$config['allowed_types'] = 'jpg|png';
		$config['max_size']      = '2000';


		$this->load->library('upload', $config);

		if($this->upload->do_upload('FOTO'))
		{
			$id = $this->session->userdata('__ci_member_id');

			$object = array('MEMBER_FOTO' => $this->upload->data('file_name'));

			$this->query = $this->db->where('member_id', $id)->update('MEMBER', $object);

			$array = array(
				'__ci_member_foto' => $this->upload->data('file_name')
			);
			
			$this->session->set_userdata( $array );

			if ($this->query) 
			{
				if(file_exists( $file = FCPATH.'/uploads/member/foto/'.$this->input->post('FOTO_LAMA')))
				{
					@unlink($file);
				}
				$this->session->set_flashdata('__alert', '<div class="alert alert-info alert-style">Identitas berhasil diperbarui</div>');
			}
			else
			{
				$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Identitas gagal diperbarui silahkan coba lagi</div>');
			}
		}
		else
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! File bermasalah silahkan coba lagi'.$this->upload->display_errors().'</div>');
		}

		redirect( $this->kembali());

	}

	public function member_password__up()
	{
		$id            = $this->input->post('ID');
		$password_lama = __password($this->input->post('PASSWORD_LAMA'));

		$object = array(
			'MEMBER_PASSWORD'    => __password($this->input->post('PASSWORD_BARU')) ,
		);

		$this->query = $this->db->where('MEMBER_ID', $id)
		->where('MEMBER_PASSWORD', $password_lama)
		->get('MEMBER')->num_rows();

		if ($this->query == 1) 
		{
			$this->db->where('MEMBER_ID', $id)
			->update('MEMBER', $object);

			$this->session->set_flashdata('__alert', '<div class="alert alert-info alert-style">Password berhasil diperbarui</div>');
		}
		else
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Password gagal diperbarui</div>');
		}

		redirect($this->kembali());

	}

	public function pembelian()
	{
		$this->is__login();

		if ($this->uri->segment(3) == '' ) {
			redirect('member/pembelian/semua');
		}

		$this->load->model('M__nota');

		// Konfigurasi paginasi
		$config['base_url']        = base_url('member/pembelian/'.$this->uri->segment(3).'');
		if($this->uri->segment(3) == 'semua')
		{
			$config['total_rows']      = $this->db->where('MEMBER_ID', $this->session->userdata('__ci_member_id'))->get('NOTA')->num_rows();
		}
		else
		{
			$config['total_rows']      = $this->db->where('MEMBER_ID', $this->session->userdata('__ci_member_id'))->where('NOTA_STATUS',$this->uri->segment(3))->get('NOTA')->num_rows();
		}
		$config['per_page']        = (is_null($this->session->userdata('per_page')))? 10 : $this->session->userdata('per_page');
		
		$config['uri_segment']     = 4;
		$pilih                     = $config['total_rows'] / $config['per_page'];
		$config['num_links']       = 5;
		
		$this->pagination->initialize($config);

		$data['page']              = ($this->uri->segment(4))? $this->uri->segment(4) : 0 ;
		$data['keyword']           = $this->input->post('keyword');
		
		$this->M__nota->limit    = $config['per_page'];
		$this->M__nota->offset   = $data['page'];
		$this->M__nota->kolom    = $this->input->post('KOLOM');
		$this->M__nota->keyword  = $this->input->post('keyword');
		$this->M__nota->id  = $this->session->userdata('__ci_member_id');

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
		
		$data['query_nota']      = $this->M__nota->show();
		
		$data['limit']             = $data['query_nota']->num_rows();
		$data['total_rows']        = $config['total_rows'];
		$data['paginasi']          = $this->pagination->create_links();
		$data['per_page']          = $config['per_page'];

		$source = array(
			'__title'   => APP_NAME .' ~ Halaman Pembelian Member',
			'__css'     => array('bootstrap','simpleicon','confirm','front'),
			'__js'      => array('jquery','bootstrap','confirm','front')
		);
	
		$data['__header'] = $this->load->view('member/header', $source, TRUE);
		$data['__footer'] = $this->load->view('member/footer', $source, TRUE);

		$this->load->view('member/pembelian/list', $data, FALSE);
	}

	public function pembelianDetail()
	{
		$this->is__login();

		$id = $this->uri->segment(3);

		$data['query_nota'] = $this->db
									->where('MEMBER_ID', $this->session->userdata('__ci_member_id'))
									->where('NOTA_ID', $id)
									->get('NOTA');

		$source = array(
			'__title'    => APP_NAME . ' ~ Halaman Detail Pembelian Member',
			'__css'     => array('bootstrap','simpleicon','confirm','front'),
			'__js'      => array('jquery','bootstrap','confirm','front')
		);
	
		$data['__header'] = $this->load->view('member/header', $source, TRUE);
		$data['__footer'] = $this->load->view('member/footer', $source, TRUE);

		$this->load->view('member/pembelian/detail', $data, FALSE);
	}

	public function pembelianTambah()
	{
		$this->is__login();

		$data['query_hewan'] = $this->db
		->where('HEWAN_STATUS', 'TAMPIL')
		->order_by('HEWAN_URUT', 'asc')
		->get('HEWAN');

		$source = array(
			'__title'   => APP_NAME .' ~ Halaman Tambah Pembelian Member ',
			'__css'     => array('bootstrap','simpleicon','confirm','front'),
			'__js'      => array('jquery','bootstrap','parsley','confirm','front')
		);
	
		$data['__header'] = $this->load->view('member/header', $source, TRUE);
		$data['__footer'] = $this->load->view('member/footer', $source, TRUE);

		$this->load->view('member/pembelian/add', $data, FALSE);
	}

	public function member_keranjang__add()
	{ //fungsi Add To Cart
		$this->is__login();
		
		$data = array(
			'id'    => $this->input->post('HEWAN_ID'), 
			'name'  => $this->input->post('HEWAN_NAMA'), 
			'price' => $this->input->post('HEWAN_HARGA'), 
			'qty'   => $this->input->post('QTY'), 
		);

		$this->cart->insert($data);

		echo $this->show_cart(); //tampilkan cart setelah added
	}

	public function show_cart()
	{ //Fungsi untuk menampilkan Cart
		$this->is__login();
		
		$output = '';
		$no = 1;
		foreach ($this->cart->contents() as $items) {
			$output .='
				<tr>
					<td>'.$no++.'</td>
					<td>'.$items['name'].'</td>
					<td>'.__rp($items['price']).'</td>
					<td>'.$items['qty'].'</td>
					<td>'.__rp($items['subtotal']).'</td>
					<td><button type="button" id="'.$items['rowid'].'" class="hapus_cart btn btn-danger btn-xs">Batal</button></td>
				</tr>
			';
		}
		$output .= '
			<tr>
				<th colspan="4">Total</th>
				<th colspan="2" class="total">'.__rp($this->cart->total()).'</th>
			</tr>
		';
		return $output;
	}

	public function load_cart()
	{ //load data cart
		echo $this->show_cart();
	}

	public function member_keranjang__del(){ //fungsi untuk menghapus item cart
		$this->is__login();
		
		$data = array(
			'rowid' => $this->input->post('row_id'), 
			'qty'   => 0, 
		);

		$this->cart->update($data);
		echo $this->show_cart();
	}

	public function pembelian__cek()
	{   
		$this->is__login();
		
		$saldo = $this->M__tabungan->saldo($this->session->userdata('__ci_member_id'));
		$total = $this->cart->total();
		
		if ( $saldo < $total ) 
		{
			unset($_SESSION['__ci_last_regenerate']);
			unset($_SESSION['cart_contents']);
			
			$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Dompet anda tidak mencukupi <a href="'.base_url().'member/tabunganTambah">Deposito baru</a></div>');
		}
		else
		{
			$object = array(
				'NOTA_ID'      => '' ,
				'MEMBER_ID'    => $this->session->userdata('__ci_member_id') ,
				'LEMBAGA_ID'   => $this->input->post('LEMBAGA_ID') ,
				'NOTA_NO'      => 'QURBAN'.$this->session->userdata('__ci_last_regenerate').'-'.$this->session->userdata('__ci_member_id'),
				'NOTA_TOTAL'   => $total ,
				'NOTA_CATATAN' => strtoupper($this->input->post('CATATAN')) ,
				'NOTA_STATUS'  => 'PROSES' ,
				'NOTA_ADD'     => date('Y-m-d')
			);

			$this->db->insert('NOTA', $object);

			foreach ($this->cart->contents() as $items) {

				$object2 = array(
					'KERANJANG_ID'  => '' ,
					'NOTA_NO'       => 'QURBAN'.$this->session->userdata('__ci_last_regenerate').'-'.$this->session->userdata('__ci_member_id'),
					'HEWAN_ID'      => $items['id'],
					'KERANJANG_QTY' => $items['qty']
				);

				$this->db->insert('KERANJANG', $object2);
			}

			unset($_SESSION['__ci_last_regenerate']);
			unset($_SESSION['cart_contents']);

			$this->session->set_flashdata('__alert', '<div class="alert alert-info alert-style">Pembelian akan segera akan kami proses</div>');
		}

		redirect('member/pembelian/proses');
	}

	public function sertifikatPembelian()
	{
		$this->is__login();

		$this->load->library('Pdf');

		$data['query_nota'] = $this->db->where('NOTA.NOTA_NO', $this->uri->segment(3))->join('LEMBAGA', 'LEMBAGA.LEMBAGA_ID = NOTA.LEMBAGA_ID', 'left')->get('NOTA');

		$html = $this->load->view('member/pembelian/sertifikat', $data, TRUE);

		$this->pdf->generate($html, 'Sertifikat', true, 'A4', 'landscape');
	}







	public function tabungan()
	{
		$this->is__login();

		if ($this->uri->segment(3) == '' ) {
			redirect('member/tabungan/semua');
		}

		$this->load->model('M__tabungan');

		// Konfigurasi paginasi
		$config['base_url']        = base_url('admin/tabungan/'.$this->uri->segment(3).'');
		if ($this->uri->segment(3) == 'semua') 
		{
			$config['total_rows']      = $this->db->where('MEMBER_ID', $this->session->userdata('__ci_member_id'))->get('TABUNGAN')->num_rows();
		}
		else
		{
			$config['total_rows']      = $this->db->where('MEMBER_ID', $this->session->userdata('__ci_member_id'))->where('TABUNGAN_STATUS',$this->uri->segment(3))->get('TABUNGAN')->num_rows();
		}
		$config['per_page']        = (is_null($this->session->userdata('per_page')))? 10 : $this->session->userdata('per_page');
		
		$config['uri_segment']     = 4;
		$pilih                     = $config['total_rows'] / $config['per_page'];
		$config['num_links']       = 5;
		
		$this->pagination->initialize($config);

		$data['page']              = ($this->uri->segment(4))? $this->uri->segment(4) : 0 ;

		$data['keyword'] = $this->input->post('keyword');

		$this->M__tabungan->limit   = $config['per_page'];
		$this->M__tabungan->offset  = $data['page'];
		$this->M__tabungan->kolom   = $this->input->post('KOLOM');
		$this->M__tabungan->keyword = $this->input->post('keyword');
		$this->M__tabungan->id      = $this->session->userdata('__ci_member_id');
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
			'__title'   => APP_NAME .' ~ Halaman Riwayat Penabungan Member',
			'__css'     => array('bootstrap','simpleicon','confirm','front'),
			'__js'      => array('jquery','bootstrap','confirm','front')
		);
	
		$data['__header'] = $this->load->view('member/header', $source, TRUE);
		$data['__footer'] = $this->load->view('member/footer', $source, TRUE);

		$this->load->view('member/tabungan/list', $data, FALSE);
	}

	public function tabunganTambah()
	{
		$source = array(
			'__title'   => APP_NAME .' ~ Halaman Tambah Penabungan Member',
			'__css'     => array('bootstrap','simpleicon','confirm','front'),
			'__js'      => array('jquery','bootstrap','maskmoney','parsley','confirm','front')
		);
	
		$data['__header'] = $this->load->view('member/header', $source, TRUE);
		$data['__footer'] = $this->load->view('member/footer', $source, TRUE);

		$this->load->view('member/tabungan/add', $data, FALSE);
	}

	public function tabungan__add()
	{
		if ( $this->valid__token($this->input->post('token')) ) 
		{

			$config['upload_path']   = './uploads/member/bukti/';
			$config['allowed_types'] = 'jpg|png';
			$config['max_size']      = '2000';

			$this->load->library('upload', $config);

			if($this->upload->do_upload('BUKTI'))
			{
				$object = array(
					'TABUNGAN_ID'      => '' , 
					'MEMBER_ID'        => $this->session->userdata('__ci_member_id') ,
					'REKENING_ID'      => $this->input->post('REK_ID') ,  
					'TABUNGAN_NOMINAL' => str_replace(array('.',',00','Rp',' '), '',$this->input->post('NOMINAL')), 
					'TABUNGAN_TGL'     => $this->input->post('TGL') ,
					'TABUNGAN_BUKTI'   => $this->upload->data('file_name'), 
					'TABUNGAN_STATUS'  => 'PROSES' , 
					'TABUNGAN_ADD'     => time()
				);

				$this->query = $this->db->insert('TABUNGAN', $object);

				if ($this->query) 
				{
					$this->session->set_flashdata('__alert', '<div class="alert alert-info alert-style">Berhasil dikirim segera akan kami proses</div>');
				    
				    $from   = $this->db->get('INFO')->row()->INFO_EMAIL;
	    			$to     = $this->db->get('INFO')->row()->INFO_EMAIL;
	    			$subjek = ''.$this->session->userdata('__ci_member_nama').'TAMBAH SALDO TABUNGAN';
	    
	    			$pesan  = '<h1>'.$this->session->userdata('__ci_member_nama').'TAMBAH SALDO TABUNGAN</h1>';
	    			$pesan .= '<p>Assalamu\'alaikum wr. wb</p>';
	    			$pesan .= '<p>Mohon verifikasi tambah saldo tabungan sejumlah '.__rp(str_replace(array('.',',00','Rp',' '), '',$this->input->post('NOMINAL'))).' dengan tanggal transfer '.__tgl_dmy($this->input->post('TGL')).'</p>';
	    			$pesan .= '<p>Demikian informasi dari kami, terima kasih atas perhatiannya.</p>';
	    			$pesan .= '<p>Wassalamu\'alaikum wr. wb</p>';
	    
	    			$this->load->library('email');
	                
	                $config['mailtype'] = 'html';
	                $this->email->initialize($config);
	                $this->email->to($to);
	                $this->email->from($from,'no_reply.cs@qurbanapp.com');
	                $this->email->subject($subjek);
	                $this->email->message($pesan);
	                $this->email->attach(base_url().'uploads/member/bukti/'.$this->upload->data('file_name').'');
	                $this->email->send();
				    
				}
				else
				{
					$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Terjadi kesalahan mohon mencoba kembali</div>');
				}
			}
			else
			{
				$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Terjadi kesalahan pada file bukti mohon mencoba kembali</div>');
			}
			echo "valid";
		}
		else
		{
			$this->session->set_flashdata('__alert', '<div class="alert alert-danger alert-style">Maaf! Token tidak valid</div>');
		}
		
		redirect('member/tabungan');

	}








	public function saran__add()
	{
		if ($this->agent->is_browser())
		{
			$device = 'BROWSER'; 
	        $agent  = $this->agent->browser().' '.$this->agent->version();
		}
		elseif ($this->agent->is_robot())
		{
			$device = 'ROBOT'; 
	        $agent  = $this->agent->robot();
		}
		elseif ($this->agent->is_mobile())
		{
			$device = 'MOBILE'; 
	        $agent  = $this->agent->mobile();
		}
		else
		{
			$device = 'Unidentified Device'; 
		    $agent  = 'Unidentified User Agent';	
		}

		$object = array(
			'SARAN_ID'       => '' , 
			'SARAN_NAMA'     => strtoupper($this->input->post('NAMA')) ,
			'SARAN_EMAIL'    => $this->input->post('EMAIL') , 
			'SARAN_ISI'      => $this->input->post('ISI') ,
			'SARAN_DEVICE'   => $device,
			'SARAN_AGENT'    => $agent,
			'SARAN_FLATFORM' => $this->agent->platform(),
			'SARAN_STATUS'   => 'BELUM' ,
			'SARAN_ADD'      => time(), 
		);

		$this->db->insert('SARAN', $object);

		$this->session->set_flashdata('__alert', '<div class="alert alert-info alert-style">Terima kasih atas saran yang diberikan</div>');

		redirect( $this->kembali() );
	}



	public function cek__ip($ip)
	{
		$this->query = $this->db->where('PENGUNJUNG_IP', $ip)->where('PENGUNJUNG_TGL', date('Y-m-d'))->get('PENGUNJUNG')->num_rows();

		return $this->query;
	}


	public function beranda()
	{

		$data['query_lem'] = $this->db
		->where('LEMBAGA_STATUS', 'TAMPIL')
		->get('LEMBAGA');

		$data['query_hewan'] = $this->db
		->where('HEWAN_STATUS', 'TAMPIL')
		->order_by('HEWAN_URUT', 'asc')
		->get('HEWAN');

		$source = array(
			'__title'   => APP_NAME . ' ~ Halaman Utama',
			'__menu'	=> 'utama',
			'__css'     => array('bootstrap','simpleicon','owl','owltheme','confirm','front'),
			'__js'      => array('jquery','bootstrap','owl','parsley','confirm','front')
		);
	
		$data['__header'] = $this->load->view('member/header', $source, TRUE);
		$data['__slider'] = $this->load->view('member/slider', $source, TRUE);
		$data['__footer'] = $this->load->view('member/footer', $source, TRUE);

		$this->load->view('member/beranda', $data, FALSE);
	}

	public function lembaga()
	{
		$data['query_pen'] = $this->db
		->where('LEMBAGA_STATUS', 'TAMPIL')
		->get('LEMBAGA');

		$source = array(
			'__title'   => APP_NAME . ' ~ Halaman Daftar Lembaga',
			'__menu'	=> 'lembaga',
			'__css'     => array('bootstrap','simpleicon','confirm','front'),
			'__js'      => array('jquery','bootstrap','confirm','front')
		);
	
		$data['__header'] = $this->load->view('member/header', $source, TRUE);
		$data['__footer'] = $this->load->view('member/footer', $source, TRUE);

		$this->load->view('member/beranda/lembaga', $data, FALSE);
	}

	public function rekening()
	{
		$data['query_rek'] = $this->db
		->where('REKENING_STATUS', 'TAMPIL')
		->get('REKENING');

		$source = array(
			'__title'   => APP_NAME . ' ~ Halaman No Rekening Tabungan',
			'__menu'	=> 'rekening',
			'__css'     => array('bootstrap','simpleicon','confirm','front'),
			'__js'      => array('jquery','bootstrap','confirm','front')
		);
	
		$data['__header'] = $this->load->view('member/header', $source, TRUE);
		$data['__footer'] = $this->load->view('member/footer', $source, TRUE);

		$this->load->view('member/beranda/rekening', $data, FALSE);
	}

	public function tentang()
	{
		$source = array(
			'__title'   => APP_NAME . ' ~ Halaman Profil Sistem',
			'__menu'	=> 'tentang',
			'__css'     => array('bootstrap','simpleicon','confirm','front'),
			'__js'      => array('jquery','bootstrap','confirm','front')
		);
	
		$data['__header'] = $this->load->view('member/header', $source, TRUE);
		$data['__footer'] = $this->load->view('member/footer', $source, TRUE);

		$this->load->view('member/beranda/tentang', $data, FALSE);
	}

	public function ketentuan()
	{
		$source = array(
			'__title'   => APP_NAME . ' ~ Halaman Ketentuan Sistem',
			'__menu'	=> 'ketentuan',
			'__css'     => array('bootstrap','simpleicon','confirm','front'),
			'__js'      => array('jquery','bootstrap','confirm','front')
		);
	
		$data['__header'] = $this->load->view('member/header', $source, TRUE);
		$data['__footer'] = $this->load->view('member/footer', $source, TRUE);

		$this->load->view('member/beranda/ketentuan', $data, FALSE);
	}

	public function masukan()
	{
		$source = array(
			'__title'   => APP_NAME . ' ~ Halaman Formulir Masukkan',
			'__menu'	=> 'masukan',
			'__css'     => array('bootstrap','simpleicon','confirm','front'),
			'__js'      => array('jquery','bootstrap','confirm','front')
		);
	
		$data['__header'] = $this->load->view('member/header', $source, TRUE);
		$data['__footer'] = $this->load->view('member/footer', $source, TRUE);

		$this->load->view('member/beranda/masukan', $data, FALSE);
	}






	public function memberList()
	{
		$this->load->model('M__member');

		// Konfigurasi paginasi
		$config['base_url']        = base_url('memberList/');
		$config['total_rows']      = $this->db->count_all('MEMBER');
		$config['per_page']        = (is_null($this->session->userdata('per_page')))? 10 : $this->session->userdata('per_page');
		
		$config['uri_segment']     = 3;
		$pilih                     = $config['total_rows'] / $config['per_page'];
		$config['num_links']       = 5;
		
		$this->pagination->initialize($config);

		$data['page']              = ($this->uri->segment(3))? $this->uri->segment(3) : 0 ;
		$data['keyword']           = $this->input->post('keyword');
		
		$this->M__member->limit    = $config['per_page'];
		$this->M__member->offset   = $data['page'];
		$this->M__member->kolom    = $this->input->post('kolom');
		$this->M__member->keyword  = $this->input->post('keyword');
		
		$data['query_member']      = $this->M__member->show();
		
		$data['limit']             = $data['query_member']->num_rows();
		$data['total_rows']        = $config['total_rows'];
		$data['paginasi']          = $this->pagination->create_links();
		$data['per_page']          = $config['per_page'];

		$data['menu'] = 'member';

		$data['header'] = $this->load->view('member/header', $data, TRUE);
		$data['footer'] = $this->load->view('member/footer', $data, TRUE);

		$this->load->view('member/beranda/member', $data, FALSE);
	}

	public function penyaluranList()
	{
		$this->load->model('M__penyaluran');

		// Konfigurasi paginasi
		$config['base_url']        = base_url('penyaluranList/');
		$config['total_rows']      = $this->db->where('NOTA.NOTA_STATUS','TERIMA')
		->join('NOTA', 'NOTA.NOTA_NO = KERANJANG.NOTA_NO', 'left')
		->get('KERANJANG')->num_rows();
		$config['per_page']        = (is_null($this->session->userdata('per_page')))? 10 : $this->session->userdata('per_page');
		
		$config['uri_segment']     = 3;
		$pilih                     = $config['total_rows'] / $config['per_page'];
		$config['num_links']       = 5;
		
		$this->pagination->initialize($config);

		$data['page']              = ($this->uri->segment(3))? $this->uri->segment(3) : 0 ;
		$data['keyword']           = $this->input->post('keyword');
		
		$this->M__penyaluran->limit    = $config['per_page'];
		$this->M__penyaluran->offset   = $data['page'];
		$this->M__penyaluran->kolom    = $this->input->post('kolom');
		$this->M__penyaluran->keyword  = $this->input->post('keyword');
		
		$data['query_penyaluran']  = $this->M__penyaluran->show();
		
		$data['limit']             = $data['query_penyaluran']->num_rows();
		$data['total_rows']        = $config['total_rows'];
		$data['paginasi']          = $this->pagination->create_links();
		$data['per_page']          = $config['per_page'];

		$data['menu'] = 'penyaluran';

		$data['header'] = $this->load->view('member/header', $data, TRUE);
		$data['footer'] = $this->load->view('member/footer', $data, TRUE);

		$this->load->view('member/beranda/penyaluran', $data, FALSE);
	}

}

/* End of file Member.php */
/* Location: ./application/controllers/Member.php */