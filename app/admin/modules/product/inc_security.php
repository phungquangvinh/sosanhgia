<?
require_once("../../bootstrap.php");
require_once("../../resource/security/security.php");

$module_id  = 66;
$module_name= "Product";
//Check user login...
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);

// Template engine
$template = new TemplateEngine(
    __DIR__ . '/templates'
);

$menu = new menu();
$menu->getAllChild('categories_multi', 'cat_id', 'cat_parent_id', 0, 'cat_type="product"','cat_id,cat_name,cat_parent_id','cat_order ASC');
$tempCategoryArray = $menu->menu;
$categoryArray = [];
foreach($tempCategoryArray as $item) {
    $category = new \App\Models\Categories\Category();
    foreach($item as $k => $v) {
        $category->$k = $v;
    }
    $categoryArray[] = $category;
}

$categories = new \VatGia\Helpers\Collection($categoryArray);
$vgSiteId = 6;