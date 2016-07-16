<?php
function url($url) {
    return App::url($url);
}

function assets($url) {
    return App::assets($url);
}

function with($key) {
    return App::with($key);
}

function session($key, $val = '`') {
    return App::session($key, $val);
}

function cookie($key, $val = '`') {
    return App::cookie($key, $val);
}

function redirect($url, array $with = array()) {
    return App::redirect($url, $with);
}

function render($view, array $raw = array()) {
    View::render($view,$raw);
}
