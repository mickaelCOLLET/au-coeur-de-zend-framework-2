Zend Framework 2 Aggregator
==============

Version 0.4.1 Created by [Vincent Blanchon](http://developpeur-zend-framework.fr/)

Introduction
------------

The Zend Framework 2 Aggregator is a content aggregator based on the book "<a href="http://au-coeur-de-zend-framework-2.fr/" target="_blank">Au coeur de Zend Framework 2</a>" (french book, available in the end of the year).
The focus of the projet is to use a maximum of ZF components (Twitter, Slideshare, Youtube, etc ... Lucene is the search engine) to build a great exemple of zend framework application.
No commercial project.

This project run on the website "<a href="http://zend-framework-2.fr/" target="_blank">zend-framework-2.fr</a>".

For this project, i redefined a party of the module manager to have a lazy loading and increase the performance.

Lazy Loading module usage
------------

<a href="https://github.com/blanchonvincent/zf2-lazy-loading-module" target="_blank">Lazy loading project</a> is available on <a href="https://github.com/blanchonvincent/zf2-lazy-loading-module" target="_blank">Github</a>.

Lazy loading module concept can load only authorize module for the current environment.
Exemple :

1) I want load my "Administration" module only on port 443, and if my client ip is valid.
Without that, to load this module is useless.

The config to load module only on port 443 and ip on white list, with config/application.config.php :

    <?php 
    return array(
        'modules' => array(
            'Application',
            'Cron',
            'Administration'
        ),
        'module_listener_options' => array( 
            'config_cache_enabled' => false,
            'cache_dir'            => 'data/cache',
            'module_paths' => array(
                'Application' => './module/Application',
                'Cron' => './module/Cron',
                'Administration' => './module/Administration',
            ),
            'lazy_loading' => array(
                'Administration' => array(
                    'port' => '443',
                    'remote_addr' => array('127.0.0.1'),
                ),
            ),
        ),
    );
    ?>

2) I want load my "Cron" module only in "cli" sapi and run url in argument :

    <?php 
    return array(
        'modules' => array(
            'Application',
            'Cron',
            'Administration'
        ),
        'module_listener_options' => array( 
            'config_cache_enabled' => false,
            'cache_dir'            => 'data/cache',
            'module_paths' => array(
                'Application' => './module/Application',
                'Cron' => './module/Cron',
                'Administration' => './module/Administration',
            ),
            'lazy_loading' => array(
                'Cron' => array(
                    'getopt' => array('cron=s' => 'cron url'),
                    'sapi' => 'cli',
                ),
            ),
        ),
    );
    ?>

Filter available are : argument in command line, sapi, domain, https protocol, server port, url and remote address.

The cache key will be automatically update with the module loaded.