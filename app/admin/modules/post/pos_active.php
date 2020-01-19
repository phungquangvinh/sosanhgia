<?php
use App\Models\Post;

require_once 'inc_security.php';

$pos_id = getValue('id', 'int', 'GET', 0);

$selectPost = Post::where("pos_id = '" .$pos_id. "'")->first();
if($selectPost) {
    $selectPost->pos_active = $selectPost->pos_active == 0 ? 1 : 0;
    $selectPost->update();
}