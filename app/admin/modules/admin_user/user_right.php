<?php

require_once 'inc_security.php';

use App\Models\AdminUser;
use App\Models\Module;

$id = getValue('id', 'int', 'GET', '', 3);
$user = AdminUser::findByID($id);

if( ! $user ) {
    flash_message('error', 'User not found');
    redirect('user_index.php');
}

$modules = Module::select_all();
$mapUserModules = [];

foreach($modules as $module) {
    $userModule =  \App\Models\AdminUserRight::where('adu_admin_id='.$id)
                     ->where('adu_admin_module_id='.$module->id)
                     ->select();

    $mapUserModules[$module->id] = [
        'add' => $userModule ? $userModule->add : 0,
        'edit' => $userModule ? $userModule->edit : 0,
        'delete' => $userModule ? $userModule->delete : 0
    ];
}

//dd($mapUserModules);

echo $template->render('right', compact('load_header', 'user', 'modules', 'mapUserModules'));