<?php


namespace App\Models;

use VatGia\Model\Model;
class ProductEstore extends Model
{
    public $table = 'product_estores';

    public $prefix = 'pres';

    public function getImgEstore($size = 'default', $folder = 'user_estores')
    {
        $img = $this->ue_image;

        if (!$img) {
            return '/assets/images/no-image.png';
        }
        return parse_image($folder, $size, $img);

    }
}