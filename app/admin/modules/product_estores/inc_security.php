<?php
require_once("../../bootstrap.php");
require_once("../../resource/security/security.php");

$module_id = '';
$module_name = "Product estore";

//Check user login...
checklogged();
//Check access module...
if (checkAccessModule($module_id) != 1) {
    redirect($fs_denypath);
}

// Template engine
$template = new TemplateEngine(
    __DIR__ . '/templates'
);

//$menu = new menu();
//$menu->getAllChild('user_estores','ue_id','ue_name','ue_link','ue_image','ue_create_time','ue_update_time');
//$tempUserEstoreArray = $menu->menu;
//$userEstoreArray = [];
//foreach($tempUserEstoreArray as $item) {
//    $estore = new \App\Models\UserEstore();
//    foreach($item as $k => $v) {
//        $estore->$k = $v;
//    }
//    $userEstoreArray[] = $estore;
//}
//$estores = new \VatGia\Helpers\Collection($userEstoreArray);
