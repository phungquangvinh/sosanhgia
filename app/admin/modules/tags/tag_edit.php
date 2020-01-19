<?php

require_once 'inc_security.php';

use App\Models\Tags;
use BlackBear\Validation\Validator;

$tag_name = getValue('tag_name', 'str', 'POST', '');
$tag_slug = getValue('tag_slug', 'str', 'POST', '');
$tag_meta_title = getValue('tag_meta_title', 'str', 'POST', '');
$tag_meta_keywords = getValue('tag_meta_keywords', 'str', 'POST', '');
$tag_meta_description = getValue('tag_meta_description', 'str', 'POST', '');

$action = getValue('action', 'str', 'POST', '', '');
$getId = getValue('id', 'str', 'GET', '');
$postId = getValue('id', 'str', 'POST', '');

if ($postId) {
    $id = $postId;
} else {
    $id = $getId;
}

$dataUpdate = Tags::where('tag_id =' . $id)->first();
if ($action == 'edit' && $dataUpdate) {
	$rules = [
		'tag_name' => 'required',
		'tag_slug' => 'required',
	];
	$messages = [
		'tag_name.required' => 'Khong duoc de trong',
		'tag_slug.required' => 'Khong duoc de trong',
	];

	$validator = new Validator($_POST, $rules, $messages);
	if (!$validator->passes()) {
        $errors = $validator->getErrors();
        flash_message('error', 'Vui lòng check lại các trường trong form');
        flash_message('errors', $errors);
        flash_message('old_inputs', $_POST);
        redirect($_SERVER['REQUEST_URI']);
    }
    $dataUpdate->update([
    	'tag_name' => $tag_name,
    	'tag_slug' => $tag_slug,
    	'tag_meta_title' => $tag_meta_title,
    	'tag_meta_keywords' => $tag_meta_keywords,
    	'tag_meta_description' => $tag_meta_description,
    	'tag_updated_at' => time(),
    ]);

    flash_message('success', 'Cập nhật thành công');
    redirect('tag_index.php');
}
echo $template->render('edit', compact('load_header', 'dataUpdate'));