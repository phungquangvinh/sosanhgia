<?php
require 'inc_security.php';
use App\Models\Banner;

$picture = "";
$pictureSmall = "";


if (isset($_POST['submit'])) {
    if($_FILES['picture']['error'] == 0) {
        $picture = app('uploader')->upload('picture');
    }
    if($_FILES['picture_small']['error'] == 0) {
        $pictureSmall = app('uploader')->upload('picture_small');
    }

    $arrData['ban_name']=getValue('name','str',"POST","");
    $arrData['ban_description']=getValue('description','str',"POST","");
    $arrData['ban_picture']=$picture;
    $arrData['ban_picture_small']=$pictureSmall;
    $arrData['ban_page']=getValue('page','str','POST',"");
    $arrData['ban_position']=getValue('position','str','POST',"");
    $arrData['ban_active']=getValue('active','str','POST',"");


    Banner::insert($arrData);
    flash_message('success', 'Thêm mới thành công');
    redirect('listing.php');
}


echo $template->render('add', compact('page','position','active','load_header'));