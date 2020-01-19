<?php

namespace App\Models;

use VatGia\Model\Model;

class Banner extends Model {
    public $table = 'banners';
    public $prefix = 'ban';

    public function getImgBanner($size = 'default', $folder = 'banner')
    {
        $img = $this->ban_picture;

        if (!$img) {
            return '/assets/images/no-image.png';
        }
        return parse_image($folder, $size, $img);

    }
}