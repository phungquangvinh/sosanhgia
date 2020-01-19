<?php

require 'inc_security.php';

$list = new fsDataGird('pro_id', 'pro_name', "Danh sach");

$page = getValue('page', 'int', 'GET', 1);
$pageSize = 30;

$mProduct = new App\Models\Product();
$products = $mProduct
    ->where(1)
    ->pagination($page, $pageSize);

// View
$template = new TemplateEngine(
    __DIR__ . '/templates'
);

echo $template->render('index.html', compact('products', 'list', 'load_header'));