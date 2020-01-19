<?php
require 'inc_security.php';
use App\Models\Banner;



$searchPage=getValue('page','str','GET',"");
$searchPosition=getValue('position','str','GET',"");

$page_web = getValue('page','str','GET',1);
$pageSize = 10;


$data = Banner::pagination($page_web, $pageSize)->order_by('ban_id','DESC');
$queryCount = Banner::where(1);

if ($searchPage) {
    $data->where('ban_page="'.$searchPage.'"');
    $queryCount->where('ban_page="'.$searchPage.'"');
}
if ($searchPosition) {
    $data->where('ban_position="'.$searchPosition.'"');
    $queryCount->where('ban_position="'.$searchPosition.'"');
}

$showData=$data->select_all();
$totalPage = $queryCount->select_all()->count();


if (isset($_GET['reset'])) {
    redirect('listing.php');
}

echo $template->render('index', compact('page_web','pageSize','totalPage','showData','searchPage','searchPosition','page','position','load_header'));