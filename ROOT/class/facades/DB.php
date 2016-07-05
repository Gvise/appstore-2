<?php
class DB {
    protected static $instance;
    public static function __callStatic($method, $args)
    {
        return call_user_func_array(array(static::$instance, $method), $args);
    }

    public static function setInstance($instance)
    {
        static::$instance = $instance;
    }
}
