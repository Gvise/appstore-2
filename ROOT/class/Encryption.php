<?php
class Encryption {
    public static function hash($string, $salt = '') {
        $salt = $salt == '' ? '' : base64_encode($salt);
        return md5($salt.$string);
    }

    private static function safe_b64encode($string) {
        $data = base64_encode($string);
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
        return $data;
    }

    private static function safe_b64decode($string) {
        $data = str_replace(array('-','_'),array('+','/'),$string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }

    public static function make($string, $key){
        if(!$string){return false;}
        $result = '';
        for($i = 0; $i < strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key))-1, 1);
            $char = chr(ord($char) + ord($keychar));
            $result .= $char;
        }

        return trim(static::safe_b64encode($result));
    }

    public static function decrypt($string, $key){
        if(!$string){return false;}
        $result = '';
        $string = static::safe_b64decode($string);

        for($i = 0; $i < strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key))-1, 1);
            $char = chr(ord($char) - ord($keychar));
            $result .= $char;
        }

        return $result;
    }
}
