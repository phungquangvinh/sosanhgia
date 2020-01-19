<?php

require_once 'inc_security.php';

use App\Models\AdminUser;
use BlackBear\Validation\Validator;

$id = getValue('id', 'int', "GET", 0, 3);

$user = AdminUser::findByID($id);
if( !$user ) {
    flash_message('error', 'User not found');
    redirect('user_index.php');
}

$name = getValue('name', 'str', 'POST', '', 3);
$phone = getValue('phone', 'str', 'POST', '', 3);
$loginName = getValue('login_name', 'str', 'POST', '', 3);
$password = getValue('password', 'str', 'POST', '', 3);
$rePassword = getValue('re_password','str', 'POST', '', 3);
$action = getValue('action', 'str', 'POST', '', 3);



if( 'update' == $action ) {

    $rules = [
        'name'       => 'required',
        'login_name' => 'required'
    ];

    $messages = [
        'name.required' => 'Please enter name',
        'login_name.required' => 'Please enter login name'
    ];

    $validator = new Validator($_POST, $rules, $messages);

    if( ! $validator->passes() ) {
        $errors = $validator->getErrors();
        flash_message('error', 'Please check the form');
        flash_message('errors', $errors);
        flash_message('old_inputs', $_POST);
        redirect($_SERVER['REQUEST_URI']);
    }

    AdminUser::where('adm_id='.$id)->update([
        'adm_name' => $name,
        'adm_phone' => $phone,
        'adm_loginname' => $loginName
    ]);

    flash_message('success', 'Update user successfully');
    redirect('user_index.php');
}

echo $template->render('edit', compact('load_header', 'user'));