<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
    
    public function __construct()
	{
		parent::__construct();
		//Do your magic here

		// 	Set Time Default "Indonesia"
		date_default_timezone_set('Asia/Jakarta');

	}

	public function index()
	{
		// set API Endpoint and access key (and any options of your choice)
		$endpoint = 'live';
		$access_key = '82ae7db82442bf2ca447c994894974ca';

		// Initialize CURL:
		$ch = curl_init('http://apilayer.net/api/'.$endpoint.'?access_key='.$access_key.'');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// Store the data:
		$json = curl_exec($ch);
		curl_close($ch);

		// Decode JSON response:
		$exchangeRates = json_decode($json, true);

		// Access the exchange rate values, e.g. GBP:
		echo $exchangeRates['quotes']['USDIDR'];

		// print_r($exchangeRates);

	}
	
	public function provinsi(){
	    
	    $provinsi = json_decode(file_get_contents('http://dev.farizdotid.com/api/daerahindonesia/provinsi'));
        
        $html = '';
        
        for( $i=0; $i< count($provinsi->semuaprovinsi); $i++ )
        {
            $html .= '<option value="'.$provinsi->semuaprovinsi[$i]->nama.'" data-id="'.$provinsi->semuaprovinsi[$i]->id.'">'.$provinsi->semuaprovinsi[$i]->nama.'</option>';
        }
        
        echo $html;
	}
	
	public function kabupaten(){
	    
	    $kabupaten = json_decode(file_get_contents('http://dev.farizdotid.com/api/daerahindonesia/provinsi/'.$this->uri->segment(3).'/kabupaten'));
        
        $html = '';
        
        for( $i=0; $i< count($kabupaten->daftar_kecamatan); $i++ )
        {
            $html .= '<option value="'.$kabupaten->daftar_kecamatan[$i]->nama.'" data-id="'.$kabupaten->daftar_kecamatan[$i]->id.'">'.$kabupaten->daftar_kecamatan[$i]->nama.'</option>';
        }
        
        echo $html;
	}
	
	public function kecamatan(){
	    
	    $kecamatan = json_decode(file_get_contents('http://dev.farizdotid.com/api/daerahindonesia/provinsi/kabupaten/'.$this->uri->segment(3).'/kecamatan'));
        
        $html = '';
        
        for( $i=0; $i< count($kecamatan->daftar_kecamatan); $i++ )
        {
            $html .= '<option value="'.$kecamatan->daftar_kecamatan[$i]->nama.'" data-id="'.$kecamatan->daftar_kecamatan[$i]->id.'">'.$kecamatan->daftar_kecamatan[$i]->nama.'</option>';
        }
        
        echo $html;
	}
	
	public function desa(){
	    
	    $desa = json_decode(file_get_contents('http://dev.farizdotid.com/api/daerahindonesia/provinsi/kabupaten/kecamatan/'.$this->uri->segment(3).'/desa'));
        
        $html = '';
        
        for( $i=0; $i< count($desa->daftar_desa); $i++ )
        {
            $html .= '<option value="'.$desa->daftar_desa[$i]->nama.'" data-id="'.$desa->daftar_desa[$i]->id.'">'.$desa->daftar_desa[$i]->nama.'</option>';
        }
        
        echo $html;
	}

	public function getSaldo()
	{
		$this->load->model('M__tabungan');
		echo $this->M__tabungan->saldo($this->session->userdata('__ci_member_id'));
	}

	public function getSaldoRp()
	{
		$this->load->model('M__tabungan');
		$this->load->helper('help');
		
		echo __rp($this->M__tabungan->saldo($this->session->userdata('__ci_member_id')));
	}

}

/* End of file api.php */
/* Location: ./application/controllers/api.php */
