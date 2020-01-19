<?php
use App\Models\Menu;

require_once 'inc_security.php';

$id =  getValue('id', 'int', 'GET', 0);

$row = Menu::where('menu_id = '.$id)->select();


Menu::where('menu_id = '.$id)->delete();

flash_message('Success', 'Xóa thành công');
redirect('menu_index.php');