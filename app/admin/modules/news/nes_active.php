<?php

require_once 'inc_security.php';

use App\Models\News;


$nes_id = getValue('id', 'int', 'GET', 0);

$selectNews = News::where("nes_id = '" . $nes_id . "' ")->first();

if ($selectNews) {
    $selectNews->nes_active = $selectNews->nes_active == 0 ? 1 : 0;
    $selectNews->update();

}


