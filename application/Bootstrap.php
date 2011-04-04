<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected $_appNamespace = '';

    // resources are bootstrapped in order, so be sure dependencies for
    // resources are listed first. you can explicitly bootstrap a resource by 
    // calling $this->bootstrap('resource').

    protected function _initAutoload()
    {
        $autoloader = Zend_Loader_Autoloader::getInstance();
        // enable classic PEAR-like class autoloading
        $autoloader->setFallbackAutoloader(true);
    }

    protected function _initConfig()
    {
        $config = new Zend_Config($this->getOptions());
        Zend_Registry::set('config', $config);
        return $config;
    }

    protected function _initFrontController()
    {
        $front = Zend_Controller_Front::getInstance();
        $front->setDefaultModule('public');
        $front->setControllerDirectory(APPLICATION_PATH . '/controllers');
        $front->addModuleDirectory(APPLICATION_PATH . '/modules');
        $front->setParam('prefixDefaultModule', true);
        return $front;
    }

    protected function _initLayout()
    {
        $layout = Zend_Layout::startMvc();
        $layout->setLayoutPath(APPLICATION_PATH . '/layouts/scripts/');
        return $layout;
    }

    protected function _initView()
    {
        // create view here if you need to change default options, but front
        // controller will create view automatically.
    }

    protected function _initLog()
    {
        $logger = new Logger;
        Zend_Registry::set('logger', $logger);
        return $logger;
    }

    protected function _initErrors()
    {
        $errors = new Errors;
        return $errors;
    }

    protected function _initHelpers()
    {
        // place view helpers in library/Helpers
        $view = $this->getResource('layout')->getView();
        $view->addHelperPath(dirname(APPLICATION_PATH) . '/library/Helpers', 'Helper');

        // place action helpers in library/Helpers
        Zend_Controller_Action_HelperBroker::addPath(
                dirname(APPLICATION_PATH) . '/library/Helpers', 'Helper');
    }

    protected function _initPlugins()
    {
        $front = $this->getResource('frontcontroller');

        // place plugins in library/Plugins
        $front->registerPlugin(new Plugins_Noop);
    }

    protected function _initRoutes()
    {
        $front = $this->getResource('frontcontroller');
        $router = $front->getRouter();

        // define routes in library/Routes.php
        new Routes($router);
    }
}

