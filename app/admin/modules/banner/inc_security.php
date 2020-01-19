<?
require_once("../../bootstrap.php");
require_once("../../resource/security/security.php");
$module_id = '';
$module_name = "Banner";
//Check user login...
checkLogged();
//Check access module...
if (checkAccessModule($module_id) != 1) redirect($fs_denypath);

// Template engine
$template = new TemplateEngine(
    __DIR__ . '/templates'
);
 $page = array(
     "home_page" => "Trang Chủ",
     "detail" => "Trang Chi Tiết"
 );

 $position = array(
     "top_left" => "Top - Left",
     "top_right" => "Top - Right",
     "top_center" => "Top - Center",
     "middle_left" => "Middle - Left",
     "middle_right" => "Middle - Right",
     "middle_center" => "Middle - Center",
     "bottom_left" => "Bottom - Left",
     "bottom_right" => "Bottom - Right",
     "bottom_center" => "Bottom - Center",
 );

 $active = array(
     "1" => "Active",
     "0" => "Unactive"
 );

