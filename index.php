<?php

ini_set('display_errors', 1);
session_start();

define('ROOT', dirname(__FILE__));
define('SETTING', include_once 'app/config/app.php');

require_once(ROOT . '/app/includes/db.php');
require_once(ROOT . '/components/Router.php');

$router = new Router();
$router->run();