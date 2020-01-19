<?php

use App\Models\Product;
use App\Models\ProductEstore;
use App\Models\CategoryProduct;

$dataCateAllChild = $input['dataCateAllChild'];
// dd($dataCateAllChild);
	
$data = Product::
    where('pro_category_id IN (' . $dataCateAllChild . ')')
    ->where('pro_price > 0')
    ->order_by('pro_id','DESC')->limit(20)
    ->select_all();

// lấy danh mục hot
$cateList = "";
$dataProductCate = [];
$arrCate = CategoryProduct::where('cat_hot = 1')->where('cat_id IN (' . $dataCateAllChild . ')')->fields('cat_id','cat_name','cat_hot','cat_background_home_page','cat_all_child')->limit(4)->select_all();

foreach ($arrCate as $key => $value) {
    $dataProductCate[$value->cat_id] = Product::limit(4)
    ->where(' pro_category_id IN ('.$value->cat_all_child.') ')
    // ->inner_join('product_estores', 'pres_product_id = pro_id')
    ->order_by('pro_id','DESC')->select_all();
    // dd($dataProductCate[$value->cat_id]);
}

return [
    'vars' => [
        'data' => $data,
        'dataProductCate' => $dataProductCate,
        'dataCate' => $arrCate
    ]
];
