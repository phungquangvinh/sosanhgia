<?php

use App\Models\ProductImages;

require_once 'inc_security.php';

$page = getValue('page', 'int', 'GET', 1, 3);

$id = getValue('id', 'int', 'GET', 0);
$productId = getValue('product', 'int', 'GET', 0);
$keyWord = getValue('key', 'str', 'GET', '');

$arrayOption = [];
if($keyWord != '') $arrayOption['pro_name'] = $keyWord;
if($productId != 0) $arrayOption['prim_product_id'] = $productId;
if($id > 0) $arrayOption['pro_id'] = $id;

$pageSize = 50;

$queryProductImages = ProductImages::inner_join('products', 'pro_id=prim_product_id')
                                    ->order_by('pro_id', 'ASC');

if (count($arrayOption) > 0){
    foreach ($arrayOption as $field => $value) {
        if ($field == 'pro_name') {
            $queryProductImages->where($field . " LIKE '%" . $value . "%'");
        } else {
            $queryProductImages->where($field . "=" . intval($value));
        }
    }
}

$queryTotal = clone $queryProductImages;
$totalPage = $queryTotal->count();
$productImages = $queryProductImages->pagination($page, $pageSize)
                                    ->select_all();


echo $template->render('index', compact('productImages', 'page', 'pageSize', 'totalPage', 'load_header', 'arrayOption'));