<?php
App::session('user', [
	'id' => 1,
	'name' => 'chan',
	'type' => 3
]);

get('/', 'Pages@getIndex');
get('home', 'Pages@getHome');
get('newreleases','Pages@getNewReleases');
get('search', 'Pages@getSearch');
get('wishlist', 'Pages@getWishlist');
get('categories/[:id]', 'Pages@getCategories');

get('popular/apps', 'Pages@getPopularApps');
get('popular/games', 'Pages@getPopularGames');

get('myapps', 'Pages@getMyAppsPurchased');
get('myapps/purchased', 'Pages@getMyAppsPurchased');
get('myapps/published', 'Pages@getMyAppsPublished');
get('myapps/inappropirate', 'Pages@getMyAppsInapp');
get('myapps/statistics', 'Pages@getMyAppsStatsToday');
get('myapps/statistics/today', 'Pages@getMyAppsStatsToday');
get('myapps/statistics/week', 'Pages@getMyAppsStatsThisWeek');
get('myapps/statistics/month', 'Pages@getMyAppsStatsThisMonth');

get('user', 'Pages@getUser');
post('user', 'Pages@postUser');
post('user/password', 'Pages@postUserPassword');

get('deposit', 'Pages@getDeposit');
post('deposit', 'Pages@postDeposit');

get('withdraw', 'Pages@getWithdraw');
post('withdraw', 'Pages@postWithdraw');

get('logs', 'Pages@getLogs');

post('myapps/statistics/filter', 'Tasks@filterStatistics');
get('notifications/clear', 'Tasks@clearNotifications');

get('join','Auth@getJoin');
get('recover', 'Auth@getRecover');
post('recover', 'Auth@postRecover');
get('logout', 'Auth@getLogout');

post('login', 'Auth@postLogin');
post('register', 'Auth@postRegister');
