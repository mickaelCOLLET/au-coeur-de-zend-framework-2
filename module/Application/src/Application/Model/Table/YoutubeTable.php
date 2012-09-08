<?php

namespace Application\Model\Table;

use Zend\GData\YouTube\VideoEntry;

class YoutubeTable extends AbstractTable
{    
    public function addVideo(VideoEntry $video)
    {
        $data = array(
            'title'  => $video->getVideoTitle(),
            'description'  => $video->getVideoDescription(),
            'url' => $video->getLocation(),
            'date' => $video->getRecorded(),
        );
        $this->insert($data);
    }
    
    public function fetchAllLastValid($lang='fr', $limit=10)
    {
        $select = $this->select()
                        ->join('language','language.id = tweet.language')
                        ->where(array('moderate'=>1))
                        ->where(array('language.code'=>$lang))
                        ->order('date DESC');
        $select->limit($limit)->offset(0);
        
        return $this->selectWith($select);
    }
}