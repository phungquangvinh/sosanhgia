<?php
require_once 'inc_security.php';
use App\Models\Banner;

$id         = getValue('id', 'str', 'POST', '', 3);
$imgName         = getValue('imgName', 'str', 'POST', '', 3);
if ($imgName) {
    $checkSup = Banner::where('ban_id='.$id)->fields('ban_id', 'ban_picture')->first();
    $img_list = json_decode($checkSup->ban_picture, true);
    foreach ($img_list as $key => $value) {
        if($value === $imgName) {
            unset($img_list[$key]);
        }
    }
    $checkSup->update([
        'ban_picture'=> json_encode($img_list),
    ]);

    echo json_encode($img_list);
} else {
    echo json_encode(false);
}