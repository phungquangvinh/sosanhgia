<?php
use App\Models\Tags;

require_once 'inc_security.php';

$page = getValue('page', 'int', 'GET', 1, 3);
$id = getValue('id', 'int', 'GET', 0);
$keyWord = getValue('key', 'str', 'GET', '');

$arrayOption = [];
if($keyWord != '') $arrayOption['tag_name'] = $keyWord;
$pageSize = 10;

$queryTags = Tags::order_by('tag_id', 'ASC');

if (count($arrayOption) > 0){
    foreach ($arrayOption as $field => $value) {
        if ($field == 'tag_name') {
            $queryTags->where($field . " LIKE '%" . $value . "%'");
        } else {
            $queryTags->where($field . "=" . intval($value));
        }
    }
}

$queryTotal = clone $queryTags;
$totalPage = $queryTotal->count();
$listTags = $queryTags->pagination($page, $pageSize)
                            ->select_all();

echo $template->render('index', compact('listTags', 'page', 'pageSize', 'totalPage', 'load_header', 'arrayOption'));