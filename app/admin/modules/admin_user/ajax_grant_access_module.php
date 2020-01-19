<?php
header('Content-Type: application/json');

require_once 'inc_security.php';

$right = getValue('right', 'str', 'POST', '', 3);
$moduleId = getValue('module_id', 'int', 'POST', 0, 3);
$userId = getValue('user_id', 'int', 'POST', 0, 3);

$rightsSet = ['add', 'edit', 'delete'];

if( ! in_array($right, $rightsSet) ) {
    echo json_encode(['code' => 0]);
    exit;
}

$rightExist = \App\Models\AdminUserRight::where('adu_admin_id='.$userId)
                        ->where('adu_admin_module_id='.$moduleId)
                        ->select();

$rightField = 'adu_'.$right;

if($rightExist) {
    \App\Models\AdminUserRight::where('adu_admin_id='.$userId)
        ->where('adu_admin_module_id='.$moduleId)
        ->update([
            $rightField => (int) !$rightExist->$rightField
        ]);
} else {
    \App\Models\AdminUserRight::replace([
        'adu_admin_id' => $userId,
        'adu_admin_module_id' => $moduleId,
        $rightField => 1
    ]);
}

echo json_encode(['code' => 1]);
exit;