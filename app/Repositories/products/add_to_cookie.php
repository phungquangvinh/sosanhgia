<?php

$pro_id = input('pro_id') ? : 0;

$listProductViews = isset($_COOKIE['USER_PRODUCT_VIEWS']) ? $_COOKIE['USER_PRODUCT_VIEWS'] : "" ;

if($pro_id > 0){
	$listProductViews .= ",".$pro_id;
}

$arrProductViews = convert_list_to_array($listProductViews);
$arrProductViews = array_unique($arrProductViews);

if(count($arrProductViews) > 4){
	array_shift($arrProductViews);
}

setcookie('USER_PRODUCT_VIEWS', convert_array_to_list($arrProductViews), time() + 30 * 86400, '/');

return [
    'vars' => $listProductViews,
];