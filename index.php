<?php
session_start();
define('__ROOT__','./ROOT/' );
define('__APP__','./ROOT/app/');
define('__DEPENDENCIES__', './ROOT/dependencies/');

require __ROOT__.'Classloader.php';

Classloader::load(require __DEPENDENCIES__.'classmap.php');
Config::load(require __DEPENDENCIES__.'config.php');

App::setInstance(new Router([], Config::get('basepath')));
DB::setInstance(new Database(Config::get('db'), PDO::FETCH_OBJ));

require __APP__.'helpers.php';
require __APP__.'routes.php';

App::run();
