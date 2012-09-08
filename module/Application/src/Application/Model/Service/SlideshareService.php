<?php

namespace Application\Model\Service;

use Application\Model\SlideshareTable,
    Application\Model\LanguageTable,
    Zend\Service\SlideShare\SlideShow;

class SlideshareService
{
    /**
     * @var Application\Model\SlideshareTable
     */
    protected $slideshareTable;
    
    /**
     * @var Application\Model\LanguageTable
     */
    protected $languageTable;
    
    /*
     * Add a tweet object
     */
    public function addSlideshow(SlideShow $slideShow)
    {   
        $row = $this->slideshareTable->fetchRow(array('url'=>$slideShow->getLocation()));
        if($row) return;
        
        $row = $this->languageTable->fetchRow(array('code'=>$slideShow->getLanguage()));
        if(!$row) return;
        $lang = $row->id;
        
        $date = new \DateTime($slideShow->getCreated());
        $data = array(
            'title'  => $slideShow->getTitle(),
            'description'  => $slideShow->getDescription(),
            'url' => $slideShow->getLocation(),
            'thumbnail' => $slideShow->getThumbnailSmallUrl(),
            'date' => $date->format('Y-m-d H:i:s'),
            'language' => $lang,
            'moderate' => 1,
            'moderated' => 0,
        );
        $this->slideshareTable->insert($data);
    }
    
    public function setSlideshareTable(SlideshareTable $slideshareTable)
    {
        $this->slideshareTable = $slideshareTable;
        return $this;
    }
    
    public function setLanguageTable(LanguageTable $languageTable)
    {
        $this->languageTable = $languageTable;
        return $this;
    }
}