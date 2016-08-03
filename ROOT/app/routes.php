<?php
get('/zz', function() {
	try {
		echo $foo;
	} catch (Exception $e) {
		echo 'df';
		echo $e->getMessage();
	}

});
//Block Pages
{
	get('/', 'Pages@getIndex');
	get('home', 'Pages@getHome');
	get('changeplatform/[:id]', 'Pages@getChangePlatform');
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
	get('logs/report/[:id]', 'Pages@reportLog');
}

// Block MyApps
{
	get('myapps', 'MyApps@getPurchased');
	get('myapps/delete/[:id]', 'MyApps@getDelete');
	get('myapps/purchased', 'MyApps@getPurchased');
	get('myapps/published', 'MyApps@getPublished');
	get('myapps/inappropirate', 'MyApps@getInapp');
	get('myapps/statistics', 'MyApps@getStatsToday');
	get('myapps/statistics/today', 'MyApps@getStatsToday');
	get('myapps/statistics/week', 'MyApps@getStatsThisWeek');
	get('myapps/statistics/month', 'MyApps@getStatsThisMonth');
	get('myapps/publish', 'MyApps@getPublish');
	post('myapps/publish', 'MyApps@postPublish');
}

//block app
{

}

// Block Admin
{
	get('admin', 'Admin@getUsers');
	get('admin/cateplat', 'Admin@getCatePlat');
	get('admin/transitions', 'Admin@getTransitions');
	get('admin/transitions/confirm/[:id]', 'Admin@getConfirmTransition');
	get('admin/transitions/delete/[:id]', 'Admin@getDeleteTransition');
	get('admin/transitions/deleteall/[:type]', 'Admin@getDeleteAllTransition');
	get('admin/transitionreports', 'Admin@getTransitonReports');
	get('admin/inappropirate', 'Admin@getInappropirate');
	get('admin/inappropirate/delete/[:ids]', 'Admin@getInappropirateDelete');
	get('admin/inappropirate', 'Admin@postInappropirate');
	get('admin/notify', 'Admin@getNotify');
	get('admin/warn/[:appId]/[:content]', 'Admin@getWarnToOwner');

	get('app/delete/[:id]', 'Admin@getAppDelete');
	get('user/delete/[:id]', 'Admin@getUserDelete');
}

//Block Tasks
{
	post('admin/addcategory', 'Tasks@postAdminAddCategory');
	get('admin/delcategory/[:id]', 'Tasks@getAdminDelCategory');
	post('admin/addplatform', 'Tasks@postAdminAddPlatform');
	get('admin/delplatform/[:id]', 'Tasks@getAdminDelPlatform');

	post('notification/send', 'Tasks@postNotificationSend');
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
