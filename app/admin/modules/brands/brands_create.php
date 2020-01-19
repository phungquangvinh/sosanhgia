<?php
require_once 'inc_security.php';

use BlackBear\Validation\Validator;
use App\Models\Brand;

$bra_name = getValue('bra_name', 'str', 'POST', '');
$bra_name = trim($bra_name);
$bra_name_hash = removeAccent($bra_name);
$bra_name_hash = mb_strtolower($bra_name_hash);
$bra_name_hash = md5($bra_name_hash);
$bra_image = isset($_FILES['bra_image']) ? $_FILES['bra_image'] : [];
$bra_content = getValue('bra_content', 'str', 'POST', '');

$action = getValue('action', 'str', 'POST', '');

if ('add' == $action) {
    $validator = new Validator();
    $rules = [
        'bra_name' => 'required|min:2|max:20',
        'bra_image' => 'required',
        'bra_content' => 'required',
    ];
    $messages = [
        'bra_name.required' => 'Vui lòng nhập tên',
        'bra_name.min' => 'Tên phải lớn hơn 2 kí tự',
        'bra_name.max' => 'Tên phải nhỏ hơn 20 kí tự',
        'bra_image.required' => 'Vui lòng chọn ảnh',
        'bra_content.required' => 'Vui lòng điền nội dung',
    ];
    $validator ->setData($_POST)->setRules($rules)->setMessages($messages);

    if( ! $validator->passes() ) {
        $errors = $validator->getErrors();
        flash_message('error', 'Xác thực lỗi ! vui lòng check lại các trường trong form');
        flash_message('errors', $errors);
        flash_message('old_inputs', $_POST);
        redirect($_SERVER['REQUEST_URI']);
    }

    if ($_FILES['bra_image']['error'] == 0) {
        $braImage = upload_img('brands',$bra_image);
    }

    $insertBrand = Brand::insert([
        'bra_name' => $bra_name,
        'bra_name_hash' => $bra_name_hash,
        'bra_image' => isset($braImage) ? $braImage : '',
        'bra_content' => $bra_content,
    ]);
    flash_message('Success', 'Tạo thành công');
    //redirect('brands_index.php');
}
echo $template->render('create', compact('load_header'));