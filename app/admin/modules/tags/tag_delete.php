<?php
use App\Models\Tags;

include 'inc_security.php';

$id = getValue('id', 'int', 'GET', 0);

$row = Tags::where('tag_id = '.$id)->select();


Tags::where('tag_id = '.$id)->delete();
//
flash_message('success', 'Xóa thành công');
redirect('tag_index.php');