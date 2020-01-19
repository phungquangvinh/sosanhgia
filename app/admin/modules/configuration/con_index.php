<?php

require_once 'inc_security.php';

use App\Models\Configuration;

$page = getValue('page', 'int', 'GET', 1, 3);
$pageSize = 5;

$totalPage = Configuration::order_by('con_id', 'DESC')->select_all()->count();
$configuration = Configuration::order_by('con_id', 'DESC')->pagination($page, $pageSize)->select_all();

echo $template->render('index', compact('configuration', 'load_header','page','pageSize','totalPage'));