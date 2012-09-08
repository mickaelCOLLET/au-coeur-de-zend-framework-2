<?php

namespace Application\Model\Service;

use Application\Model\TweetTable,
    Application\Model\LanguageTable,
    Zend\Validator\ValidatorChain,
    Zend\Validator\Regex;

class TweetService
{
    /**
     * @var Application\Model\TweetTable
     */
    protected $tweetTable;
    
    /**
     * @var Application\Model\LanguageTable
     */
    protected $languageTable;
    
    protected $invalidChain;
    
    /*
     * Add a tweet object
     */
    public function addTweet(array $tweet)
    {   
        $row = $this->tweetTable->fetchRow(array('id'=>$tweet['id_str']));
        if($row) return;
        
        $row = $this->languageTable->fetchRow(array('code'=>$tweet['iso_language_code']));
        if(!$row) return;
        $lang = $row->id;
        
        if($this->getInvalidatorChain()->isValid($tweet['text']))
        {
            $moderate = 0;
        }
        else
        {
            $moderate = 1;
        }
        
        $date = new \DateTime($tweet['created_at']);
        $data = array(
            'id' => $tweet['id_str'],
            'date' => $date->format('Y-m-d H:i:s'),
            'text'  => $tweet['text'],
            'user'  => $tweet['from_user'],
            'language' => $lang,
            'moderate' => $moderate
        );
        $this->tweetTable->insert($data);
    }
    
    public function setTweetTable(TweetTable $tweetTable)
    {
        $this->tweetTable = $tweetTable;
        return $this;
    }
    
    public function setLanguageTable(LanguageTable $languageTable)
    {
        $this->languageTable = $languageTable;
        return $this;
    }
    
    public function getInvalidatorChain()
    {
        if(!$this->invalidChain)
        {
            $this->invalidChain = new ValidatorChain();
            $this->invalidChain->addValidator(new Regex("#(@|RT)#"));
        }
        return $this->invalidChain;
    }
    
    public function setInvalidatorChain(ValidatorChain $chain)
    {
        $this->invalidChain = $chain;
        return $this;
    }
}