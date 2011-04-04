<?php

class Plugins_Noop extends Zend_Controller_Plugin_Abstract
{
    public function routeStartup(Zend_Controller_Request_Abstract $request)
    {
    }

    public function routeShutdown(Zend_Controller_Request_Abstract $request)
    {
    }

    public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request)
    {
    }

    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
    }

    public function postDispatch(Zend_Controller_Request_Abstract $request)
    {
    }

    public function dispatchLoopShutdown()
    {
    }
}

