<?php

use App\Models\Product;
use App\Models\CategoryProduct;

$name      = $input['name'];
$page      = $input['page'];
$pageSize  = $input['pageSize'];
$totalPage = 0;
//dd($name);

$model = Product::where('pro_name LIKE "%' . $name . '%"');
$data = $model->fields('pro_name','pro_id','pro_price','pro_picture')
    ->pagination($page, $pageSize)->order_by("pro_id","DESC")
    ->select_all();
    
if($data > 0){
	$totalPage = 80;
}    

return [
    'vars' => [
        'listSearch' => $data,
        'totalPage' => $totalPage,
    ]
];
