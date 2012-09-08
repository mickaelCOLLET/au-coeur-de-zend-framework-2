<?php

namespace Application\Model\Table;

use Zend\Db\Sql\Predicate\Like;

class TweetTable extends AbstractTable
{   
    public function addTweet($id, $text, $user, $language)
    {
        $data = array(
            'id' => $id,
            'text'  => $text,
            'user'  => $user,
            'language' => $language,
            'moderate' => 0,
            'moderated' => 0
        );
        $this->insert($data);
    }
    
    public function fetchLastToPublished($lang='fr')
    {
        $select = $this->select()
                        ->columns(array('date','user','text'))
                        ->join('language','language.id = tweet.language')
                        ->where(array('moderate'=>1))
                        ->where(array('language.code'=>$lang))
                        ->order('date ASC');
        $select->limit(1)->offset(0);
        
        $rowset = $this->selectWith($select);
        if($rowset) {
            return $rowset->current();
        }
        return null;
    }
    
    public function fetchAllQueryLastValid()
    {
        $select = $this->select()
                        ->columns(array('date','user','text'))
                        ->join('language','language.id = tweet.language')
                        ->where(array('moderate'=>1))
                        ->order('date DESC');
        return $select;
    }
    
    public function fetchAllLastValid($limit = 10, $page = 1)
    {
        $select = $this->fetchAllQueryLastValid();
        $select->limit($limit)->offset($limit*(max($page,1)-1));
        
        return $this->selectWith($select);
    }
    
    public function fetchAllFilterBySearchAndLang($search, $lang = 'fr', $limit = 10)
    {
        $select = $this->select()
                        ->columns(array('date','user','text'))
                        ->join('language','language.id = tweet.language')
                        ->where(array('moderate'=>1))
                        ->where(array('language.code'=>$lang))
                        ->where(new Like('text','%'.$search.'%'))
                        ->order('date DESC');
        $select->limit($limit)->offset(0);
        
        return $this->selectWith($select);
    }
}