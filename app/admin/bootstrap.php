<?php
include 'initsession.php';
define('APP_START', microtime(true));

define('ROOT', realpath(dirname(__FILE__) . '/../../'));

require_once ROOT . '/vendor/autoload.php';
require_once 'vendor/autoload.php';

require_once(__DIR__ . "/functions/translate.php");
require_once(dirname(__FILE__) . "/resource/security/functions.php");
require_once(dirname(__FILE__) . "/classes/denyconnect.php");
require_once(dirname(__FILE__) . "/classes/form.php");
require_once(dirname(__FILE__) . '/functions/date_functions.php');
require_once(dirname(__FILE__) . "/functions/file_functions.php");
require_once(dirname(__FILE__) . "/functions/resize_image.php");
require_once(dirname(__FILE__) . "/functions/functions.php");

require_once(dirname(__FILE__) . "/functions/pagebreak.php");

require_once(dirname(__FILE__) . "/classes/html_cleanup.php");
require_once(dirname(__FILE__) . "/classes/upload.php");
require_once(dirname(__FILE__) . "/classes/menu.php");

require_once(dirname(__FILE__) . "/resource/security/grid.php");

// Twig template
require_once(dirname(__FILE__) . "/classes/Twig/Autoloader.php");

require_once(dirname(__FILE__) . "/classes/TemplateEngine.php");


\VatGia\LoadEnv::load(ROOT);
$app = new \VatGia\Application();

$app->register('config', function () {
    return \VatGia\Config::load(ROOT . '/config/');
});

define('MYSQL_MAX_TIME_SLOW', config('database.max_time_slow'));

$app->register('debug', function () {
    $debug = new \VatGia\Helpers\Debug();
    return $debug;
});

// Upload file
$app->register('uploader', function() {
    $upload = new Nht\Hocs\Core\Uploads\Upload();
    return new Nht\Hocs\Core\Uploads\Uploader($upload);
});

// Upload ảnh && resize
$app->register('image_uploader', function() {
    $uploader = app('uploader');
    $image = new Nht\Hocs\Core\Images\Image();
    return new Nht\Hocs\Core\Images\ImageFactory($uploader, $image);
});

$app->register('logger', function() {
    // create a log channel
    $log = new Monolog\Logger('Application');
    $log->pushHandler(new Monolog\Handler\StreamHandler(ROOT.'/ipstore/giaca-'.date('Y-m-d').'.log'));
    return $log;
});