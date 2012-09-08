<?php

namespace Application\Model\Table;

class FacebookTable extends AbstractTable
{    
    public function fetchAll($lang='fr', $limit=10)
    {
        $select = $this->select();
        $select->limit($limit)->offset(0);
        
        return $this->selectWith($select);
    }
}