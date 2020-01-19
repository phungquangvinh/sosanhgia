<?php

use App\Models\Languages;

include 'inc_security.php';

$page = getValue('page', 'int', 'GET', 1, 3);
$pageSize = 10;

$languages = Languages::select_all();

echo $template->render('index', compact('languages', 'load_header'));