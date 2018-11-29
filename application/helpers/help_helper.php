<?php 

if (! function_exists('__password')) 
{
	function __password($string)
	{
		$x = '';
		$text = strlen($string);

		for($i=0;$i<$text;$i++)
		{
			$x .= (ord($string[$i])+$i);
		}

		return $x-2;
	}
}

if (! function_exists('__menu_active')) 
{
	function __menu_active($default, $menu)
	{
		return ($default==$menu)? 'active' : '';
	}
}

if (! function_exists('__tgl_full')) 
{
	function __tgl_full($string)
	{
		return date('d/m/Y H:i:s', $string);
	}
}

if (! function_exists('__tgl_dmy')) 
{
	function __tgl_dmy($string)
	{
		return date('d/m/Y', strtotime($string));
	}
}

if (! function_exists('__rp')) 
{
	function __rp($number)
	{
		return 'Rp. '.str_replace(',', '.', number_format($number)).',00';
	}
}

if (! function_exists('__css')) {
	function __css($css){

		$src = '';

		switch ($css) {

			case 'bootstrap':
				$src = base_url().'assets/bootstrap-4/css/bootstrap.min.css';
				break;
			case 'fontawesome':
				$src = base_url().'assets/font-awesome/css/font-awesome.min.css';
				break;
			case 'simpleicon':
				$src = base_url().'assets/simple-line-icons/css/simple-line-icons.css';
				break;
			case 'owl':
				$src = base_url().'assets/owl/owlcarousel/assets/owl.carousel.min.css';
				break;
			case 'owltheme':
				$src = base_url().'assets/owl/owlcarousel/assets/owl.theme.default.min.css';
				break;
			case 'confirm':
				$src = base_url().'assets/jquery-confirm/css/jquery-confirm.min.css';
				break;
			case 'dropzone-basic':
				$src = base_url().'assets/dropzone/min/basic.min.css';
				break;
			case 'dropzone':
				$src = base_url().'assets/dropzone/dropzone.css';
				break;
			case 'summernote':
				$src = 'https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css';
				break;
			case 'front':
				$src = base_url().'assets/front.css';
				break;
			case 'back':
				$src = base_url().'assets/back.css';
				break;
			
			default:

				break;
		}

		return '<link rel="stylesheet" href="'.$src.'"/>';
	}
}

if (! function_exists('__js')) {
	function __js($js){

		$src = '';

		switch ($js) {

			case 'bootstrap':
				$src = base_url().'assets/bootstrap-4/js/bootstrap.min.js';
				break;
			case 'jquery':
				$src = base_url().'assets/jquery/jquery.min.js';
				break;
			case 'checkall':
				$src = base_url().'assets/jquery/jquery-check-all.js';
				break;
			case '__checkall':
				$src = base_url().'assets/jquery/__jquery-check-all.js';
				break;
			case 'maskmoney':
				$src = base_url().'assets/jquery/jquery.maskMoney.js';
				break;
			case 'owl':
				$src = base_url().'assets/owl/owlcarousel/owl.carousel.js';
				break;
			case 'parsley':
				$src = base_url().'assets/parsley/parsley.min.js';
				break;
			case 'confirm':
				$src = base_url().'assets/jquery-confirm/js/jquery-confirm.min.js';
				break;
			case 'dropzone':
				$src = base_url().'assets/dropzone/dropzone.js';
				break;
			case 'popper':
				$src = 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js';
				break;
			case 'summernote':
				$src = 'https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js';
				break;
			case 'chartjs':
				$src = base_url().'assets/chart-js/Chart.bundle.js';
				break;
			case 'chartjsutils':
				$src = base_url().'assets/chart-js/utils.js';
				break;
			case 'front':
				$src = base_url().'assets/front.js';
				break;
			case 'back':
				$src = base_url().'assets/back.js';
				break;
			
			default:

				break;
		}

		return '<script src="'.$src.'"></script>';
	}
}


if(! function_exists('normal_string')  )
{
	function normal_string($str = '')
	{
	    $str = strip_tags($str); 
	    $str = preg_replace('/[\r\n\t ]+/', ' ', $str);
	    $str = preg_replace('/[\"\*\/\:\<\>\?\'\|]+/', ' ', $str);
	    $str = strtolower($str);
	    $str = html_entity_decode( $str, ENT_QUOTES, "utf-8" );
	    $str = htmlentities($str, ENT_QUOTES, "utf-8");
	    $str = preg_replace("/(&)([a-z])([a-z]+;)/i", '$2', $str);
	    $str = str_replace(' ', '-', $str);
	    $str = rawurlencode($str);
	    $str = str_replace('%', '-', $str);
	    return $str;
	}
}



