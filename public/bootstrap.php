<?php

use wfm\Db;
use wfm\ServiceContainer;
use wfm\App;

$container = new ServiceContainer();

$container->setService(Db::class, function () {
  $db_config = require CONFIG . "/db.php";
  $db = (Db::getInstance())->getConnection($db_config);
  return $db;
});




App::setContainer($container);
