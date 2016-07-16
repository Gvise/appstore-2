<?php
class Request {
    public static function inputs($key = null) {
        if($key == null)
            return $_SERVE['REQUET_METHOD'] == 'GET' ? $_GET : $_POST;
        if(isset($_GET[$key])) return $_GET[$key];
        if(isset($_POST[$key])) return $_POST[$key];
        return null;
    }
}
