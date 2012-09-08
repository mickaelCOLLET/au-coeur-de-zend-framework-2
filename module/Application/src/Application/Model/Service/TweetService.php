<?php

namespace Application\Model\Service;

use Zend\Validator\ValidatorChain;
use Zend\Validator\Regex;

class TweetService implements AbstractService
{
    protected $invalidChain;
    
    /*
     * Add a tweet object
     */
    public function addTweet(array $tweet)
    {   
        $sm = $this->getServiceLocator();
        $row = $sm->get('TweetModel')->fetchRow(array('id' => $tweet['id_str']));
        if($row) {
            return;
        }
        
        $row = $sm->get('LanguageModel')->fetchRow(array('code' => $tweet['iso_language_code']));
        if(!$row) {
            return;
        }
        $lang = $row->id;
        
        if($this->getInvalidatorChain()->isValid($tweet['text'])) {
            $moderate = 0;
        } else {
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
        $sm->get('TweetModel')->insert($data);
    }
    
    public function getInvalidatorChain()
    {
        if(!$this->invalidChain) {
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