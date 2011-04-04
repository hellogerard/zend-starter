<?php

class PHPException extends Exception
{
    // take info from the error to populate the exception
    public function __construct($type, $message, $file, $line)
    {
        $this->file = $file;
        $this->line = $line;

        parent::__construct($message, $type);
    }
}

class Errors
{
    public function __construct()
    {
        // override the PHP error handler (this means php.ini settings
        // 'display_errors' and 'log_errors' are ignored)
        set_error_handler(array($this, 'php'), error_reporting());
    }

    public function php($type, $message, $file, $line)
    {
        // convert all errors into exceptions. if the "@" operator is used,
        // error_reporting() == 0.
        if (error_reporting())
        {
            throw new PHPException($type, $message, $file, $line);
        }
    }
}

