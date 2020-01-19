<?php

require_once 'inc_security.php';

use App\Models\Configuration;


$pictureTop = "";
$pictureBottom = "";


if (isset($_POST['submit'])) {
    if($_FILES['logo_top']['error'] == 0) {
        $pictureTop = app('uploader')->upload('logo_top');
    }
    if($_FILES['logo_bottom']['error'] == 0) {
        $pictureBottom = app('uploader')->upload('logo_bottom');
    }


    $arrData['con_admin_email']=getValue('admin_email','str',"POST","");
    $arrData['con_address']=getValue('address','str',"POST","");
    $arrData['con_logo_top']=$pictureTop;
    $arrData['con_logo_bottom']=$pictureBottom;
    $arrData['con_hotline']=getValue('hotline','str','POST',"");
    $arrData['con_facebook']=getValue('facebook','str','POST',"");
    $arrData['con_twitter']=getValue('twitter','str','POST',"");
    $arrData['con_youtube']=getValue('youtube','str','POST',"");


    Configuration::insert($arrData);
    flash_message('success', 'Thêm mới thành công');
    redirect('con_index.php');
}

echo $template->render('create', compact('load_header'));
