<?
require_once ("../../resource/security/security.php");
$module_id = 67;
$module_name = "Danh mục";
//Check user login...
checkLogged();
//Check access module...
if (checkAccessModule($module_id) != 1)
    redirect($fs_denypath);
//Declare prameter when insert data
$fs_table = "categories_multi";
$id_field = "cat_id";
$name_field = "cat_name";
$break_page = "{---break---}";
$fs_filepath = "";

$fs_fieldupload = "web_logo";
$fs_extension = "gif,jpg,jpe,jpeg,png";
$fs_filesize = 1000;
$arr_resize = array(
    "small_" => array(
        "quality" => 80,
        "width" => 135,
        "height" => 80),
    "medium_" => array(
        "quality" => 80,
        "width" => 300,
        "height" => 300),
    "init_" => array(
        "quality" => 80,
        "width" => 960,
        "height" => 340
    )
);
$status_arr = array(
    1 => 'Hiển thị',
    0 => 'Ẩn',
    2 => 'Hot',
    3 => 'Hiện lên trang chủ'
);

$type_arr = array(
  ''             => 'Chọn loại danh mục',
  'news'         => 'Tin tức',
  'product'      => 'Sản phẩm',
  // 'page'         => 'Trang tĩnh',
);


$allCategoriesLevel1 = App\Models\Categories\Category::where('cat_parent_id = 0')->select_all();
if(!$allCategoriesLevel1) $allCategoriesLevel1 = new VatGia\Helpers\Collection();
$arrayCategoriesOption = [
    0 => 'Chọn cấp cha'
];

foreach($allCategoriesLevel1 as $item) {
    $arrayCategoriesOption[$item->cat_id] = $item->cat_name;
}
