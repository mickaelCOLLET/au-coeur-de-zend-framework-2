<?php

namespace Cron\Controller;

use Zend\Service\Twitter\Twitter;
use ZFBook\Service\Twitter\Language as ZFBTwitterLang;
use Application\Model\TweetTable;

class PublishController extends AbstractController
{    
    public function tweetAction()
    {
    	// get last tweet not published
        $sm = $this->getServiceLocator();
        $tweetFR = $sm->get('TweetModel')->fetchLastToPublished('fr');
        $tweetEN = $sm->get('TweetModel')->fetchLastToPublished('en');
        
        // twitt that
        $twitter = new Twitter();
    	$response = $twitter->status->update('[FR]@'.$tweetFR->user . ':'.$tweetFR->text);
    	$response = $twitter->status->update('[EN]@'.$tweetEN->user . ':'.$tweetEN->text);
    }
}
