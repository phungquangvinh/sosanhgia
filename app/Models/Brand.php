<?php

namespace App\Models;

use VatGia\Model\Model;

class Brand extends Model {

    public $table = 'brands';

    public $prefix = 'bra';

    public $id_filed = 'id';

    public $use_collection = true;

    public function getImgBrand($size = 'default', $folder = 'brands')
    {
        $img = $this->bra_image;

        if (!$img) {
            return '/assets/images/no-image.png';
        }
        return parse_image($folder, $size, $img);

    }
}