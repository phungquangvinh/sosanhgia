<?php

use App\Models\Product;


$listProductViews = $_COOKIE['USER_PRODUCT_VIEWS'] ?? false;

if($listProductViews != ""){
    $items = Product::where('pro_id IN (' . $listProductViews . ')')
        ->fields('pro_id', 'pro_name','pro_picture','pro_price')
        ->select_all();
}




return [
    'vars' =>  $items,
// 'totalPage' => isset($totalPage) ? $totalPage : 0,
];