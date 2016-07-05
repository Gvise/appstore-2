<?php
//	App::map(method, url, method, name);
//  eg url - /[:name]/[i:age]
//	'i'  => '[0-9]++',
//	'a'  => '[0-9A-Za-z]++',
//	'h'  => '[0-9A-Fa-f]++',
//	'*'  => '.+?',
//	'**' => '.++',
//	''   => '[^/\.]++'

App::map('GET', 'index', function() {
	$rows = DB::raw('select * from table1');
	// DB::raw('insert into table1(name) values(?)', ['ch'], function($count, $stmt) {
	// 	if($count) {
	// 		echo 'Success';
	// 	} else {
	// 		echo 'Failure';
	// 	}
	// });
	View::render('index', [
        'rows' => $rows
    ]);
}, 'indexPage');

App::map('GET','greet/[i:name]', 'Ctrl1@greet');
