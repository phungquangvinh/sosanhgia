<?php
/**
 * Created by PhpStorm.
 * User: Stephen Nguyen
 * Date: 5/3/2017
 * Time: 5:18 PM
 */

namespace AppView\Controllers;


use VatGia\ControllerBase;

class FrontEndController extends ControllerBase
{
    public $dataCateAllChild;

    public function __construct()
    {
        $listCate = model('categories/index')->load()['vars'];
        view()->share('dataCatelv2', $listCate['dataCatelv2']);
        view()->share('dataCatelv3', $listCate['dataCatelv3']);
        view()->share('listCategoryProduct', $listCate['listCategoryProduct']);

        // dd($listCate);

        $this->dataCateAllChild = $listCate['list_cat_id'];

        // show list city
        $listCities = model('city/index')->load()['vars'];
        view()->share('listCities', $listCities);

        // show list gian hàng
        $listUserEstore = model('userEstore/index')->load()['vars'];
        view()->share('listUserEstore', $listUserEstore);

        //configuration
        $dataConfiguration = model('configuration/index') ->load()['vars'];
        view()->share('dataConfiguration', $dataConfiguration);
    }
}