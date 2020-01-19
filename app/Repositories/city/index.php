<?php

use App\Models\City;

$data = City::select_all();
return [
    'vars' => $data
];
