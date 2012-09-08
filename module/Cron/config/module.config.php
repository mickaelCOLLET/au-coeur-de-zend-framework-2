<?php
return array(
    'console' => array(
        'routes' => array(
            'crawl-tutoriel' => array(
                'type' => 'simple',
                'options' => array(
                    'route' => '--crawl-tutoriel',
                    'defaults' => array(
                        'controller' => 'Cron\Controller\CrawlController',
                        'action'     => 'tutoriel',
                    ),
                ),
            ),
            'crawl-tweet' => array(
                'type' => 'simple',
                'options' => array(
                    'route' => '--crawl-tweet',
                    'defaults' => array(
                        'controller' => 'Cron\Controller\CrawlController',
                        'action'     => 'tweet',
                    ),
                ),
            ),
            'crawl-tutoriel-search' => array(
                'type' => 'simple',
                'options' => array(
                    'route' => '--crawl-tutoriel-search',
                    'defaults' => array(
                        'controller' => 'Cron\Controller\CrawlController',
                        'action'     => 'tutorielsearch',
                    ),
                ),
            ),
            'crawl-social' => array(
                'type' => 'simple',
                'options' => array(
                    'route' => '--crawl-social',
                    'defaults' => array(
                        'controller' => 'Cron\Controller\CrawlController',
                        'action'     => 'social',
                    ),
                ),
            ),
            'publish-tweet' => array(
                'type' => 'simple',
                'options' => array(
                    'route' => '--publish-tweet',
                    'defaults' => array(
                        'controller' => 'Cron\Controller\PublishController',
                        'action'     => 'tweet',
                    ),
                ),
            ),
        ),
    ),
    /*
    'di' => array(
        'definition' => array(
            'class' => array(
                'Zend\Search\Lucene\Index' => array(
                    'instantiator' => array(
                        'Zend\Search\Lucene\Lucene',
                        'create'
                    ),
                ),
            ),
        ),
        'instance' => array(
            'Cron\Controller\CrawlController' => array(
                'parameters' => array(
                    'tutorielTable' => 'Application\Model\TutorielTable',
                    'youtubeTable' => 'Application\Model\YoutubeTable',
                    'slideshare' => 'Zend\Service\SlideShare\SlideShare',
                    'slideshareService' => 'Application\Service\SlideshareService',
                    'tweetService' => 'Application\Service\TweetService',
                    'zfbTwitterOptions' => 'ZFBook\Service\Twitter\TwitterOptions',
                    //'lucene' => 'Zend\Search\Lucene\Index',
                ),
            ),
            'Cron\Controller\PublishController' => array(
                'parameters' => array(
                    'tweetTable' => 'Application\Model\TweetTable',
                    'serviceTwitter' => 'Zend\Service\Twitter\Twitter',
                ),
            ),
            'Zend\Search\Lucene\Index' => array(
                'parameters' => array(
                    'directory' => realpath(__DIR__ . '/../../../data/lucene/'),
                    'create' => true,
                ),
            ),
        ),
    ),
    */
);
