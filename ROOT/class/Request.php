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

        $errorObj = new stdClass();
        $errorObj->hasError = false;
        $errorObj->content = $error;
        if (count($error) > 0)
            $errorObj->hasError = true;

        return $errorObj;
    }

    public static function filesRequired($requiredKeys = array()) {
        $error = [];
        foreach ($requiredKeys as $key => $value) {
            if (!is_array($_FILES[$value]['name']) && $_FILES[$value]['name'] == "") {
                $error[] = $value . ' required !';
            } elseif((is_array($_FILES[$value]['name']) && $_FILES[$value]['name'][0] == "")) {
                $error[] = $value . ' required !';
            }
        }

        $errorObj = new stdClass();
        $errorObj->hasError = false;
        $errorObj->content = $error;
        if (count($error) > 0)
            $errorObj->hasError = true;

        return $errorObj;
    }
}
