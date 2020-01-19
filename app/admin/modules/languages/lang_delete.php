<?php
use App\Models\Languages;

include 'inc_security.php';

$id = getValue('id', 'int', 'GET', 0);

$row = Languages::where('lang_id = '.$id)->select();


Languages::where('lang_id = '.$id)->delete();

flash_message('success', 'Xóa thành công');
redirect('lang_index.php');