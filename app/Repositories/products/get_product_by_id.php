<?
use App\Models\Product;
use App\Models\ProductEstore;
use App\Models\PicturesProduct;

$pro_id            = (int) $input['pro_id'];
$dataEstoreProduct = array();
$dataImagesProduct = array();
$dataRelaProduct   = array();
$dataReturn        = array();

// lấy thông tin sản phẩm base
$dataDetail = Product::where('pro_id = ' . $pro_id)->first();
if(count($dataDetail) > 0){
	// lấy gian hàng có sản phẩm
	$dataEstoreProduct = ProductEstore::where('pres_product_id =' . $pro_id )->select_all();
	// lấy ảnh chi tiết sản phẩm
	$dataImagesProduct = PicturesProduct::where('pipr_product =' . $pro_id )->limit(5)->select_all();
	// lấy sản phẩm liên quan
	$dataRelaProduct = Product::where('pro_category_id =' . $dataDetail->pro_category_id)->limit(4)->order_by("pro_id","DESC")->select_all();
}

$dataReturn['dataDetail']        = $dataDetail;
$dataReturn['dataEstoreProduct'] = $dataEstoreProduct;
$dataReturn['dataImagesProduct'] = $dataImagesProduct;
$dataReturn['dataRelaProduct']   = $dataRelaProduct;

return [
    'vars' => $dataReturn
];

?>