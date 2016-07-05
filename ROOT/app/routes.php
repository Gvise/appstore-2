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
	View::render('index', [
        'row' => 'hihi'
    ]);
}, 'indexPage');

App::map('GET','greet/[i:name]', 'Ctrl1@greet');
