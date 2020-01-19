<?php

require_once("../../bootstrap.php");
require_once("../../resource/security/security.php");

$module_id = '100';
$module_name = "news";

//Check user login...
checkLogged();
//Check access module...
if (checkAccessModule($module_id) != 1) {
    redirect($fs_denypath);
}

// Template engine
$template = new TemplateEngine(
    __DIR__ . '/templates'
);

