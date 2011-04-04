<?php

class ErrorController extends Zend_Controller_Action
{
    public function errorAction()
    {
        $error = $this->_getParam('error_handler');
        $logger = Zend_Registry::get('logger');

        switch ($error->type)
        {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:

                // Zend MVC exceptions
                $this->getResponse()->setHttpResponseCode(404);
                $this->view->message = 'Sorry, this page does not exist.';

                if (APPLICATION_ENV == 'production')
                {
                    $logger->info($error->exception->getMessage());
                }

                break;

            default:

                // application exceptions
                if ($this->getResponse()->getHttpResponseCode() == 200)
                {
                    // if response error code is not set, use 500 Internal Error
                    $this->getResponse()->setHttpResponseCode(500);
                }

                $this->view->message = "Oh no! Something's wrong!";

                if (APPLICATION_ENV == 'production')
                {
                    $message = $error->exception->getMessage() . "\n" . print_r($error->exception->getTrace(), true);
                    $logger->err($message);
                }

                break;
        }

        if (APPLICATION_ENV != 'production')
        {
            // if not production, show exception and request info in browser
            $this->view->exception = $error->exception;
            $this->view->request = $error->request;
        }
    }
}

