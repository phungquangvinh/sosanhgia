<?php
require_once 'inc_security.php';

use BlackBear\Validation\Validator;
use App\Models\ProductImages;
use App\Models\Product;

$prim_product_id = getValue('prim_product_id', 'str', 'POST', '');
$prim_name = isset($_FILES['prim_name']) ? $_FILES['prim_name'] : [];

$action = getValue('action', 'str', 'POST', '');
$getId = getValue('id', 'str', 'GET', '');
$postId = getValue('id', 'str', 'POST', '');

if ($postId) {
    $id = $postId;
} else {
    $id = $getId;
}

$prim_product = Product::select_all();

$updateProductImage = ProductImages::where('prim_id = '.$id)->first();

if ($action == 'edit' && $updateProductImage) {
    $rules = [
        'prim_product_id' => 'required',
        'prim_name' => 'required',
    ];
    $messages = [
        'prim_product_id.required' => 'Vui lòng chọn sản phẩm',
        'prim_name.required' => 'Vui lòng chọn ảnh',
    ];

    $validator = new Validator($_POST, $rules, $messages);
    if (!$validator->passes()) {
        $errors = $validator->getErrors();
        flash_message('error', 'Vui lòng check lại các trường trong form');
        flash_message('errors', $errors);
        flash_message('old_inputs', $_POST);
        redirect($_SERVER['REQUEST_URI']);
    }

//    if ($_FILES['prim_name']['error'] == 0) {
//        $primImage = upload_img('product_images',$prim_name);
//    }
//
//    $prim_back_id = $updateProductImage->update([
//        'prim_product_id' => $prim_product_id,
//        'prim_name' => isset($primImage) ? $primImage : $updateProductImage->prim_name,
//    ]);

    $prim_name = '';
    if (isset($_FILES['prim_name']) && count($_FILES['prim_name']) > 0) {
        create_folder_full_permissions($_SERVER['DOCUMENT_ROOT'] . "/uploads/product_images/default/");

        if ($_FILES['prim_name']['error'][0] == 0) {

            for ($i = 0; $i < count($_FILES['prim_name']['name']); $i++) {
                $url['name'] = $_FILES['prim_name']['name'][$i];
                $url['tmp_name'] = $_FILES['prim_name']['tmp_name'][$i];
                $url['size'] = $_FILES['prim_name']['size'][$i];
                $name = generate_name($url['name']);
                $nameImage[$i] = get_name_image_array($url, '/uploads/product_images/default/');
                $listImg = parse_image_no_size('uploads/product_images/default', $name);
            }
            $prim_name = json_encode($nameImage);
        }
    }

    $prim_back_id = $updateProductImage->update([
        'prim_product_id' => $prim_product_id,
        'prim_name' => $prim_name,
    ]);

    flash_message('Success', 'Sửa ảnh thành công');
    redirect('prim_index.php');
}
echo $template->render('edit', compact('load_header', 'updateProductImage', 'prim_product'));