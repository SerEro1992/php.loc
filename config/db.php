<?php
return [
  'host' => 'localhost:3307',
  'database' => 'study',
  'charset' => 'utf8',
  'username' => 'root',
  'password' => '',
  'options' => [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  ]
];

