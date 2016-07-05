<?php
class App {
    protected static $instance;
    public static function __callStatic($method, $args)
    {
        if (!static::$instance) {
            static::$instance = new Framework\Application();
        }
        return call_user_func_array(array(static::$instance, $method), $args);
    }

    public static function setInstance($instance)
    {
        static::$instance = $instance;
    }
}
