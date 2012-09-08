<?php

namespace Cron\Controller;

use Zend\Mvc\Controller\ActionController;
use Zend\Mvc\MvcEvent;
use Zend\Stdlib\ResponseInterface as Response;
use Zend\Stdlib\RequestInterface as Request;

class AbstractController extends ActionController
{
    /**
     * Dispatch short circuit
     * @param Request $request
     * @param Response $response
     * @return type 
     */
    public function dispatch(Request $request, Response $response = null)
    {
        $this->events()->attach(MvcEvent::EVENT_DISPATCH, array($this, 'postDispatch'), -1000);
        return parent::dispatch($request, $response);
    }
    
    /**
     * Post dispatch to remove view and layout
     * @param MvcEvent $e
     * @return type 
     */
    public function postDispatch(MvcEvent $e)
    {   
        return $this->response;
    }
}
