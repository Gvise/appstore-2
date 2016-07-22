<?php
session('user', [
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

get('admin', 'Pages@getAdmin');
get('admin/notify', 'Pages@getAdminNotify');

post('myapps/statistics/filter', 'Tasks@filterStatistics');
get('notifications/clear', 'Tasks@clearNotifications');

get('join','Auth@getJoin');
get('recover', 'Auth@getRecover');
post('recover', 'Auth@postRecover');
get('logout', 'Auth@getLogout');

post('login', 'Auth@postLogin');
post('register', 'Auth@postRegister');

get('dbExamples',function() {
    // DB Class Usage
    // DB::query(param1, param2, param3);
    // param = parameter

    // param1 is sql query/statement such as "select * from table", "insert into table" etc..
    // param2 is databinding. You must use param2 when you use "where" statement see example 2.
    // param3 is callback. You may use parameter 3 only when you use "insert" operations.
    // you must pass a closure/function to parameter3 with 2 parameter. see example 3

    // Database Select Query Example
    // Eg 1 - Select from table 1.
	// $results = DB::query('select * from table1');

    // Eg 2 - Select from table 1 with id = 1 and name = chan.
    // First "?" represent 1 in parameter 2 array.
    // Second "?" represent 'chan' in parameter 2 array.
	// $results = DB::query('select * from table1 where id=? and name= ?', [1, 'chan']);

    // Database Insert Query Example
    // Eg 1 - Insert to table 1, values are id = 10 and name = chcnch
	// DB::query('insert into table1(id, name) values(?,?)',[10,'chcnch'], function($rowCount, $stmt) {
	// 	var_dump($rowCount);
	// });

    // $rowCount is number of rows affected. if $rowCount is 0 or null, the query is fail otherwise pass. $stmt is query statement for future uses.


    // session($key, $value)
    // when you access session variables
    // you must use session() function

    // parameter1 is key to your session variable
    // parameter2 is value to your session variable
    // if you use session() without parameter2 you are getting value of session variable with associated key.
    // if you use session() with parameter2 you are setting value of session variable with associated key.
    // if you use session() with parameter2 = null you are deleting value of session variable with associated key.

    // cookie is the same as session
    // cookie($key, $value);
});
