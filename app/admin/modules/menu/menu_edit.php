<?php
require_once 'inc_security.php';

use BlackBear\Validation\Validator;
use App\Models\Menu;
use App\Models\Categories\Category;

$menu_name = getValue('menu_name', 'str', 'POST', '');
$menu_icon = isset($_FILES['menu_icon']) ? $_FILES['menu_icon'] : [];
$menu_description = getValue('menu_description', 'str', 'POST', '');
$menu_link = getValue('menu_link', 'str', 'POST', '');
$menu_category = getValue('menu_category', 'str', 'POST', '');

$action = getValue('action', 'str', 'POST', '');
$getId = getValue('id', 'str', 'GET', '');
$postId = getValue('id', 'str', 'POST', '');

$category = Category::select_all();

if ($postId) {
    $id = $postId;
} else {
    $id = $getId;
}

$updateListMenu = Menu::where('menu_id = '.$id)->first();

if ($action == 'edit' && $updateListMenu) {
    $rules = [
        'menu_name' => 'required|min:3|max:50',
        'menu_icon' => 'required',
        'menu_description' => 'required|min:3',
        'menu_link' => 'required|min:3',
        'menu_category' => 'required',
    ];
    $messages = [
        'menu_name.required' => 'Vui lòng nhập tên',
        'menu_name.min' => 'Tên phải dài hơn 2 kí tự',
        'menu_name.max' => 'Tên phải ngắn hơn 50 kí tự',
        'menu_icon.required' => 'Vui lòng chọn ảnh',
        'menu_description.required' => 'Vui lòng nhập nội dung',
        'menu_description.min' => 'Nội dung phải dài hơn 2 kí tự',
        'menu_link.required' => 'Vui lòng nhập Link',
        'menu_link.min' => 'Link phải dài hơn 2 kí tự',
        'menu_category.required' => 'Bạn phải nhập danh mục',
    ];

    $validator = new Validator($_POST, $rules, $messages);
    if (!$validator->passes()) {
        $errors = $validator->getErrors();
        flash_message('error', 'Vui lòng check lại các trường trong form');
        flash_message('errors', $errors);
        flash_message('old_inputs', $_POST);
        redirect($_SERVER['REQUEST_URI']);
    }

    if ($_FILES['menu_icon']['error'] == 0) {
        $menuImage = upload_img('menu',$menu_icon);
    }

    $menu_back_id = $updateListMenu->update([
        'menu_name' => $menu_name,
        'menu_icon' => isset($menuImage) ? $menuImage : $updateListMenu->menu_icon,
        'menu_description' => $menu_description,
        'menu_link' => $menu_link,
        'menu_category_id' => $menu_category,
    ]);

    flash_message('success', 'Cập nhật menu thành công');
    // redirect('menu_index.php');
}
echo $template->render('edit', compact('load_header', 'updateListMenu', 'category'));