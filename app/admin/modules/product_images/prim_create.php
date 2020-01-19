<?php
require_once 'inc_security.php';

use BlackBear\Validation\Validator;
use App\Models\ProductImages;
use App\Models\Product;

$prim_product_id = getValue('prim_product_id', 'str', 'POST', '');
$prim_name = isset($_FILES['prim_name']) ? $_FILES['prim_name'] : [];

$action = getValue('action', 'str', 'POST', '', '');

$prim_product = Product::select_all();

if ('add' == $action) {
    $validator = new Validator();
    $rules = [
        'prim_product_id' => 'required',
        'prim_name' => 'required',
    ];
    $messages = [
        'prim_product_id.required' => 'Vui lòng chọn sản phẩm',
        'prim_name.required' => 'Vui lòng chọn ảnh',
    ];

    $validator->setData($_POST)->setRules($rules)->setMessages($messages);
    if (!$validator->passes()) {
        $errors = $validator->getErrors();
        flash_message('error', 'Xác thực lỗi ! vui lòng check lại các trường trong form');
        flash_message('errors', $errors);
        flash_message('old_inputs', $_POST);
        redirect($_SERVER['REQUEST_URI']);
    }


//    if (isset($prim_name)) {
//        create_folder_full_permissions('uploads/product_images/default/'); // tạo folder lưu ảnh theo ngày tháng năm
//
//        $productImagesInsert = ProductImages::insert([
//            'prim_product_id' => $prim_product_id,
//            'prim_name' => implode(",", $prim_name),
//        ]);
//
//        foreach ($prim_name as $primImage) {
//            // luu anh banner
//            $img_name = get_image($primImage, '/uploads/product_images/default/');
//            // luu anh tu url ve folder
//            $img[] = $img_name;
//            // sau day resize anh
//            parse_image_no_size('uploads/product_images/default', $img_name);
//        }
//        // đảo ngược mảng lấy ra ảnh đẹp
//        $imgRev = array_combine(array_keys($img), array_reverse(array_values($img)));
//        } else {
//        $imgRev = "";
//    }

//    for ($i=0; $i<count($_FILES['prim_name']['tmp_name']); $i++) {
//
//
//
//            if ($_FILES['prim_name']['error'] == 0) {
//
//                $primImage = upload_img('product_images', $prim_name);
//
//
//            }
//
//            $productImagesInsert = ProductImages::insert([
//                'prim_product_id' => $prim_product_id,
//                'prim_name' => isset($primImage) ? $primImage : '',
//            ]);
//
//    }

//    dd($prim_name);
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

    $productImagesInsert = ProductImages::insert([
        'prim_product_id' => $prim_product_id,
        'prim_name' => $prim_name,
    ]);

    flash_message('Success', 'Tạo ảnh thành công');
//    redirect('prim_index.php');
}
echo $template->render('create', compact('load_header', 'prim_product'));