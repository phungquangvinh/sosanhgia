<?php

use App\Models\CategoryProduct;

$dataCatelv2       = array();
$dataCatelv3       = array();
$listCateParentLv2 = "";
$listCateParentLv3 = "";
$list_cat_id       = "";


$data_cate_parent = CategoryProduct::where('cat_parent_id = 0')
// ->where('cat_type = "PRODUCT" AND cat_active = 1')
->select_all();
// dd($data_cate_parent);die;

$data_cate_parent = CategoryProduct::where('cat_parent_id = 0')->where('cat_active = 1')->select_all();

foreach ($data_cate_parent as $listCategoryChilds) {
	$listCateParentLv2 .= $listCategoryChilds->cat_id.",";
    $list_cat_id .= $listCategoryChilds->cat_all_child.",";
}
$list_cat_id = substr($list_cat_id,0,-1);

$listCateParentLv2 = substr($listCateParentLv2, 0, -1);
if($listCateParentLv2 != ""){
    $dataCatelv2 = CategoryProduct::where('cat_parent_id IN (' . $listCateParentLv2 . ')')->select_all();
	// $dataCatelv2 = CategoryProduct::where('cat_parent_id IN (' . $listCateParentLv2 . ') AND cat_active = 1')->select_all();
    foreach ($dataCatelv2 as $key => $value) {
    	$listCateParentLv3 .= $value->cat_id.",";
    }
}
$listCateParentLv3 = substr($listCateParentLv3, 0, -1);
if($listCateParentLv3 != ""){
	$dataCateChild = CategoryProduct::where('cat_parent_id IN (' . $listCateParentLv3 . ') ')->select_all();
    foreach ($dataCateChild as $key => $value) {
    	$dataCatelv3[$value->cat_parent_id][] = $value;
    }
}

return [
    'vars' => [
        'dataCatelv2'         => $dataCatelv2,
        'dataCatelv3'         => $dataCatelv3,
        'listCategoryProduct' => $data_cate_parent,
        'list_cat_id'         => $list_cat_id,
    ]
];
