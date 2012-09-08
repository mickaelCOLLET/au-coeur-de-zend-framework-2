<?php

namespace Cron\Controller;

use Application\Service\TweetService,
    Application\Model\TutorielTable,
    Application\Service\SlideshareService,
    Application\Model\YoutubeTable,
    Zend\Service\Twitter\SearchOptions,
    ZFBook\Service\Twitter\TwitterOptions as ZFBTwitterOptions,
    Zend\Search\Lucene\Index,
    Zend\Search\Lucene\Document,
    Zend\Search\Lucene\Document\HTML as DocumentHTML,
    Zend\Http\Client,
    Zend\Service\SlideShare\SlideShare;

class CrawlController extends AbstractController
{
    /**
     * @var Application\Service\TweetService
     */
    protected $tweetService;
    
    /**
     * @var Application\Model\TurorielTable
     */
    protected $tutorielTable;
    
    /**
     * @var Application\Model\YoutubeTable
     */
    protected $youtubeTable;
    
    /**
     * @var Application\Service\SlideshareService
     */
    protected $slideshareService;
    
    /**
     * @var Zend\Service\SlideShare\SlideShare
     */
    protected $slideshare;
    
    /**
     * @var ZFBook\Service\Twitter\TwitterOptions
     */
    protected $zfbTwitterOptions;
    
    /**
     * @var Zend\Search\Lucene\Index
     */
    protected $lucene;
    
    /**
     * Get new tweet about ZF
     */
    public function tweetAction()
    {
    	// get twitter crawled options
        $queries = $this->zfbTwitterOptions->getQueries();
        $langs = $this->zfbTwitterOptions->getLanguages();
        $results_type = array('recent', 'popular');
        
        foreach($langs as $lang)
        {
            foreach($queries as $query)
            {
                foreach($results_type as $result_type)
                {
                    // get search
                    $search = new \Zend\Service\Twitter\Search();
                    $search->setOptions(new SearchOptions(array(
                        'rpp' => 25,
                        'include_entities' => true,
                        'result_type' => $result_type,
                        'lang' => $lang,
                    )));
                    $results = $search->execute($query);

                    // add tweets in db
                    foreach($results['results'] as $result)
                    {   
                        $this->tweetService->addTweet($result);
                    }
                }
            }
        }
    }
    
    public function tutorielsearchAction()
    {
        // get all tutoriel
        $tutos = $this->tutorielTable->fetchAllLanguage();
        foreach($tutos as $tuto)
        {
            $client = new Client();
            $client->setAdapter(new Client\Adapter\Curl());
            $client->setUri($tuto->url);
            $response = $client->send();
            if(!$response->isOk())
            {
                continue;
            }
            
            $content = $response->getBody();
            
            if(!$content)
            {
                continue;
            }
            
            // add document
            $document = DocumentHTML::loadHTML($content, false, true);
            $document->addField(Document\Field::unIndexed('tutoriel-id',$tuto->id));
            $document->addField(Document\Field::unIndexed('tutoriel-language',$tuto->code));
            $document->addField(Document\Field::keyword('tag', $tuto->tags));
            $this->lucene->addDocument($document);
            
            // save flag indexation in db
            // ...
        }
    }
    
    public function socialAction()
    {   
    	// get linkedin slides
        $this->slideshare->setCacheObject(new \ZFBook\Cache\Storage\Adapter\BlackHole());
    	$slideShows = $this->slideshare->searchSlideShows('zend framework');
    	
    	foreach ($slideShows as $slideShow) {
            $this->slideshareService->addSlideShow($slideShow);
        }
    	
    	// get youtube webinars
    	$youtube = new \Zend\GData\YouTube();
        $query = $youtube->newVideoQuery();
        $query->videoQuery = 'zend framework';
        $query->startIndex = 0;
        $query->maxResults = 20;
        $query->orderBy = 'viewCount';
        $videoFeed = $youtube->getVideoFeed($query);

        foreach ($videoFeed as $videoEntry) {
            $this->youtubeTable->addVideo($videoEntry);
        }
    }
    
    /**
     * Search possible tutorial
     */
    public function tutorielAction()
    {
        
    }
    
    public function setLucene(Index $lucene)
    {
        $this->lucene = $lucene;
        return $this;
    }
    
    public function setTweetService(TweetService $tweetService)
    {
        $this->tweetService = $tweetService;
        return $this;
    }
    
    public function setTutorielTable(TutorielTable $tutorielTable)
    {
        $this->tutorielTable = $tutorielTable;
        return $this;
    }

    public function setSlideshareService(SlideshareService $slideshareService)
    {
        $this->slideshareService = $slideshareService;
        return $this;
    }
    
    public function setYoutubeTable(YoutubeTable $youtubeTable)
    {
        $this->youtubeTable = $youtubeTable;
        return $this;
    }
        
    public function setZfbTwitterOptions(ZFBTwitterOptions $zfbTwitterOptions)
    {
        $this->zfbTwitterOptions = $zfbTwitterOptions;
        return $this;
    }
    
    public function setSlideshare(Slideshare $slideshare)
    {
        $this->slideshare = $slideshare;
        return $this;
    }
}
