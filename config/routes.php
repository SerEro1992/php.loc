<?php


/** @var $router */

const MIDDLEWARE = [
  'auth' => \wfm\middleware\Auth::class,
  'guest' => \wfm\middleware\Guest::class
];

// Маршрут для постов
$router->get('', 'posts/index.php');
$router->get('posts/create', 'posts/create.php')->only('auth');
$router->get('posts/(?P<slug>[a-z0-9-]+)', 'posts/show.php');
$router->post('posts', 'posts/store.php');
$router->delete('posts', 'posts/destroy.php');

// Маршрут для страниц
$router->get('about', 'about.php');
$router->get('contact', 'contact.php');


// Маршрут для User
// Регистрация через два файла
#$router->get('register', 'users/register.php')->only('guest');
#$router->post('register', 'users/store.php')->only('guest');

// Регистрация через один файл
$router->add('register', 'users/register.php', ['GET', 'POST'])->only('guest');

$router->add('login', 'users/login.php', ['GET', 'POST'])->only('guest');

$router->get('logout', 'users/logout.php')->only('auth');



//$routes= [
//  ''=> 'index.php',
//  'about' => 'about.php',
//  'post' => 'show.php',
//  'posts/create'=>'create.php'
//];
