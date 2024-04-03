<?php

use wfm\Db;
use wfm\App;

function dump($data)
{
  echo '<pre>';
  var_dump($data);
  echo '</pre>';
}

function print__arr($data)
{
  echo '<pre>';
  print_r($data);
  echo '</pre>';
}

function dd($data)
{
  dump($data);
  die();
}

function abort($code = 404, $title = '404 not found ')
{
  http_response_code($code);
  require_once VIEWS . "/errors/{$code}.php";
  die();
}

function load($fillable = [], $post = true)
{
  $load_data = $post ? $_POST : $_GET;
  $data = [];
  foreach ($fillable as $key) {
    if (isset($load_data[$key])) {
      if (!is_array($load_data[$key])) {
        $data[$key] = trim($load_data[$key]);
      } else {
        $data[$key] = $load_data[$key];
      }
    } else {
      $data[$key] = '';
    }
  }
  return $data;
}

function old($fieldname)
{
  return isset($_POST[$fieldname]) ? h($_POST[$fieldname]) : '';
}

function h($str)
{
  return htmlspecialchars($str, ENT_QUOTES);
}

function redirect($url = '')
{
  if ($url) {
    $redirect = $url;
  } else {
    $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
  }
  header("Location: {$redirect}");
  exit();
}

function get_alerts()
{
  if (isset($_SESSION['success'])) {
    require_once VIEWS . '/incs/alert_success.php';
    unset($_SESSION['success']);
  }
  if (isset($_SESSION['error'])) {
    require_once VIEWS . '/incs/alert_error.php';
    unset($_SESSION['error']);
  }
}

function db(): Db
{
  return App::get(Db::class);
}

function checkAuth()
{
  return isset($_SESSION['user']);
}

function get_file_ext($file_name)
{
  $file_ext = explode('.', $file_name);
  return end($file_ext);
}

function route_params(): array
{
  return \wfm\Router::$route_params;
}

function route_param(string $key, $default = null)
{
  return \wfm\Router::$route_params[$key] ?? $default;
}


