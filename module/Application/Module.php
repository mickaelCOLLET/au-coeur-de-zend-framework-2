<?php

namespace Application;

use Application\Model\Table;
use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\MvcEvent;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\View\Helper\PaginationControl;
use Zend\Navigation\Page\Mvc as PageMvc;
use Zend\Db\Adapter\Adapter as DbAdapter;

class Module implements AutoloaderProviderInterface, ServiceProviderInterface,
        BootstrapListenerInterface, ConfigProviderInterface
{
    public function onBootstrap(EventInterface $e)
    {
        PaginationControl::setDefaultViewPartial('bloc/paginator');
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'DbAdapter' => function($sm) {
                    $config = $sm->get('config');
                    $config = $config['db'];
                    $dbAdapter = new DbAdapter($config);
                    return $dbAdapter;
                },
                'TweetTable' => function($sm) {
                    return new Table\TweetTable($sm->get('DbAdapter'), 'tweet');
                },
                'TutorielTable' => function($sm) {
                    return new Table\TutorielTable($sm->get('DbAdapter'), 'tutoriel');
                },
                'YoutubeTable' => function($sm) {
                    return new Table\YoutubeTable($sm->get('DbAdapter'), 'youtube');
                },
                'SlideshareTable' => function($sm) {
                    return new Table\SlideshareTable($sm->get('DbAdapter'), 'slideshare');
                },
                'LanguageTable' => function($sm) {
                    return new Table\LanguageTable($sm->get('DbAdapter'), 'language');
                },
                'FacebookTable' => function($sm) {
                    return new Table\FacebookTable($sm->get('DbAdapter'), 'facebook');
                },
                'DeveloperTable' => function($sm) {
                    return new Table\DeveloperTable($sm->get('DbAdapter'), 'developer');
                },
            ),
            'aliases' => array(
                'TweetModel' => 'TweetTable',
                'TutorielModel' => 'TutorielTable',
                'YoutubeModel' => 'YoutubeTable',
                'SlideshareModel' => 'SlideshareTable',
                'LanguageModel' => 'LanguageTable',
                'FacebookModel' => 'FacebookTable',
                'DeveloperModel' => 'DeveloperTable',
            ),
        );
    }
}
