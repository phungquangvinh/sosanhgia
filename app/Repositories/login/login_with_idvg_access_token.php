<?php
/**
 * Created by PhpStorm.
 * User: ntdinh1987
 * Date: 4/25/2017
 * Time: 10:35 AM
 */

$access_token = input('access_token')[0]['access_token'];
$info = input('access_token')[0]['acc'];
//$facebook_token = input('access_token')[0]['facebook_token'];

if ($info) {
    $userModel = new \App\Models\Users\Users();
    $userInfo = $userModel->getByEmail($info['email']);
    if (!$userInfo) {

        $info['access_token'] = $access_token;

        $userInfo = $userModel->createUserFromDataIdVg($info);
        $userInfo = $userModel->getByEmail($info['email']);
    }

    if ($userInfo) {
        $myUser = new user();

        $_COOKIE[$myUser->pre_cookie . "loginname"] = $userInfo['use_email'];
        $_COOKIE[$myUser->pre_cookie . "PHPSESSlD"] = $userInfo['use_password'];

        $myUser = new \user();
        $myUser->logged = 1;
        $myUser->savecookie(2 * 86400);
    }

    return [
        'vars' => [
            'success' => true,
            'info' => $userInfo
        ]
    ];
}

