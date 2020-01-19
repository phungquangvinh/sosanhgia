<?php
use App\Models\Brand;

require_once 'inc_security.php';

$id =  getValue('id', 'int', 'GET', 0);

$row = Brand::where('bra_id = '.$id)->select();

Brand::where('bra_id = '.$id)->delete();

flash_message('Success', 'Xóa thành công');
redirect('brands_index.php');