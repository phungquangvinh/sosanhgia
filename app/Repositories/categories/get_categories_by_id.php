<?

use App\Models\CategoryProduct;
use App\Models\Product;

$cat_id   = (int) $input['cat_id'];
$page     = (int) $input['page'];
$pageSize = (int) $input['pageSize'];
$region = $input['region'];

// lấy thông tin danh mục
$cateData = CategoryProduct::where("cat_id = " . $cat_id)->first();
$listCatAllChild = $cateData->cat_all_child;
$totalPage = $cateData->cat_total_product;

// lấy danh sách sản phẩm
$model = Product::where('pro_category_id IN ('. $listCatAllChild. ') ');
$data = $model->order_by("pro_id","DESC")->pagination($page, $pageSize)->select_all();

$dataProductCity = '';

if ($region) {
	$dataProductCity = $model
	->where('pro_city_id IN('. $region .')')
	->pagination($page, $pageSize)->select_all();
}

return [
    'vars' => [
        'list' => $data,
        'totalPage' => $totalPage,
        'dataProductCity'=> $dataProductCity,
        'cateData'     => $cateData,
    ]
];