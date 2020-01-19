<?php
require_once 'inc_security.php';

use BlackBear\Validation\Validator;
use App\Models\ProductEstore;
use App\Models\Product;
use App\Models\UserEstore;

$pres_product_id = getValue('pres_product_id', 'str', 'POST', '');
$pres_estore_id = getValue('pres_estore_id', 'str', 'POST', '');
$pres_price = getValue('pres_price', 'str', 'POST', '');
$pres_link = getValue('pres_link', 'str', 'POST', '');
$pres_cites = getValue('pres_cites', 'str', 'POST', '');
$pres_district = getValue('pres_district', 'str', 'POST', '');
$pres_rate = getValue('pres_rate', 'int', 'POST', 1);

$action = getValue('action', 'str', 'POST', '', '');
$getId = getValue('id', 'str', 'GET', '');
$postId = getValue('id', 'str', 'POST', '');

if ($postId) {
    $id = $postId;
} else {
    $id = $getId;
}
$pres_product = Product::select_all();
$pres_estore = UserEstore::select_all();

$updateProductEstore = ProductEstore::where('pres_id ='.$id)->first();

if ($action == 'edit' && $updateProductEstore) {
    $rules = [
        'pres_product_id' => 'required',
        'pres_estore_id' => 'required',
        'pres_price' => 'required|min:6|max:20',
        'pres_link' => 'required|min:5|max:500',
        'pres_cites' => 'required',
        'pres_district' => 'required',
        'pres_rate' => 'required',
    ];
    $messages = [
        'pres_product_id.required' => 'Vui lòng chọn sản phẩm',
        'pres_estore_id.required' => 'Vui lòng chọn cửa hàng',
        'pres_price.required' => 'Vui lòng điền giá sản phẩm',
        'pres_price.min' => 'Giá sản phẩm phải lớn hơn 6 kí tự',
        'pres_price.max' => 'Giá sản phẩm phải ít hơn 20 ký tự',
        'pres_link.required' => 'Vui lòng điền liên kết',
        'pres_link.min' => 'Liên kết phải lớn hơn 5 kí tự',
        'pres_link.max' => 'Liên kết phải ít hơn 500 ký tự',
        'pres_cites.required' => 'Khu vực không được để trống',
        'pres_district.required' => 'Khu vực không được để trống',
        'pres_rate.required' => 'Vui lòng điền đánh giá',
    ];

    $validator = new Validator($_POST, $rules, $messages);
    if (!$validator->passes()) {
        $errors = $validator->getErrors();
        flash_message('error', 'Vui lòng check lại các trường trong form');
        flash_message('errors', $errors);
        flash_message('old_inputs', $_POST);
        redirect($_SERVER['REQUEST_URI']);
    }

    $pres_back_id = $updateProductEstore->update([
        'pres_product_id' => $pres_product_id,
        'pres_estore_id' => $pres_estore_id,
        'pres_price' => $pres_price,
        'pres_link' => $pres_link,
        'pres_cites' => $pres_cites,
        'pres_district' => $pres_district,
        'pres_rate' => $pres_rate,
    ]);

    flash_message('success', 'Cập nhật thành công');
    redirect('pres_index.php');
}
echo $template->render('edit', compact('load_header', 'updateProductEstore','pres_product','pres_estore'));