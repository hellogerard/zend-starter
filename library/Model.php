<?php

class Model
{
    protected $_row;

    public function __set($name, $value)
    {
        $method = 'set' . Utilities::underscoreToCamelCase($name);
        if (method_exists($this, $method))
        {
            $this->$method($value);
        }
        else
        {
            $this->_row->__set($name, $value);
        }
    }

    public function __get($name)
    {
        $method = 'get' . Utilities::underscoreToCamelCase($name);
        if (method_exists($this, $method))
        {
            return $this->$method();
        }
        else
        {
            return $this->_row->__get($name);
        }
    }

    public function __call($name, $args)
    {
        if (method_exists($this, $name))
        {
            return call_user_func_array(array($this, $name), $args);
        }
        else
        {
            return call_user_func_array(array($this->_row, $name), $args);
        }
    }

    public function init()
    {
    }

    public function __construct()
    {
        $model = get_class($this);
        $model = str_replace('Model_', '', $model);
        $class = "Model_DbTable_{$model}";
        $table = new $class;

        if (func_num_args())
        {
            // existing row
            $keys = func_get_args();
            $rows = call_user_func_array(array($table, 'find'), $keys);

            if (! $rows->count())
            {
                throw new Exception("$model not found");
            }

            $this->_row = $rows->current();
        }
        else
        {
            // new row
            $row = $table->createRow();
            $row->created_dt_tm = date('Y-m-d H:i:s');
            $this->_row = $row;
        }

        $this->init();
    }

    public function save()
    {
        $this->_row->save();
    }
}


