<?php
class QB {
    public static function table($table) {
        return new Query($table);
    }
}
