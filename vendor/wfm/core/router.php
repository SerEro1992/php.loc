<?php
require_once CONFIG . "/routes.php";

$uri = trim(parse_url($_SERVER['REQUEST_URI'])['path'], '/');

if (array_key_exists($uri, $routes)) {
  if (file_exists(CONTROLERS . '/' . $routes[$uri])) {
    require CONTROLERS . '/' . $routes[$uri];
  } else {
    abort();
  }
} else {
  abort();
}



