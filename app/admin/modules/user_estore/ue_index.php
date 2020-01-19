<?php
use App\Models\UserEstore;

require_once 'inc_security.php';

$page = getValue('page', 'int', 'GET', 1, 3);
$id = getValue('id', 'int', 'GET', 0);
$keyWord = getValue('key', 'str', 'GET', '');

$arrayOption = [];
if($keyWord != '') $arrayOption['ue_name'] = $keyWord;
if($id > 0) $arrayOption['ue_id'] = $id;
$pageSize = 10;

$queryUserEstore = UserEstore::order_by('ue_id', 'ASC');

if (count($arrayOption) > 0){
    foreach ($arrayOption as $field => $value) {
        if ($field == 'ue_name') {
            $queryUserEstore->where($field . " LIKE '%" . $value . "%'");
        } else {
            $queryUserEstore->where($field . "=" . intval($value));
        }
    }
}

$queryTotal = clone $queryUserEstore;
$totalPage = $queryTotal->count();
$listUserEstore = $queryUserEstore
                        ->pagination($page, $pageSize)
                        ->select_all();


echo $template->render('index', compact('listUserEstore', 'page', 'pageSize', 'totalPage', 'load_header', 'arrayOption'));