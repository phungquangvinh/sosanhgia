<?php

use App\Models\Banner;

$page = $input['page'] ;
$position = $input['position'];


$data = Banner::where('ban_active = 1')
    ->where('ban_page= "'.$page.'" ')
    ->where('ban_position= "'.$position.'" ');


$data = $data->select_all();

return [
    'vars' => [
        'listBanner' => $data,
    ]
];


