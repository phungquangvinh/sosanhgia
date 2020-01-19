<?php

namespace App\Models;

use VatGia\Model\Model;

class Configuration extends Model {
    public $table = 'configuration';
    public $prefix = 'con';


    public function getImgConfig($size = 'default', $folder = 'configuration')
    {
        $img = $this->logo_top;

        if (!$img) {
            return '/assets/images/no-image.png';
        }
        return parse_image($folder, $size, $img);

    }
    public function getImgBot($size = 'default', $folder = 'configuration')
    {
        $img = $this->logo_bottom;

        if (!$img) {
            return '/assets/images/no-image.png';
        }
        return parse_image($folder, $size, $img);

    }
}