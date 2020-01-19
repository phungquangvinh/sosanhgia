<?php
require 'inc_security.php';
use App\Models\Banner;

$id=getValue('id','str','GET',"");
$dataEdit = Banner::Where("ban_id=".$id)->select();

$picture = $dataEdit->picture;
$pictureSmall = $dataEdit->picture_small;

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

    Banner::Where("ban_id=".$id)->update($arrData);
    flash_message('success', 'Cập nhật thành công');
    redirect('listing.php');
}
echo $template->render('edit', compact('page','active','position','dataEdit','load_header'));