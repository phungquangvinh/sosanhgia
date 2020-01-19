<?php

namespace AppView\Controllers;

use App\Models\Property;


class SearchController extends FrontEndController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getSearch()
    {
        $name = getValue('name','str','GET','');
        $page = getValue('page', 'int', 'GET', 1, 3);
        $pageSize = 8;
        $searchProduct = model('search/index')->load([
            'name' => $name,
            'pageSize' => $pageSize,
            'page' => $page,
        ]);
        $dataProducts = $searchProduct['vars']['listSearch'];
        $totalProduct = $searchProduct['vars']['totalPage'];

        $dataShow['view'] = view('Search')->render([
            'productSearch' => $dataProducts,
            'totalProduct' => $totalProduct,
            'page' => $page,
            'pageSize' => $pageSize,
        ]);

        return view('layout/master')->render(["dataShow" => $dataShow]);
    }

}