<?php
//	App::map(method, url, method, name);
//  eg url - /[:name]/[i:age]
//	'i'  => '[0-9]++',
//	'a'  => '[0-9A-Za-z]++',
//	'h'  => '[0-9A-Fa-f]++',
//	'*'  => '.+?',
//	'**' => '.++',
//	''   => '[^/\.]++'

App::map('GET', '/', function() {
	View::render('home');
});

App::map('GET', 'select', function() {
	$table = 'table1';
	$rows = DB::raw("select * from $table where id = ? and name = ?", [3,'chan']);
	print_r($rows);
}, 'select');

App::map('GET', 'insert/[:name]', 'DBController@insert', 'insert');
App::map('GET', 'encryption' , function() {
	echo Encryption::hash('chan', Config::get('security.salt')) . "<br>";
	$encrypted =  Encryption::make(json_encode(['a','b']), Config::get('security.enckey'));
	$decrypted =  Encryption::decrypt($encrypted, Config::get('security.enckey'));
	echo $encrypted . "<br>";
	echo $decrypted;
});

App::map('GET', 'user', function() {
	View::render('user');
});

App::map('POST', 'user', function() {
	echo $_POST['name'];
	echo "<br>";
	echo $_POST['age'];
});
