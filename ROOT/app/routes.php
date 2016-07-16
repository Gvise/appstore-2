<?php
function Load($subtitle, $page) {
	// sidebar
	$title = Config::get('title');
	$subtitle = $subtitle;
	$categories = ['a','b','c'];
	$categoryGames = ['a','b','c'];

	// navbar
	$notifications = ['adsfsdfasdf'];

	if($page == 'home') {
		$selectHome = 'custom-active';
	} else if($page == 'newreleases') {
		$selectNewReleases = 'custom-active';
	} else {
		$currentPage = $page;
	}

	return compact('title', 'subtitle', 'categories', 'categoryGames', 'notifications', 'selectHome', 'selectNewReleases', 'currentPage');
}

App::session('user', [
	'id' => 1,
	'name' => 'chan',
	'type' => 1
]);

App::map('GET', '/', 'Pages@getIndex');
App::map('GET', 'home', 'Pages@getHome');
App::map('GET', 'newreleases','Pages@getNewReleases');
App::map('GET', 'search', 'Pages@getSearch');
App::map('GET', 'categories/[:id]', 'Pages@getCategories');

App::map('GET', 'popular/apps', 'Pages@getPopularApps');
App::map('GET', 'popular/games', 'Pages@getPopularGames');

App::map('GET', 'myapps', 'Pages@getMyAppsPurchased');
App::map('GET', 'myapps/purchased', 'Pages@getMyAppsPurchased');
App::map('GET', 'myapps/published', 'Pages@getMyAppsPublished');

App::map('GET', 'notifications/clear', 'Tasks@clearNotifications');

App::map('GET', 'join','Auth@getJoin');
App::map('GET', 'recover', 'Auth@getRecover');
App::map('POST', 'recover', 'Auth@postRecover');
App::map('GET', 'logout', 'Auth@getLogout');

App::map('POST', 'login', 'Auth@postLogin');
App::map('POST', 'register', 'Auth@postRegister');
