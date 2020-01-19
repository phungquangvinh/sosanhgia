<?php


namespace App\Models;

use VatGia\Model\Model;
class Menu extends Model
{
    public $table = 'menu';
    public $prefix = 'menu';

    public function getImgMenu($size = 'default', $folder = 'menu')
    {
        $img = $this->menu_icon;

        if (!$img) {
            return '/assets/images/no-image.png';
        }
        return parse_image($folder, $size, $img);

    }
}