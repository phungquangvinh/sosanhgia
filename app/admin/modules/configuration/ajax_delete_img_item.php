<?php
require_once 'inc_security.php';
use App\Models\Configuration;

$id         = getValue('id', 'str', 'POST', '', 3);
$imgName         = getValue('imgName', 'str', 'POST', '', 3);
if ($imgName) {
    $checkSup = Configuration::where('con_id='.$id)->fields('con_id', 'con_logo_top')->first();
    $img_list = json_decode($checkSup->con_logo_top, true);
    foreach ($img_list as $key => $value) {
        if($value === $imgName) {
            unset($img_list[$key]);
        }
    }
    $checkSup->update([
        'con_logo_top'=> json_encode($img_list),
    ]);

    echo json_encode($img_list);
} else {
    echo json_encode(false);
}