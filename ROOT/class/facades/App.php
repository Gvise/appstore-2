<?php
class App {
    protected static $instance;
    public static function __callStatic($method, $args)
    {
        return call_user_func_array(array(static::$instance, $method), $args);
    }

    public static function setInstance($instance)
    {
        static::$instance = $instance;
    }

    public static function redirect($url, array $with = array()) {
        if($url == '') return;
        header('Location: '. $url);
        foreach ($with as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }

    public static function cookie($key, $val = '`') {
        if($val == null) {
            unset($_COOKIE[$key]);
        }
        if($val == '`')
            return isset($_COOKIE[$key]) ? $_COOKIE[$key] : null;
        $_COOKIE[$key] = $val;
    }

    public static function session($key, $val = '') {
        if($val == null) {
            unset($_SESSION[$key]);
        }
        if($val == '`')
            return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
        $_SESSION[$key] = $val;
    }

    public static function with($key) {
        if(static::session($key)) {
			$val = $_SESSION[$key];
			unset($_SESSION[$key]);
			return $val;
		}
    }
}
