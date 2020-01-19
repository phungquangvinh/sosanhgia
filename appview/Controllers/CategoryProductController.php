<?php

namespace AppView\Controllers;

class CategoryProductController extends FrontEndController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getCategory($slug,$cat_id)
    {
        $page     = getValue('page', 'int', 'GET', 1, 3);
        $pageSize = 16;
        $region = getValue('total_region', 'arr', 'get', '');
        $shop = getValue('total_shop', 'arr', 'get', '');
        $price = getValue('gia_sp', 'str', 'get', '');

        $dataCategory = model('categories/get_categories_by_id')->load([
            'cat_id' => $cat_id,
            'page' => $page,
            'pageSize' => $pageSize,
            'region' => $region,
        ]);

        $dataPrice = model('categories/get_categories_by_price')->load([
            'cat_id' => $cat_id,
            'page' => $page,
            'pageSize' => $pageSize,
            'price' => $price,
        ]);

        $dataShop = model('categories/get_categories_by_shop')->load([
            'cat_id' => $cat_id,
            'page' => $page,
            'pageSize' => $pageSize,
            'shop' => $shop,
        ]);

        $listCategory = $dataCategory['vars']['list'];
        $totalProducts = $dataCategory['vars']['totalPage'];
        $dataProductCity = $dataCategory['vars']['dataProductCity'];

        $dataProductPrice = $dataPrice['vars']['dataProductPrice'];
        $dataProductShop = $dataShop['vars']['dataProductShop'];
        $cateData = $dataCategory['vars']['cateData'];

        $dataShow['view'] = view('CategoryProduct')->render([
            'listProducts' => $listCategory,
            'totalProducts' => $totalProducts,
            'page' => $page,
            'cat_id' => $cat_id,
            'pageSize' => $pageSize,
            'dataProductCity' => $dataProductCity,
            'dataProductPrice' => $dataProductPrice,
            'dataProductShop' => $dataProductShop,
            'region' => $region,
            'shop' => $shop,
            'price' => $price,
            'cateData' => $cateData,
        ]);

        // view()->share('slug', $slug);
        return view('layout/master')->render(["dataShow" => $dataShow]);
    }
}


