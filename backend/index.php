<?php
/*
// For debug
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set("log_errors", 1);
*/
require_once 'Core/config.php';
require_once 'Controllers/islCollectTestAppController.php';

$app = new \backend\Controllers\islCollectTestAppController();
$app->run();
