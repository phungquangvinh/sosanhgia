<?php
use App\Models\Brand;

require_once 'inc_security.php';

$page = getValue('page', 'int', 'GET', 1, 3);
$id = getValue('id', 'int', 'GET', 0);
$keyWord = getValue('key', 'str', 'GET', '');

$arrayOption = [];
if($keyWord != '') $arrayOption['bra_name'] = $keyWord;
if($id > 0) $arrayOption['bra_id'] = $id;
$pageSize = 50;

$queryBrand = Brand::order_by('bra_id','ASC');

if (count($arrayOption) > 0){
    foreach ($arrayOption as $field => $value) {
        if ($field == 'bra_name') {
            $queryBrand->where($field . " LIKE '%" . $value . "%'");
        } else {
            $queryBrand->where($field . "=" . intval($value));
        }
    }
}

$queryTotal = clone $queryBrand;
$totalPage = $queryTotal->count();
$listBrand = $queryBrand->pagination($page, $pageSize)->select_all();

echo $template->render('index', compact('listBrand', 'page', 'pageSize', 'totalPage', 'load_header', 'arrayOption'));