<?php
/**
 * Created by justin
 * User: justin
 * Date: 16/5/17
 * Time: 17:15 PM
 */

namespace App\Models;

use Exception;
use VatGia\Helpers\Collection;
use VatGia\Model\Model;

class Product extends Model
{
    public $table = 'products';

    public $prefix = 'pro';

    public $id_field = 'id';

    const TYPE_CRAWL = 1;

    public function getName()
    {
        return $this->pro_name;
    }

    public function getId()
    {
        return $this->pro_id;
    }

    public function getSlug()
    {
        return removeTitlte($this->getName());
    }

    public function getPrice($format = false)
    {
        return $format ? formatCurrency($this->pro_price) : $this->pro_price;
    }

    /**
     * Link chi tiết
     * @return string
     */
    public function getLink()
    {
        return '/'. app('route')->route('product.detail', [removeTitle($this->name), $this->id]);
    }

    public function getImgProduct($size = 'default', $folder = 'products')
    {
        $img = $this->pro_image;

        if (!$img) {
            return '/assets/images/no-image.png';
        }
        return parse_image($folder, $size, $img);

    }
}