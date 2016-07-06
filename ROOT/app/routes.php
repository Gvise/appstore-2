<?php
//	App::map(method, url, method, name);
//  eg url - /[:name]/[i:age]
//	'i'  => '[0-9]++',
//	'a'  => '[0-9A-Za-z]++',
//	'h'  => '[0-9A-Fa-f]++',
//	'*'  => '.+?',
//	'**' => '.++',
//	''   => '[^/\.]++'

App::map('GET', 'select', function() {
	$rows = DB::raw('select * from '. Config::get('db.table'));
	print_r($rows);
}, 'get');

App::map('GET', 'insert/[:name]', function($name) {
	DB::raw('insert into ' . Config::get('db.table') . '(name) values(?)', [$name], function($count, $stmt) {
		if($count) {
			echo 'Successful!';
		}
		else {
			echo 'Failure';
		}
	});
});
