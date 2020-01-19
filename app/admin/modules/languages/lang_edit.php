<?php

require_once 'inc_security.php';

use BlackBear\Validation\Validator;
use App\Models\Languages;


$lang_name = getValue('lang_name', 'str','POST', '');
$lang_path = getValue('lang_path', 'str','POST', '');
$lang_image = isset($_FILES['lang_image']) ? $_FILES['lang_image'] : [];
$lang_domain = getValue('lang_domain', 'str','POST', '');

$action = getValue('action', 'str', 'POST', '', '');
$getId = getValue('id', 'str', 'GET', '');
$postId = getValue('id', 'str', 'POST', '');

if ($postId) {
    $id = $postId;
} else {
    $id = $getId;
}

$dataUpdate = Languages::where('lang_id =' . $id)->first();
if ($action == 'edit' && $dataUpdate) {
	$rules = [
		'lang_name' => 'required|min:1|max:10',
		'lang_path' => 'required|min:1|max:5',
		'lang_image' => 'required',
		'lang_domain' => 'required|min:5|max:100',
	];
	$messages = [
		'lang_name.required' => 'Vui lòng nhập nội dung',
		'lang_name.min' => 'Nội dung nhập phải lớn hơn 1 kí tự',
		'lang_name.max' => 'Nội dung nhập phải ít hơn 10 kí tự',
		'lang_path.required' => 'Vui lòng nhập nội dung',
		'lang_path.min' => 'Nội dung nhập phải lớn hơn 1 kí tự',
		'lang_path.max' => 'Nội dung nhập phải ít hơn 5 kí tự',
		'lang_image.required' => 'Vui lòng chọn ảnh',
		'lang_domain.required' => 'Vui lòng nhập nội dung',
		'lang_domain.min' => 'Nội dung nhập phải lớn hơn 5 kí tự',
		'lang_domain.max' => 'Nội dung nhập phải ít hơn 100 kí tự',
	];

	$validator = new Validator($_POST, $rules, $messages);
	if (!$validator->passes()) {
        $errors = $validator->getErrors();
        flash_message('error', 'Vui lòng check lại các trường trong form');
        flash_message('errors', $errors);
        flash_message('old_inputs', $_POST);
        redirect($_SERVER['REQUEST_URI']);
    }
    // if ($_FILES['lang_image']['error'] == 0) {
    //     $picture = app('image_uploader')->upload('languages',$lang_image);
    // }
    
    $langImage = $dataUpdate->lang_image;
    if($_FILES['lang_image']['error'] == 0) {
        $resultUpload = app('image_uploader')->upload('lang_image');
        if($resultUpload['status'] > 0) {
            $langImage = $resultUpload['filename'];
        }
    }
// dd($langImage);
    $lang_back_id = $dataUpdate->update ([
    	'lang_name' => $lang_name,
		'lang_path' => $lang_path,
		'lang_image' => $langImage,
		'lang_domain' => $lang_domain,
    ]);

    flash_message('success', 'Cập nhật thành công');
    redirect('lang_index.php');
}
echo $template->render('edit', compact('load_header', 'dataUpdate'));