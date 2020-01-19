<?php

require_once 'inc_security.php';

use App\Models\AdminUser;

$page = getValue('page', 'int', 'GET', 1, 3);
$pageSize = 30;

$users = AdminUser::order_by('adm_id', 'DESC')->pagination($page, $pageSize)->select_all();

echo $template->render('index', compact('users', 'load_header'));