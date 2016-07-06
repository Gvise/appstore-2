<?php
class DBController {
    public function insert($name) {
    	$table = Config::get('db.table');
    	DB::raw("insert into $table (name) values(?)", [$name], function($count, $stmt) {
    		if($count) {
    			echo 'Successful!';
    		}
    		else {
    			echo 'Failure';
    		}
    	});
    }
}
