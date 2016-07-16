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
	App::redirect('home');
});

App::map('GET', 'home', function() {
	// sidebar
	$title = Config::get('title');
	$subtitle = 'Home';
	$categories = ['a','b','c'];
	$categoryGames = ['a','b','c'];

	// navbar
	$user = [
		'id' => 1,
		'name' => 'chan',
		'type' => 1
	];

	$notifications = [];
	$selectHome = 'custom-active';

	$apps = [
		'category' => [
			'url' => '',
			'appcount' => 2,
			'apps' => [
				[
					'name' => 'Warlings',
					'icon' => 'warlings.webp',
					'stars' => 5,
					'price' => 0,
					'url' => ''
				],
				[
					'name' => 'Instagram',
					'icon' => 'instagram.webp',
					'stars' => 4,
					'price' => 1000,
					'url' => ''
				]
			]
		],
		'category1' => [
			'url' => '',
			'appcount' => 2,
			'apps' => [
				[
					'name' => 'Warlisdfngs',
					'icon' => 'warlings.webp',
					'stars' => 5,
					'price' => 0,
					'url' => ''
				],
				[
					'name' => 'df',
					'icon' => 'instagram.webp',
					'stars' => 4,
					'price' => 1000,
					'url' => ''
				]
			]
		]
	];

	View::render('home', compact(
		'title', 'subtitle','categories', 'categoryGames',
		'user', 'notifications', 'selectHome',
		'apps'
	));
});
App::map('GET', 'join', function() { //Log In Error တက်ရင် loginOnly => 1 နဲ့ Redirect လုပ်ပေး
	$title = Config::get('title');
	$subtitle = 'Join';
	View::render('join', compact(
		'title', 'subtitle'
	));
});

App::map('GET', 'recover', function() {
	$title = Config::get('title');
	$subtitle = 'Recover';
	View::render('recover', compact(
		'title', 'subtitle'
	));
});
