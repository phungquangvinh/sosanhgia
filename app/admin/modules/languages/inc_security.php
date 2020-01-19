<?php

require_once("../../bootstrap.php");
require_once("../../resource/security/security.php");

$module_id = '';
$module_name = 'Languages';


checkLogged();

if (checkAccessModule($module_id) != 1) {
	redirect($fs_denypath);
}


$template = new TemplateEngine(
	__DIR__ . '/templates'
);