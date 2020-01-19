<?php
require 'inc_security.php';
use App\Models\Banner;

$id=getValue('id','str','GET',"");
Banner::Where('ban_id='.$id)->delete();

flash_message('success', 'Xóa thành công');
redirect('listing.php');