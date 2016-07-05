<?php
class Data {
    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function get($key) {
        return isset($this->data[$key]) ? htmlspecialchars(urldecode($this->data[$key])) : '';
    }

    public function nget($key) {
        return isset($this->data[$key]) ? urldecode($this->data[$key]) : '';
    }

    public function set($key, $value = '') {
        if(isset($this->data[$key]))
            $this->data[$key] = $value;
    }

    public function remove($key) {
        if(isset($this->data[$key]))
            unset($this->data[$key]);
    }
}
