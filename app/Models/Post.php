<?php

namespace App\Models;

use VatGia\Model\Model;

class Post extends Model {
    public $table = 'posts';
    public $prefix = 'pos';

    public function getImgPost($size = 'default', $folder = 'posts')
    {
        $img = $this->pos_image;
        if (!$img) {
            return '/assets/images/no-image.png';
        }
        return parse_image($folder, $size, $img);
    }
}