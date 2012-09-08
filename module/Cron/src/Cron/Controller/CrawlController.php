<?php

namespace Cron\Controller;

use Zend\Service\Twitter\SearchOptions;
use Zend\Http\Client;
use Zend\Service\SlideShare\SlideShare;
use Zend\GData\YouTube;
use Zend\Service\Twitter;

class CrawlController extends AbstractController
{
    /**
     * Get new tweet about ZF
     */
    public function tweetAction()
    {
    	// get twitter crawled options
        $sm = $this->getServiceLocator();
        $queries = $sm->get('TwitterOptions')->getQueries();
        $langs = $sm->get('TwitterOptions')->getLanguages();
        $results_type = array('recent', 'popular');
        
        foreach($langs as $lang) {
            foreach($queries as $query) {
                foreach($results_type as $result_type) {
                    // get search
                    $search = new Twitter\Search();
                    $search->setOptions(new SearchOptions(array(
                        'rpp' => 25,
                        'include_entities' => true,
                        'result_type' => $result_type,
                        'lang' => $lang,
                    )));
                    $results = $search->execute($query);

                    // add tweets in db
                    foreach($results['results'] as $result) {   
                        $sm->get('TweetService')->addTweet($result);
                    }
                }
            }
        }
    }
    
    public function socialAction()
    {   
    	// get linkedin slides
        $sm = $this->getServiceLocator();
        $slideshare = new SlideShare();
        $slideshare->setCacheObject(new \ZFBook\Cache\Storage\Adapter\BlackHole());
    	$slideShows = $slideshare->searchSlideShows('zend framework');
    	
    	foreach ($slideShows as $slideShow) {
            $sm->get('SldieshareService')->addSlideShow($slideShow);
        }
    	
    	// get youtube webinars
    	$youtube = new YouTube();
        $query = $youtube->newVideoQuery();
        $query->videoQuery = 'zend framework';
        $query->startIndex = 0;
        $query->maxResults = 20;
        $query->orderBy = 'viewCount';
        $videoFeed = $youtube->getVideoFeed($query);

        foreach ($videoFeed as $videoEntry) {
            $sm->get('YoutubeModel')->addVideo($videoEntry);
        }
    }
}
