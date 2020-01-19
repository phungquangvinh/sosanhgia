<?php
use App\Models\ProductEstore;

require_once 'inc_security.php';

$id =  getValue('id', 'int', 'GET', 0);

$row = ProductEstore::where('pres_id = '.$id)->select();

ProductEstore::where('pres_id = '.$id)->delete();

flash_message('Success', 'Xóa thành công');
redirect('pres_index.php');