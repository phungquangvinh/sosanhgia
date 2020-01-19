<?php

use App\Models\Categories\Category;
use VatGia\Helpers\Collection;

require_once("../../bootstrap.php");
require_once 'inc_security.php';

$type = getValue('type', 'str', 'GET', null);

$categories = Category::where('cat_type = "'.$type.'"')->select_all();
if(!$categories) $categories = new Collection();

$tempCategories = [];
foreach($categories as $item) {
    $tempCategories[] = $item->toArray();
}

echo json_encode($tempCategories);