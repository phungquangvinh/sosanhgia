<?php
function xss_clean($data)
{
	$data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
	$data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
	$data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
	$data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

	// Remove any attribute starting with "on" or xmlns
	$data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

	// Remove javascript: and vbscript: protocols
	$data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
	$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
	$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

	// Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
	$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
	$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
	$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

	// Remove namespaced elements (we do not need them)
	$data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

	do{
	    // Remove really unwanted tags
	    $old_data = $data;
	    $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
	}while ($old_data !== $data);

	// we are done...
	return $data;
}


if( ! function_exists('get_client_ip') ) {
	/**
	 * Get client ip
	 * @return ip
	 */
	function get_client_ip() {
		if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
	    {
	      	$ip = $_SERVER['HTTP_CLIENT_IP'];
	    }
	    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
	    {
	      	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    }
	    else
	    {
	      	$ip = $_SERVER['REMOTE_ADDR'];
	    }

	    return $ip;
	}
}

if( ! function_exists('parse_file_url') ) {
    /**
     * Lấy url của ảnh
     * @param  str $image
     * @return url
     */
    function parse_file_url($image) {
        $explode = explode('___', $image);
        if(isset($explode[1])) {
            return config('upload.static_url'). config('upload.upload_folder') .'/' . date('Y/m/d', $explode[1]) . '/' . $image;
        }
    }
}

if(!function_exists('flash_message')) {
    /**
     * Flash message
     *
     * @param  string $key
     * @param  string $value
     * @return void
     */
    function flash_message($key, $value = null) {
        if(!isset($_SESSION['flash_message'])) {
            $_SESSION['flash_message'] = array();
        }

        if($value !== null) {
            $_SESSION['flash_message'][$key] = $value;
        } else {
            return isset($_SESSION['flash_message'][$key]) ? $_SESSION['flash_message'][$key] : null;
        }
    }
}

if( ! function_exists('body_class') ) {
    /**
     * Body class css
     * @param  string $file
     * @return string
     */
    function body_class() {
        $filename = basename($_SERVER['SCRIPT_FILENAME']);
        $class = '';

        switch ($filename) {
            case 'product_detail.php':
                $class = 'single single-product';
                break;

            case 'index.php':
                $class = 'home page';
                break;

            case 'category.php':
                $class = 'page';
                break;

            case 'search.php':
                $class = 'search';
                break;

            default:
                # code...
                break;
        }

        return $class;
    }
}


if( ! function_exists('response_vars') ) {
    /**
     * Response vars
     * @param  mixed $data
     * @return array
     */
    function response_vars($data) {
        return [
            'vars' => $data
        ];
    }
}

if( ! function_exists('export_vars') ) {
    /**
     * Export vars from repositories
     * @param  array $data
     * @param  string $key
     * @return mixed
     */
    function export_vars(array $data, $key) {
        return array_get($data['vars'], $key);
    }
}

function regReplaceMQ($text, $char = '-'){
    $str = trim(strtolower($text));
    $str = preg_replace('/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/', 'a', $str);
    $str = preg_replace('/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/', 'e', $str);
    $str = preg_replace('/ì|í|ị|ỉ|ĩ/', 'i', $str);
    $str = preg_replace('/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/', 'o', $str);
    $str = preg_replace('/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/', 'u', $str);
    $str = preg_replace('/ỳ|ý|ỵ|ỷ|ỹ/', 'y', $str);
    $str = preg_replace('/đ/', 'd', $str);
    $str = preg_replace('/!|@|\$|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\'|\;| |\"|\&|\#|\[|\]|~|-|_|}|{|\||\\|/', $char, $str);
    $str = preg_replace('/'.$char.'+-/', $char, $str); //thay thế 2- thành 1-
    $str = preg_replace('/^'.$char.'+|'.$char.'+$/','',$str);//cắt bỏ ký tự - ở đầu và cuối chuỗi
    return $str;
}


function rm_dir($dir)
{
    $files = array_diff(scandir($dir), array('.','..'));
    foreach ($files as $file) {
        chmod("$dir/$file", 0777);
        (is_dir("$dir/$file")) ? rm_dir("$dir/$file") : unlink("$dir/$file");
    }
    return rmdir($dir);
}
