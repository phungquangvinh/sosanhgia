<?php

namespace AppView\Controllers;


class DetailProductController extends FrontEndController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getDetail($slug, $pro_id)
    {
//        dd($pro_id);

        $page = getValue('page', 'int', 'GET', 1, 3);
        $pageSize = 6;

        model('products/add_to_cookie')->load([
            'pro_id' => (int)$pro_id,
        ]);

        $productDetail = model('products/get_product_by_id')->load([
            'pro_id' => $pro_id,
        ]);

        $dataDetail        = $productDetail['vars']['dataDetail'];
        $dataEstoreProduct = $productDetail['vars']['dataEstoreProduct'];
        $dataImagesProduct = $productDetail['vars']['dataImagesProduct'];
        $dataRelaProduct   = $productDetail['vars']['dataRelaProduct'];
   
        // sản phẩm đã xem
        $proHistory = model('products/get_product_by_cookie')->load();
        
        $proHistory = $proHistory['vars'];

        $dataShow['view'] = view('DetailProduct')->render([
            'productDetail'     => $dataDetail,
            'dataEstoreProduct' => $dataEstoreProduct,
            'dataImagesProduct' => $dataImagesProduct,
            'dataRelaProduct'   => $dataRelaProduct,
            'productHistory'    => $proHistory,
        ]);

        return view('layout/master')->render(["dataShow" => $dataShow]);
    }

}


