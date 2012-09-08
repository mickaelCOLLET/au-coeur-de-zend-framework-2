<?php

ini_set('date.timezone',"Europe/Paris");
ini_set("display_errors", true);
ini_set("display_startup_errors", true);
error_reporting(E_ALL | E_STRICT);

// Setup autoloading
chdir(dirname(__DIR__));
include 'init_autoloader.php';

// Run the application!
Zend\Mvc\Application::init(include 'config/application.config.php')->run();
