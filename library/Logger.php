<?php

class Logger extends Zend_Log
{
    public function __construct()
    {
        parent::__construct();

        // if debug on, log DEBUG messages, else use INFO as default
        $debug = (bool) Zend_Registry::get('config')->app->debug->enabled;
        $loglevel = ($debug || $_GET['debug']) ? parent::DEBUG : parent::INFO;

        $project = dirname(APPLICATION_PATH);
        $logfile = "$project/data/logs/" . basename($project) . '.log';
        ini_set('error_log', $logfile);

        $this->addWriter(new Zend_Log_Writer_Stream($logfile));
        $this->addFilter(new Zend_Log_Filter_Priority($loglevel));
    }
}

