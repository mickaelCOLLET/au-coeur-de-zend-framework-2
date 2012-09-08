<?php

namespace Application\Model\Table;

class DeveloperTable extends AbstractTable
{   
    public function fetchAllValid()
    {
        $select = $this->select()
                    ->where(array('valid' => 1));
        
        return $this->selectWith($select);
    }
    
    public function fetchAllInWait()
    {
        $select = $this->select()
                    ->where(array('valid' => 0));
        
        return $this->selectWith($select);
    }
    
    public function register($datas)
    {
        $data = array(
            'name' => $datas['name'],
            'email'  => $datas['email'],
            'is_php_5_certified'  => (boolean)$datas['php5certification'],
            'is_php_53_certified'  => (boolean)$datas['php53certification'],
            'is_php_zf1_certified'  => (boolean)$datas['zf1certification'],
            'viadeo'  => $datas['viadeolink'],
            'linkedin'  => $datas['linkedinlink'],
            'twitter'  => $datas['twitterlink'],
            'valid'  => 0,
        );
        return $this->insert($data);
    }
}