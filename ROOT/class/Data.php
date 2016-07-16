<?php
class Data {
    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function get($key) {
        if(isset($this->data[$key]) && is_string($this->data[$key])) {
            return isset($this->data[$key]) ? htmlspecialchars(urldecode($this->data[$key])) : '';
        }
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    public function nget($key) {
        if(isset($this->data[$key]) && is_string($this->data[$key])) {
            return isset($this->data[$key]) ? urldecode($this->data[$key]) : '';
        }
        return isset($this->data[$key]) ? $this->data[$key] : null;
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
