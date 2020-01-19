<?php

namespace AppView\Controllers;
use App\Models\Product;

class AjaxSearchController extends HomeController
{
	public function __construct()
    {
        parent::__construct();
    }

	public function getSearch()
	{
		$place = getValue('place', 'arr', 'POST', '');
		// $shop = getValue('search-shop', 'str', '', '');
		// $price = getValue('search-price', 'int', '', '');
		// dd($place);


		$cat_id = getValue('cat_id', 'int', 'POST', '');
		// $page = (int) $input['page'];
		// $pageSize = (int) $input['pageSize'];
		// dd($cat_id);

		$model = Product::where('pro_category_id = '. $cat_id);
		if ($place) {
			$search_place = $model->where('pro_city_id IN('. implode(',', $place) .')')->select_all();
		} else {
			$search_place = $model->select_all();
		}

		$totalPage = $model->count();
		// dd($totalPage);
		foreach ($search_place as $key => $value) {
			$data['pro_id'] = $value->pro_id;
			$data['pro_brand_id'] = $value->pro_brand_id;
			$data['pro_source_id'] = $value->pro_source_id;
			$data['pro_name'] = $value->pro_name;
			$data['pro_hash_name'] = $value->pro_hash_name;
			$data['pro_keywords'] = $value->pro_keywords;
			$data['pro_image'] = $value->pro_image;
			$data['pro_image_width'] = $value->pro_image_width;
			$data['pro_image_height'] = $value->pro_image_height;
			$data['pro_price'] = $value->pro_price;
			$data['pro_min_price'] = $value->pro_min_price;
			$data['pro_total_shop'] = $value->pro_total_shop;
			$data['pro_city_id'] = $value->pro_city_id;
		}

	    

		return json_encode($data);
	}
}