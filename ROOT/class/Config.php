<?php
class Config {
    private static $config;

    public static function load($config) {
        Config::$config = $config;
    }

    public static function get($key) {
        $keys = explode('.',$key);
        if(count($keys) == 1)
            return isset(Config::$config[$key]) ? Config::$config[$key] : null;
        else if(count($keys) == 2) {
            return isset(Config::$config[$keys[0]][$keys[1]]) ? Config::$config[$keys[0]][$keys[1]] : null;
        }

        return null;
    }
}
