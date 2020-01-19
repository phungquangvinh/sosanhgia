<?php
use App\Models\Menu;

require_once 'inc_security.php';

$page = getValue('page', 'int', 'GET', 1, 3);
$id = getValue('id', 'int', 'GET', 0);
$keyWord = getValue('key', 'str', 'GET', '');

$arrayOption = [];
if($keyWord != '') $arrayOption['menu_name'] = $keyWord;
if($id > 0) $arrayOption['menu_id'] = $id;
$pageSize = 10;

$queryListMenu = Menu::order_by('menu_id', 'DESC');

if (count($arrayOption) > 0){
    foreach ($arrayOption as $field => $value) {
        if ($field == 'menu_name') {
            $queryListMenu->where($field . " LIKE '%" . $value . "%'");
        } else {
            $queryListMenu->where($field . "=" . intval($value));
        }
    }
}

$queryTotal = clone $queryListMenu;
$totalPage = $queryTotal->count();
$listMenu = $queryListMenu
                    ->pagination($page, $pageSize)
                    ->select_all();

echo $template->render('index', compact('listMenu', 'page', 'pageSize', 'totalPage', 'load_header', 'arrayOption'));