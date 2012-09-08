<?php

$zf2Path = getenv('ZF2_PATH') ?: (is_dir('vendor/ZF2/library') ? 'vendor/ZF2/library' : '');
include $zf2Path . '/Zend/Loader/AutoloaderFactory.php';
Zend\Loader\AutoloaderFactory::factory(array(
    'Zend\Loader\StandardAutoloader' => array(
        'autoregister_zf' => true,
        'namespaces' => array(
            'ZendService' => __DIR__ . '/vendor/ZF2/library/ZendService',
            'ZendRest' => __DIR__ . '/vendor/ZF2/library/ZendRest',
        ),
    ),
    'Zend\Loader\ClassMapAutoloader' => array(
        'config/autoload_classmap.php'
    ),
));