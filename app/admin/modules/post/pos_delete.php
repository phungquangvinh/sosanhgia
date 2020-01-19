<?php
use App\Models\Post;

require_once 'inc_security.php';

$id = getValue('id', 'int', 'GET', 0);

$post = Post::where('pos_id = '.$id)->first();

if ($post != null) {
    $post->delete();
    flash_message('Success', 'Xóa bản tin thành công!');
    redirect('pos_index.php');
} else {
    flash_message('Error', 'Không tìm thấy id này!');
    redirect('pos_index.php');
}