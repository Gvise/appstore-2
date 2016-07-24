<?php
class Request {
    public static function inputs($key = null) {
        if($key == null)
            return $_REQUEST;
        if(isset($_REQUEST[$key])) return $_REQUEST[$key];
        return null;
    }

    public static function required($requiredKeys = array()) {
        $error = [];
        foreach ($requiredKeys as $value) {
            if(static::inputs($value) == "") {
                $error[] = $value . ' required !';
            }
        }

        return $error;
    }
}
