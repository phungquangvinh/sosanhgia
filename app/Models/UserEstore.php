<?php


namespace App\Models;

use VatGia\Model\Model;
class UserEstore extends Model
{
    public $table = 'user_estores';

    public $prefix = 'ue';


    public function getImgUserEstore($size = 'default', $folder = 'user_estores')
    {
        $img = $this->ue_image;

        if (!$img) {
            return '/assets/images/no-image.png';
        }
        return parse_image($folder, $size, $img);

    }
}