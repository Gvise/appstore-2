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
	$table = Config::get('db.table');
	$rows = DB::raw("select * from $table where id = ? and name = ?", [3,'chan']);
	print_r($rows);
}, 'select');

App::map('GET', 'insert/[:name]', 'DBController@insert', 'insert');
App::map('GET', 'request' , function() {

});

App::map('GET', 'user', function() {
	View::render('user');
});

App::map('POST', 'user', function() {
	echo $_POST['name'];
	echo "<br>";
	echo $_POST['age'];
});
