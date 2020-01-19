<?php

use App\Models\Product;

include 'inc_security.php';

$page = getValue('page', 'int', 'GET', 1);

$id = getValue('id', 'int', 'GET', 0);
$cateId = getValue('category', 'int', 'GET', 0);

$siteId = getValue('site', 'int', 'GET', 0);
$keyWord = getValue('key', 'str', 'GET', '');

$arrayOption = [];
if($keyWord != '') $arrayOption['pro_name'] = $keyWord;

if($cateId != 0) $arrayOption['pro_category_id'] = $cateId;
if($siteId != 0) $arrayOption['pro_source_id'] = $siteId;
if($id > 0) $arrayOption['pro_id'] = $id;

$pageSize = 20;

$queryListProduct = Product::inner_join('categories_multi', 'pro_category_id=cat_id')
                            ->order_by('pro_id', 'DESC');

if(count($arrayOption) > 0){
    foreach($arrayOption as $field => $value){
        if($field == 'pro_name'){
            $queryListProduct->where($field." LIKE '%".$value."%'");
        }else{
            $queryListProduct->where($field."=".intval($value));
        }
    }
}

$totalPage = 2053982;

$listProduct = $queryListProduct
                                ->pagination($page, $pageSize)
                                ->select_all();
// dd($queryListProduct);die;

// edit keyword và keywordignore

$idProduct = getValue('valueIdproduct','int','POST','');
$valueKeyword = getValue('valueDatakeyword','str','POST','');
$type = getValue('valueType','str','POST','');

$dataKeyword=Product::where('pro_id='.$idProduct);

if ($type=='keyword') {
   $dataKeyword->update([
        'pro_keywords' => $valueKeyword
   ]);
}else if ($type='keywordignore'){
    $dataKeyword->update();
};



echo $template->render('product_url/index', compact('listProduct', 'page', 'pageSize', 'totalPage', 'load_header','categories', 'arrayOption'/*, 'brand', 'sites'*/));