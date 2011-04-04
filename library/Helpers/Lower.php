<?php 

class Helper_Lower extends Zend_Controller_Action_Helper_Abstract
{
    public function direct($value)
    {
        return strtolower($value);
    }
}

