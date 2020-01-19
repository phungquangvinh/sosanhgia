<?php

require_once 'inc_security.php';

use App\Models\News;

$id = getValue('id', 'str', 'GET', 1, 3);

$news = News::where('nes_id='.$id)->first();

if ($news !=null) {
    $news->delete();
    flash_message('success', 'Xóa bản ghi thành công');
    redirect('nes_index.php');
} else {
    flash_message('error', 'Không tìm thấy id này');
    redirect('nes_index.php');
}
