<?php
require_once 'inc_security.php';

use BlackBear\Validation\Validator;
use App\Models\UserEstore;

$ue_name = getValue('ue_name', 'str', 'POST', '');
$ue_link = getValue('ue_link', 'str', 'POST', '');
$ue_image = isset($_FILES['ue_image']) ? $_FILES['ue_image'] : [];

$action = getValue('action', 'str', 'POST', '');
$getId = getValue('id', 'str', 'GET', '');
$postId = getValue('id', 'str', 'POST', '');

if ($postId) {
    $id = $postId;
} else {
    $id = $getId;
}

$updateUserEstore = UserEstore::where('ue_id = '.$id)->first();

if ($action == 'edit' && $updateUserEstore) {
    $rules = [
        'ue_name' => 'required|min:2|max:20',
        'ue_link' => 'required|min:5|max:100',
        'ue_image' => 'required',
    ];
    $messages = [
        'ue_name.required' => 'Vui lòng nhập tên',
        'ue_name.min' => 'Tên phải lớn hơn 2 kí tự',
        'ue_name.max' => 'Tiêu đề bài viết nhỏ hơn 20 kí tự',
        'ue_link.required' => 'Vui lòng nhập tên',
        'ue_link.min' => 'Tiêu đề bài viết lớn hơn 5 kí tự',
        'ue_link.max' => 'Tiêu đề bài viết nhỏ hơn 100 kí tự',
        'ue_image.required' => 'Vui lòng chọn ảnh',
    ];

    $validator = new Validator($_POST, $rules, $messages);
    if (!$validator->passes()) {
        $errors = $validator->getErrors();
        flash_message('error', 'Vui lòng check lại các trường trong form');
        flash_message('errors', $errors);
        flash_message('old_inputs', $_POST);
        redirect($_SERVER['REQUEST_URI']);
    }

    if ($_FILES['ue_image']['error'] == 0) {
        $ueImage = upload_img('user_estores',$ue_image);
    }

    $ue_back_id = $updateUserEstore->update([
        'ue_name' => $ue_name,
        'ue_link' => $ue_link,
        'ue_image' => isset($ueImage) ? $ueImage : $updateUserEstore->ue_image,
    ]);

    flash_message('success', 'Cập nhật tin tức thành công');
    redirect('ue_index.php');
}
echo $template->render('edit', compact('load_header', 'updateUserEstore'));