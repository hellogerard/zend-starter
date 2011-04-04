<?php

class Helper_Upper extends Zend_View_Helper_Abstract
{
    public function Upper($value)
    {
        return strtoupper($value);
    }
}

