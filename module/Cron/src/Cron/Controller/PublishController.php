<?php

namespace Cron\Controller;

use Zend\Service\Twitter\Twitter,
    ZFBook\Service\Twitter\Language as ZFBTwitterLang,
    Application\Model\TweetTable;

class PublishController extends AbstractController
{
    /**
     * @var Application\Model\TweetTable
     */
    protected $tweetTable;
    
    /**
     * @var Zend\Service\Twitter\Twitter
     */
    protected $twitter;
    
    public function tweetAction()
    {
    	// get last tweet not published
        $tweetFR = $this->tweetTable->fetchLastToPublished('fr');
        $tweetEN = $this->tweetTable->fetchLastToPublished('en');
        
        // twitt that
    	$response = $this->twitter->status->update('[FR]@'.$tweetFR->user . ':'.$tweetFR->text);
    	$response = $this->twitter->status->update('[EN]@'.$tweetEN->user . ':'.$tweetEN->text);
    }
    
    public function setTweetService(TweetTable $tweetTable)
    {
        $this->tweetTable = $tweetTable;
        return $this;
    }
    
    public function setTwitter(Twitter $twitter)
    {
        $this->tweetService = $twitter;
        return $this;
    }
}
