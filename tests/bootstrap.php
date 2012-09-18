<?php

date_default_timezone_set('Europe/Paris');

require_once __DIR__ . '/../init_autoloader.php';

use Zend\Loader\StandardAutoloader;

$autoloader = new StandardAutoloader();
$autoloader->registerNamespace('ModuleTest', __DIR__ . '/module/');
$autoloader->registerNamespace('ZFUT', __DIR__ . '/../vendor/ZFUT/');
$autoloader->register();