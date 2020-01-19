<?php
use App\Models\Users\Users;

require_once 'inc_security.php';

$page = getValue('page', 'int', 'GET', 1, 3);
$id = getValue('id', 'int', 'GET', 0);
$keyWord = getValue('key', 'str', 'GET', '');

$arrayOption = [];
if($keyWord != '') $arrayOption['use_name'] = $keyWord;
$pageSize = 10;

$queryListUser = Users::inner_join('city','use_city = cit_id')
    ->order_by('use_id', 'ASC');

if (count($arrayOption) > 0){
    foreach ($arrayOption as $field => $value) {
        if ($field == 'use_name') {
            $queryListUser->where($field . " LIKE '%" . $value . "%'");
        } else {
            $queryListUser->where($field . "=" . intval($value));
        }
    }
}

$queryTotal = clone $queryListUser;
$totalPage = $queryTotal->count();
$listUser = $queryListUser
                    ->pagination($page, $pageSize)
                    ->select_all();

echo $template->render('index', compact('listUser', 'page', 'pageSize', 'totalPage', 'load_header', 'arrayOption'));
