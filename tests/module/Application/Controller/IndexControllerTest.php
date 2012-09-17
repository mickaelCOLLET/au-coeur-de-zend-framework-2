<?php

namespace ModuleTest\Application\Controller;

use ZFUT\Test\PHPUnit\Controller\AbstractControllerTestCase;

class IndexControllerTest extends AbstractControllerTestCase
{    
    public function setUp()
    {
        AbstractControllerTestCase::setApplicationConfig(include __DIR__ . '/../../../../config/application.config.php');
        parent::setUp();
    }
    
    public function testCanDisplayIndex()
    {
        $this->dispatch('/');
        $this->assertResponseStatusCode(200);
        $this->assertActionName('index');
        $this->assertControllerName('application-index');
        $this->assertRouteMatchName('home');
    }
}
