<?php

namespace Application\Model\Service;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AbstractService implements ServiceLocatorAwareInterface
{
    protected $serviceLocator;
    
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }
    
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }
}