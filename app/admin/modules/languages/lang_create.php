<?php

require_once 'inc_security.php';

use BlackBear\Validation\Validator;
use App\Models\Languages;

$lang_name = getValue('lang_name', 'str', 'POST', '');
$lang_path = getValue('lang_path', 'str', 'POST', '');
// $lang_image = getValue('lang_image', 'str', 'POST', '');
$lang_image = isset($_FILES['lang_image']) ? $_FILES['lang_image'] : [];
$lang_domain = getValue('lang_domain', 'str', 'POST', '');

$action = getValue('action', 'str', 'POST', '', '');


if ('add' == $action) {
	$validator = new Validator;
    $validator->addExtension('Exit', function ($attribue, $value) {
    $checkExitNews = Languages::where("lang_name = '" . $value . "' ")->first();
	    if ($checkExitNews == null) {
	        return true;
	    } else {
	        return false;
	    }
    });

    $rules = [
    	'lang_name' => 'required|min:5|max:100',
		'lang_path' => 'required|min:1|max:5',
		'lang_image' => 'required',
		'lang_domain' => 'required|min:1|max:10',
    ];
    $messages = [
    	'lang_name.required' => 'Vui lòng nhập nội dung',
		'lang_name.min' => 'Nội dung nhập phải lớn hơn 5 kí tự',
		'lang_name.max' => 'Nội dung nhập phải ít hơn 100 kí tự',
		'lang_path.required' => 'Vui lòng nhập nội dung',
		'lang_path.min' => 'Nội dung nhập phải lớn hơn 1 kí tự',
		'lang_path.max' => 'Nội dung nhập phải ít hơn 5 kí tự',
		'lang_image.required' => 'Vui lòng chọn ảnh',
		'lang_domain.required' => 'Vui lòng nhập nội dung',
		'lang_domain.min' => 'Nội dung nhập phải lớn hơn 1 kí tự',
		'lang_domain.max' => 'Nội dung nhập phải ít hơn 10 kí tự',
    ];

     $validator ->setData($_POST)->setRules($rules)->setMessages($messages);
    if( ! $validator->passes() ) {
        $errors = $validator->getErrors();
        flash_message('error', 'Xác thực lỗi ! vui lòng check lại các trường trong form');
        flash_message('errors', $errors);
        flash_message('old_inputs', $_POST);
        redirect($_SERVER['REQUEST_URI']);
    }

    if ($_FILES['lang_image']['error'] == 0) {
        $picture = app('image_uploader')->upload('languages',$lang_image);
    }

    $lang_back_id = Languages::insert([
    	'lang_name' => $lang_name,
		'lang_path' => $lang_path,
        // 'lang_image' => $lang_image,
		'lang_image' => isset($picture) ? $picture : '',
		'lang_domain' => $lang_domain,
    ]);

    flash_message('success', 'Tạo tin tức thành công');
    redirect('lang_index.php');
}
echo $template->render('create', compact('load_header'));
