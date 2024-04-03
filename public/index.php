<?php

use wfm\Router;


session_start();

require __DIR__ . '/../vendor/autoload.php';
require dirname(__DIR__) . "./config/config.php";
require_once __DIR__ . '/bootstrap.php';
require CORE . "/function.php";


$router = new Router();
require CONFIG . '/routes.php';
$router->match();




