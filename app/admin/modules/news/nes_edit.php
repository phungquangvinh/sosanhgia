<?php

require_once 'inc_security.php';

use BlackBear\Validation\Validator;
use App\Models\News;
use App\Models\Categories\Category;

$nes_title              = getValue('nes_title', 'str', 'POST', '');
$nes_description        = getValue('nes_description', 'str', 'POST', '');
$nes_meta_keyword       = getValue('nes_meta_keyword', 'str', 'POST', '');
$nes_meta_title         = getValue('nes_meta_title', 'str', 'POST', '');
$nes_meta_description   = getValue('nes_meta_description', 'str', 'POST', '');
$nes_content            = getValue('nes_content', 'str', 'POST', '');
$nes_image              = isset($_FILES['nes_image']) ? $_FILES['nes_image'] : [];
$nes_type_id            = getValue('type_id', 'str', 'POST', '');
$nes_active             = getValue('nes_active', 'int', 'POST', '');
$nes_author_id          = getValue('nes_author_id', 'str', 'POST', '', '');
$action                 = getValue('action', 'str', 'POST', '', '');
$getId                  = getValue('id', 'str', 'GET', '');
$postId                 = getValue('id', 'str', 'POST', '');

if ($postId) {
    $id = $postId;
} else {
    $id = $getId;
}
// $news_type = News_type::fields('net_id','net_name')->select_all();
$dataUpdate = News::where('nes_id =' . $id)->first();
$category = Category::where('cat_active = 1')->select_all();

if ($action == 'edit' && $dataUpdate) {

    
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

        $validator = new Validator($_POST, $rules, $messages);

        if (!$validator->passes()) {
            $errors = $validator->getErrors();
            flash_message('error', 'Vui lòng check lại các trường trong form');
            flash_message('errors', $errors);
            flash_message('old_inputs', $_POST);
            redirect($_SERVER['REQUEST_URI']);
        }


        if ($_FILES['nes_image']['error'] == 0) {
            $picture = upload_img('news',$nes_image);
        }


        $nes_back_id = $dataUpdate->update([
            'nes_title'         => $nes_title,
            'nes_slug'          => str_slug($nes_title),
            'nes_description'   => $nes_description,
            'nes_meta_title'    => $nes_meta_title,
            'nes_meta_keyword'  => $nes_meta_keyword,
            'nes_meta_description'   => $nes_meta_description,
            'nes_content'       => $nes_content,
            'nes_image'         => isset($picture) ? $picture : $dataUpdate->nes_image,
            'nes_type_id'       => $nes_type_id,
            'nes_active'        => $nes_active,
            'nes_author_id' => $nes_author_id,
            'nes_update_time'   => time(),
        ]);

        flash_message('success', 'Cập nhật tin tức thành công');

}

echo $template->render('edit', compact('load_header', 'dataUpdate', 'category'));
