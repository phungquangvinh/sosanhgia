<?php

use App\Models\Post;

require_once 'inc_security.php';

$page = getValue('page', 'int', 'GET', 1);
$id = getValue('id', 'int', 'GET', 0);
$keyWord = getValue('key', 'str', 'GET', '');

$arrayOption = [];
if($keyWord != '') $arrayOption['pos_title'] = $keyWord;
if($id > 0) $arrayOption['pos_id'] = $id;
$pageSize = 10;
$queryListPosts = Post::inner_join('categories_multi','pos_category_id=cat_id')
                        ->inner_join('admin_user','pos_author_id=adm_id')
                        ->order_by('pos_id','DESC');

if (count($arrayOption) > 0){
    foreach ($arrayOption as $field => $value) {
        if ($field == 'pos_title') {
            $queryListPosts->where($field . " LIKE '%" . $value . "%'");
        } else {
            $queryListPosts->where($field . "=" . intval($value));
        }
    }
}

$queryTotal = clone $queryListPosts;
$totalPage = $queryTotal->count();
$listPost = $queryListPosts->pagination($page, $pageSize)
                            ->select_all();


echo $template->render('index', compact('listPost', 'page', 'pageSize', 'totalPage', 'load_header', 'arrayOption'));
