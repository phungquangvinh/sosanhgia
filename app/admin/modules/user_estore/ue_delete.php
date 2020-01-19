<?php
use App\Models\UserEstore;

require_once 'inc_security.php';

$id =  getValue('id', 'int', 'GET', 0);

$row = UserEstore::where('ue_id = '.$id)->select();


UserEstore::where('ue_id = '.$id)->delete();

flash_message('Success', 'Xóa thành công');
redirect('ue_index.php');