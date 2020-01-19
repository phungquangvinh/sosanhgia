<?php

use App\Models\Product;

$data = '';

if(isset($_GET["cat"]))
{
    $cat=$_GET["cat"];
    switch($cat)
    {
        case 1:
            $data = Product::limit(8)->where('pro_category_id = 1')->select_all();
            break;
        case 15:
            $data = Product::limit(8)->where('pro_category_id = 15')->select_all();
            break;
        case 156:
            $data = Product::limit(8)->where('pro_category_id = 156')->select_all();
            break;
        case 157:
            $data = Product::limit(8)->where('pro_category_id = 157')->select_all();
            break;
        case 158:
            $data = Product::limit(8)->where('pro_category_id = 158')->select_all();
            break;
    }
}
else{
    $data = Product::limit(8)->select_all();
}


return [
    'vars' => [
        'listProducts' => $data,
    ]
];
