<?php

use App\Models\Configuration;

include 'inc_security.php';

$id = getValue('id', 'int', 'GET', 0);

Configuration::where('con_id = '.$id)->delete();
flash_message('success', 'Xóa thành công');
redirect('con_index.php');