<?php

require_once 'inc_security.php';

use App\Models\AdminUser;
use BlackBear\Validation\Validator;

$name = getValue('name', 'str', 'POST', '', 3);
$phone = getValue('phone', 'str', 'POST', '', 3);
$loginName = getValue('login_name', 'str', 'POST', '', 3);
$password = getValue('password', 'str', 'POST', '', 3);
$rePassword = getValue('re_password','str', 'POST', '', 3);
$action = getValue('action', 'str', 'POST', '', 3);

if( 'update' == $action ) {

    $rules = [
        'name'          => 'required',
        'login_name'    => 'required',
        'password'      => 'required',
        're_password'   => 'required'
    ];

    $messages = [
        'name.required' => 'Please enter name',
        'login_name.required' => 'Please enter login name',
        'password.required' => 'Please enter password',
        're_password.required' => 'Please enter re password',
    ];

    $validator = new Validator($_POST, $rules, $messages);

    if( ! $validator->passes() ) {
        $errors = $validator->getErrors();
        flash_message('error', 'Please check the form');
        flash_message('errors', $errors);
        flash_message('old_inputs', $_POST);
        redirect($_SERVER['REQUEST_URI']);
    }

    AdminUser::insert([
        'adm_name' => $name,
        'adm_phone' => $phone,
        'adm_loginname' => $loginName,
        'adm_password' => md5($password)
    ]);

    flash_message('success', 'Create user successfully');
    redirect('user_index.php');
}

echo $template->render('create', compact('load_header'));