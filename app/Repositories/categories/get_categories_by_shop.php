<?

use App\Models\CategoryProduct;
use App\Models\Product;

$cat_id = (int) $input['cat_id'];
$page = (int) $input['page'];
$pageSize = (int) $input['pageSize'];
$shop = $input['shop'];

$dataProductShop = '';

$model = Product::where('pro_category_id = '. $cat_id);
$totalPage = $model->count();
$data = $model->pagination($page, $pageSize)->select_all();

if ($shop) {
	$dataProductShop = $model
	->where('pro_shop_id IN('. $shop .')')
	->pagination($page, $pageSize)->select_all();
}

return [
    'vars' => [
        'list' => $data,
        'totalPage' => $totalPage,
        'dataProductShop'=> $dataProductShop,
    ]
];