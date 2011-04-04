<?php

class Utilities
{
    public static function underscoreToCamelCase($string)
    {
        $inflector = new Zend_Filter_Inflector(':string');
        $inflector->setRules(array(':string' => 'Word_UnderscoreToCamelCase'));
        return $inflector->filter(array('string' => $string));
    }
}

