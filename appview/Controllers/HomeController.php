<?php

namespace AppView\Controllers;

class HomeController extends FrontEndController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getCategory($slug,$cat_id)
    {
        
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
        $dataProducts = $productDetail['vars'];
        $proHistory = model('products/get_product_by_cookie')->load([
            'pageSize'  => $pageSize,
            'page'      => $page,
        ]);
        $proHistory = $proHistory['vars'];
//        dd($proHistory);

        $dataShow['view'] = view('DetailProduct')->render([
            'productDetail' => $dataProducts,
            'productHistory' => $proHistory,
        ]);

        return view('layout/master')->render(["dataShow" => $dataShow]);
    }


    public function index()
    {
        $dataCateAllChild = $this->dataCateAllChild;
        // dd($dataCateAllChild);

        $data = model('home/index')->load([
            'dataCateAllChild' => $dataCateAllChild
        ]);


        $dataBannerTopLeft = model('banner/index')->load(["page" => "home_page", "position" => "top_left"]);
        $dataBannerBottomLeft = model('banner/index')->load(["page" => "home_page", "position" => "bottom_left"]);
        $dataBannerTopCenter = model('banner/index')->load(["page" => "home_page", "position" => "top_center"]);
        $dataBannerMiddleCenter = model('banner/index')->load(["page" => "home_page", "position" => "middle_center"]);


        $dataBannerTopRight = model('banner/index')->load(["page" => "home_page", "position" => "top_right"]);
        $dataBannerBottomRight = model('banner/index')->load(["page" => "home_page", "position" => "bottom_right"]);

        $datalistProducts= $data['vars']['data'];
        $dataProductCate = $data['vars']['dataProductCate'];
        $dataCate = $data['vars']['dataCate'];

        $dataItemBannerTopLeft = $dataBannerTopLeft['vars']['listBanner'];
        $dataItemBannerBottomLeft = $dataBannerBottomLeft['vars']['listBanner'];
        $dataItemBannerTopCenter = $dataBannerTopCenter['vars']['listBanner'];
        $dataBannerMiddleCenter = $dataBannerMiddleCenter['vars']['listBanner'];
        $dataItemBannerTopRight = $dataBannerTopRight['vars']['listBanner'];
        $dataItemBannerBottomRight = $dataBannerBottomRight['vars']['listBanner'];

        //show list Menu
        $listMenu = model('menu/index')->load()['vars'];


        //show list news
        $news = model('news/index')->load();

        //get news
        $getNews = $news['vars']['getNews'];
        $hotNews = $news['vars']['hotNews'];
        $pc = $news['vars']['pc'];
        $tin_tuc_theo_type = $news['vars']['tin_tuc_theo_type'];


        $dataShow['view'] = view('Home')->render([
            'listProducts' => $datalistProducts,
            'dataProductCate' => $dataProductCate,
            'dataCate' => $dataCate,
            'BannerTopLeft' => $dataItemBannerTopLeft,
            'BannerBottomLeft' => $dataItemBannerBottomLeft,
            'BannerTopCenter' => $dataItemBannerTopCenter,
            'BannerMiddleCenter' => $dataBannerMiddleCenter,
            'listMenu' => $listMenu,
            'BannerTopRight' => $dataItemBannerTopRight,
            'BannerBottomRight' => $dataItemBannerBottomRight,

            'getNews' => $getNews,
            'hotNews' => $hotNews,
            'pc' => $pc,
            'tin_tuc_theo_type' => $tin_tuc_theo_type,
        ]);


        return view('layout/master')->render(["dataShow" => $dataShow]);
    }

}