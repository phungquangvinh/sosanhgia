<?php
use App\Models\ProductImages;

require_once 'inc_security.php';

$id =  getValue('id', 'int', 'GET', 0);

$row = ProductImages::where('prim_id = '.$id)->select();


ProductImages::where('prim_id = '.$id)->delete();

flash_message('Success', 'Xóa thành công');
redirect('prim_index.php');