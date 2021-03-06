<?php

/*
 * This file is part of the ZFMLL package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace ZFMLL\ModuleManager\Listener\Server;

use ZFMLL\ModuleManager\Listener\AbstractListener;

class DomainListener extends AbstractListener
{
    /**
     * 
     * @param string $moduleName
     * @return boolean 
     */
    public function authorizeModule($moduleName)
    {
    	$hostname = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : @$_SERVER['HTTP_HOST'];
        return $hostname === $this->config;
    }
}
