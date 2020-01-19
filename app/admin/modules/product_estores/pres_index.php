<?php
use App\Models\ProductEstore;

require_once 'inc_security.php';

$page = getValue('page', 'int', 'GET', 1, 3);

$id = getValue('id', 'int', 'GET', 0);
$productId = getValue('product', 'int', 'GET', 0);
$estoreId = getValue('user_estore', 'int', 'GET', 0);
$keyWordProduct = getValue('key1', 'str', 'GET', '');
$keyWordEstore = getValue('key2', 'str', 'GET', '');

$arrayOption = [];
if($keyWordProduct != '') $arrayOption['pro_name'] = $keyWordProduct;
if($keyWordEstore != '') $arrayOption['ue_name'] = $keyWordEstore;
if($id > 0) $arrayOption['pres_id'] = $id;

$pageSize = 10;

$queryListProductEstore = ProductEstore::inner_join('products', 'pres_product_id = pro_id')
                                        ->inner_join('user_estores', 'pres_estore_id = ue_id')
                                        ->order_by('pres_id', 'ASC');

if(count($arrayOption) > 0){
    foreach($arrayOption as $field => $value){
        if($field == 'pro_name'){
            $queryListProductEstore->where($field." LIKE '%".$value."%'");
        }else{
            $queryListProductEstore->where($field."=".intval($value));
        }
        if($field == 'ue_name'){
            $queryListProductEstore->where($field." LIKE '%".$value."%'");
        }else{
            $queryListProductEstore->where($field."=".intval($value));
        }
    }
}

$queryTotal = clone $queryListProductEstore;
$totalPage = $queryTotal->count();
$listProductEstore = $queryListProductEstore->pagination($page, $pageSize)
                                            ->select_all();

echo $template->render('index', compact('listProductEstore', 'page', 'pageSize', 'totalPage', 'load_header', 'arrayOption'));