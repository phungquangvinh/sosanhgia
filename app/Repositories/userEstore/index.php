<?php

use App\Models\UserEstore;

$data = UserEstore::select_all();
return [
    'vars' => $data
];
