<?

use App\Models\CategoryProduct;
use App\Models\Product;

$cat_id = (int) $input['cat_id'];
$page = (int) $input['page'];
$pageSize = (int) $input['pageSize'];
$price = explode('-', $input['price']);

$model = Product::where('pro_category_id = '. $cat_id);
$data = $model->pagination($page, $pageSize)->select_all();
$dataProductPrice = '';

if ($input['price']) {
	$dataProductPrice = $model
	->where('pro_price BETWEEN '.$price[0].' AND '.$price[1])
	->pagination($page, $pageSize)->select_all();
}

return [
    'vars' => [
        'list' => $data,
        'dataProductPrice' => $dataProductPrice,
    ]
];