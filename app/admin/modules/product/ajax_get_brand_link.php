<?php

require_once 'inc_security.php';

$apiUser = 'gian_hang_vg';
$apiPassword = 12345678;
$apiUrl = 'http://graph.vatgia.vn/v1/products/fromurl';

function convert_name($value) {
	preg_match('#(.+)\s\([\d.]+\)#', $value, $matches);
	if(isset($matches[1])) {
		$name = $matches[1];
		$name = trim($name, ' ');
		return $name;
	}

	return $value;
}

function get_max_page($link) {
	global $apiUrl;
	global $apiUser;
	global $apiPassword;

	$url = $apiUrl.'?'.http_build_query([
        'url_base' => base64_encode($link),
        'get_total_page' => 1
    ]);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    curl_setopt($ch, CURLOPT_USERPWD, $apiUser . ":" . $apiPassword);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $return = curl_exec($ch);
    curl_close($ch);

    $dataDecoded = json_decode($return, true);

    return array_get($dataDecoded, 'total_page', 1);
}

$url = getValue('url', 'str', 'POST', '');

use Hug\Xpath\Xpath as Xpath;
use Sunra\PhpSimple\HtmlDomParser;

$httpCode = 0;
$retryCount = 0;
// Thử cho đến khi nào lấy được mới thôi
while ($retryCount < 20) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)");
	curl_setopt($ch, CURLOPT_REFERER, $url);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_ENCODING , "gzip");
	curl_setopt($ch, CURLOPT_TIMEOUT, 0); // Unlimited timeout
	$data = curl_exec($ch);
	$curlError = curl_error($ch);
	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);

	$retryCount ++;
}


if($curlError) {
	dd("Curl error:: ".$curlError.', Http code:: '. $httpCode);
}

$dom = HtmlDomParser::str_get_html( $data );

if(!is_object($dom)) {
	dd($dom);
}

$brandLinks = [];

$brandHighLight = $dom->find('div[id=quick_search_filter] td[class=filter] div[class=picture] a');
foreach($brandHighLight as $item) {
	$brandLinks[] = [
		'url' => 'http://vatgia.com'.$item->href,
		'name' => convert_name($item->title),
		'max_page' => get_max_page($item->href)
	];
}

$brandNormal = $dom->find('div[id=quick_search_filter] tr');
foreach($brandNormal as $k => $tr) {
	// Chỉ lấy tr đầu tiên
	if($k > 0) break;
	$elements = $tr->find('td[class=filter] ul li a');
	foreach($elements as $a) {
		$brandLinks[] = [
			'url' => 'http://vatgia.com'.$a->href,
			'name' => convert_name($a->plaintext),
			'max_page' => get_max_page($a->href)
		];
	}
}

echo $template->render('vg_brand_url/brand_link_item', compact('load_header', 'brandLinks', 'categories'));