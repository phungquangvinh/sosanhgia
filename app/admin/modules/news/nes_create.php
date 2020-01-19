<?php

require_once 'inc_security.php';

use BlackBear\Validation\Validator;
use App\Models\News;
use App\Models\Categories\Category;


$nes_title                  = getValue('nes_title', 'str', 'POST', '');
$nes_description            = getValue('nes_description', 'str', 'POST', '');
$nes_meta_title             = getValue('nes_meta_title', 'str', 'POST', '');
$nes_meta_keyword           = getValue('nes_meta_keyword', 'str', 'POST', '');
$nes_meta_description       = getValue('nes_meta_description', 'str', 'POST', '');
$nes_content                = getValue('nes_content', 'str', 'POST', '');
$nes_image                  = isset($_FILES['nes_image']) ? $_FILES['nes_image'] : [];
$nes_type_id                = getValue('nes_type_id', 'int', 'POST', '');
$nes_active                 = getValue('nes_active', 'int', 'POST', '');
$nes_author_id              = getValue('nes_author_id', 'str', 'POST', '');
$action                     = getValue('action', 'str', 'POST', '', '');

// $new_type = News::select_all();

$category = Category::select_all();

if ('add' == $action) {
    $validator = new Validator;
    $validator->addExtension('Exit', function ($attribue, $value) {
        $checkExitNews = News::where("nes_title = '" . $value . "' ")->first();
        if ($checkExitNews == null) {
            return true;
        } else {
            return false;
        }
    });
    
    $rules = [
        'nes_title'         => 'required|min:5|max:100',
        'nes_description'   => 'required|min:5|max:300',
        'nes_content'       => 'required',
        'nes_image'         => 'required',
        'nes_author_id'         => 'required',
        'nes_type_id' => 'required',
    ];

    $messages = [
        'nes_title.required'        => 'Vui lòng nhập tiêu đề bài viết',
        'nes_title.min'             => 'Tiêu đề bài viết lớn hơn 5 kí tự',
        'nes_title.max'             => 'Tiêu đề bài viết phải nhỏ hơn 100 kí tự',
        'nes_description.required'  => 'Vui lòng nhập mô tả ngắn',
        'nes_description.min'       => 'Mô tả ngắn lớn hơn 5 kí tự',
        'nes_description.max'       => 'Mô tả ngắn phải nhỏ hơn 300 kí tự',
        'nes_content.required'      => 'Vui lòng nhập nội dung',
        'nes_image.required'        => 'Vui lòng chọn ảnh',
        'nes_author_id.required'        => 'Nhập tên tác giả',
        'nes_type_id.required' => 'Vui lòng chọn danh mục',
    ];

    $validator ->setData($_POST)->setRules($rules)->setMessages($messages);
    if( ! $validator->passes() ) {
        $errors = $validator->getErrors();
        flash_message('error', 'Xác thực lỗi ! vui lòng check lại các trường trong form');
        flash_message('errors', $errors);
        flash_message('old_inputs', $_POST);
        redirect($_SERVER['REQUEST_URI']);
    }

    if ($_FILES['nes_image']['error'] == 0) {
        $picture = upload_img('news', $nes_image);
    }

    $nes_back_id = News::insert([
        'nes_title'         => $nes_title,
        'nes_slug'          => str_slug($nes_title),
        'nes_description'   => $nes_description,
        'nes_meta_title'    => $nes_meta_title,
        'nes_meta_keyword'  => $nes_meta_keyword,
        'nes_meta_description'   => $nes_meta_description,
        'nes_content'       => $nes_content,
        'nes_image'         => isset($picture) ? $picture : '',
        'nes_type_id'       => $nes_type_id,
        'nes_active'        => $nes_active,
        'nes_author_id' => $nes_author_id,
        'nes_create_time'   => time(),
    ]);

    flash_message('success', 'Tạo tin tức thành công');

}
echo $template->render('create', compact('load_header','category'));