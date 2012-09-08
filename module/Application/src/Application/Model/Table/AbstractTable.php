<?php

namespace Application\Model\Table;

use Zend\Db\TableGateway\AbstractTableGateway,
    Zend\Db\Adapter\Adapter,
    Zend\Db\ResultSet\ResultSet,
    Zend\Db\Sql\Select;

class AbstractTable extends AbstractTableGateway
{
    public function __construct($adapter, $table = null)
    {
        if($table) {
            $this->table = $table;
        }
        $this->adapter = $adapter;
        $this->initialize();
    }
    
    public function select($where=null)
    {
        if(!$where) {   
            return $this->sql->select();
        }
        return parent::select($where);
    }
    
    public function fetchAll()
    {
        $select = $this->select();
        return $this->selectWith($select);
    }
    
    public function fetchRow($where)
    {   
        $rowset = $this->select($where);
        return $rowset->current();
    }
}