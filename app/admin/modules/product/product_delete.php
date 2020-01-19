<?php
/**
 * Created by PhpStorm.
 * User: irapcover
 * Date: 24/05/2017
 * Time: 11:26
 */
use App\Models\Product;

include 'inc_security.php';

$id = getValue('id', 'int', 'GET', 0);

$row = Product::where('pro_id = '.$id)->select();


@unlink(ROOT.'/public'.parse_file_url($row->pro_image));
$arrayConfigImage = config('image.thumbs');
foreach ($arrayConfigImage as $type => $value){
    @unlink(ROOT.'/public'.parse_file_url($type.$row->pro_image));
}

Product::where('pro_id = '.$id)->delete();
//
flash_message('success', 'Xóa thành công');
redirect('product_index.php');