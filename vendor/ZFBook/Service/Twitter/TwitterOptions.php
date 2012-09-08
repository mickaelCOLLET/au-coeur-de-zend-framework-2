<?php

namespace ZFBook\Service\Twitter;

use Zend\Stdlib\Options;

class TwitterOptions extends Options
{
    protected $queries = array();
    
    protected $languages = array();
    
    public function getQueries()
    {
        return $this->queries;
    }
    
    public function setQueries($queries)
    {
        $this->queries = $queries;
    }
    
	public function getLanguages()
    {
        return $this->languages;
    }
    
    public function setLanguages($languages)
    {
        $this->languages = $languages;
    }
}
