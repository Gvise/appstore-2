<?php
class Request {
    public static function get($key = null) {
        if($key == null)
            return $_SERVE['REQUET_METHOD'] == 'GET' ? $_GET : $_POST;
        return isset($_GET[$key]) ? $_GET[$key] : isset($_POST[$key]) ? $_POST[$key] : null;
    }
}
