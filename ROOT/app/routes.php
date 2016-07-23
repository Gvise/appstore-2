<?php
session('user', [
	'id' => 1,
	'name' => 'chan',
	'type' => 3
]);

//Block Pages
{
	get('/', 'Pages@getIndex');
	get('home', 'Pages@getHome');
	get('newreleases','Pages@getNewReleases');
	get('search', 'Pages@getSearch');
	get('wishlist', 'Pages@getWishlist');
	get('categories/[:id]', 'Pages@getCategories');

	get('popular/apps', 'Pages@getPopularApps');
	get('popular/games', 'Pages@getPopularGames');

	get('user', 'Pages@getUser');
	post('user', 'Pages@postUser');
	post('user/password', 'Pages@postUserPassword');

	get('deposit', 'Pages@getDeposit');
	post('deposit', 'Pages@postDeposit');

	get('withdraw', 'Pages@getWithdraw');
	post('withdraw', 'Pages@postWithdraw');

	get('logs', 'Pages@getLogs');
}

// Block MyApps
{
	get('myapps', 'MyApps@getPurchased');
	get('myapps/purchased', 'MyApps@getPurchased');
	get('myapps/published', 'MyApps@getPublished');
	get('myapps/inappropirate', 'MyApps@getInapp');
	get('myapps/statistics', 'MyApps@getStatsToday');
	get('myapps/statistics/today', 'MyApps@getStatsToday');
	get('myapps/statistics/week', 'MyApps@getStatsThisWeek');
	get('myapps/statistics/month', 'MyApps@getStatsThisMonth');
	get('myapp/publish', 'MyApps@getPublish');
}

// Block Admin
{
	get('admin', 'Admin@getUsers');
	get('admin/cateplat', 'Admin@getCatePlat');
	get('admin/transitions', 'Admin@getTransitions');
	get('admin/transitionreports', 'Admin@getTransitonReports');
	get('admin/inappropirate', 'Admin@getInappropirate');
	get('admin/notify', 'Admin@getNotify');
}

//Block Tasks
{
	post('admin/addcategory', 'Tasks@postAdminAddCategory');
	get('admin/delcategory/[:id]', 'Tasks@getAdminDelCategory');
	post('admin/addplatform', 'Tasks@postAdminAddPlatform');
	get('admin/delplatform/[:id]', 'Tasks@getAdminDelPlatform');

	post('myapps/statistics/filter', 'Tasks@filterStatistics');
	get('notifications/clear', 'Tasks@clearNotifications');
}

//Block Auth
{
	get('join','Auth@getJoin');
	get('recover', 'Auth@getRecover');
	post('recover', 'Auth@postRecover');
	get('logout', 'Auth@getLogout');

	post('login', 'Auth@postLogin');
	post('register', 'Auth@postRegister');
}
