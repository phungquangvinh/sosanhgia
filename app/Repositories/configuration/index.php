<?php

use App\Models\Configuration;

$data = Configuration::select_all();

return [
    'vars' => $data,
];