<?php
use BlackBear\Validation\Validator;
use App\Models\Post;
use App\Models\Categories\Category;
use App\Models\AdminUser;

require_once 'inc_security.php';

$pos_title = getValue('pos_title', 'str', 'POST', '');
$pos_image = isset($_FILES['pos_image']) ? $_FILES['pos_image'] : [];
$pos_category_id = getValue('category_id', 'str', 'POST', '');
$pos_admin_id = getValue('pos_admin_id', 'int', 'POST', '', '');
$pos_author_id = getValue('pos_author_id', 'int', 'POST', '', '');
$pos_active = getValue('pos_active', 'int', 'POST', '');
$pos_teaser = getValue('pos_teaser', 'str', 'POST', '');

$action = getValue('action', 'str', 'POST', '', '');

$pos_category = Category::where('cat_type="news"')->order_by('cat_name','ASC')->select_all();
$pos_author = AdminUser::where(1)->select_all();

if ('add' == $action) {
    $validator = new Validator;
//    $validator->addExtension('Exit', function ($attribue, $value) {
//        $checkExitPost = Post::where("pos_title = '".$value."'")->first();
//        if ($checkExitPost == null) {
//            return true;
//        } else {
//            return false;
//        }
//    });

    $rules = [
        'pos_title' => 'required|min:5|max:100',
        'pos_image' => 'required',
        'pos_teaser' => 'required',
    ];
    $messages = [
        'pos_title.required' => 'Vui lòng nhập tiêu đề bài viết',
        'pos_title.min' => 'Tiêu đề bài viết lớn hơn 5 kí tự',
        'pos_title.max' => 'Tiêu đề bài viết phải nhỏ hơn 100 kí tự',
        'pos_image.required' => 'Vui lòng chọn ảnh',
        'pos_teaser.required' => 'Vui lòng nhập nội dung',
    ];

    $validator ->setData($_POST)->setRules($rules)->setMessages($messages);
    if( ! $validator->passes() ) {
        $errors = $validator->getErrors();
        flash_message('error', 'Xác thực lỗi ! vui lòng check lại các trường trong form');
        flash_message('errors', $errors);
        flash_message('old_inputs', $_POST);
        redirect($_SERVER['REQUEST_URI']);
    }

    if ($_FILES['pos_image']['error'] == 0) {
        $posImage = upload_img('posts',$pos_image);
    }

    $post_back_id = Post::insert([
        'pos_title' => $pos_title,
        'pos_slug' => str_slug($pos_title),
        'pos_teaser' => $pos_teaser,
        'pos_image' => isset($posImage) ? $posImage : '',
        'pos_active' => $pos_active,
        'pos_author_id' => $pos_author_id,
        'pos_category_id' => $pos_category_id,
    ]);
    // flash_message('success', 'Tạo tin tức thành công');
    // redirect('pos_index.php');

}
echo $template->render('create', compact('load_header','pos_category', 'pos_author'));
