<?php

require_once 'inc_security.php';

use App\Models\News;

$page       = getValue('page', 'int', 'GET', 1, 3);
$action     = getValue('action', 'str', 'GET', 1, 3);
$name       = getValue('name', 'str', 'GET', 1, 3);
$start      = getValue('start','str', 'GET', null);
$end        = getValue('end','str', 'GET', null);
$startday   = strtotime($start . ' 00:00');
$endday     = strtotime($end . ' 23:59');
$pageSize   = 10;

$model = new News();

if ($action=='filter') {
    if ($name) {
        $model->where('nes_title LIKE "%'.$name.'%"');
    }
    if($startday && $endday){
        $model->where('nes_create_time <= ' . $endday)->where('nes_create_time >= ' . $startday);
    }
}

$totalPage = $model->select_all()->count();

$dataTable = $model
->order_by('nes_id', 'DESC')
->pagination($page, $pageSize)
->fields('nes_id', 'nes_title', 'nes_description', 'nes_content', 'nes_type_id', 'nes_image', 'nes_author_id', 'nes_create_time', 'nes_update_time', 'nes_active')
->select_all();

echo $template->render('index', compact('load_header', 'dataTable', 'page', 'pageSize', 'totalPage'));
