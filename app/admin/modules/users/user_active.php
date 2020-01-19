<?php
use App\Models\Users\Users;

require_once 'inc_security.php';

$use_id = getValue('id', 'int', 'GET', 0);

$selectUser = Users::where("use_id = '" .$use_id. "'")->first();

if($selectUser) {
    $selectUser->use_active = $selectUser->use_active == 0 ? 1 : 0;
    $selectUser->update();
}