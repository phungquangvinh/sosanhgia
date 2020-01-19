<?php

use App\Models\Menu;

$data = Menu::fields('menu_id','menu_name','menu_icon','menu_description','menu_link')->select_all();

return [
    'vars' => $data,
];