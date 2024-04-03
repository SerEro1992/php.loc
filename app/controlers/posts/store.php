<?php

use wfm\Validator;

$db = \wfm\App::get(\wfm\Db::class);

$fillable = ['title', 'content', 'excerpt'];
$data = load($fillable);

$validator = new Validator();

$validation = $validator->validate($data, [
  'title' => [
    'required' => true,
    'min' => 5,
    'max' => 255,
  ],
  'content' => [
    'required' => true,
    'min' => 10,
    'max' => 10000,
  ],
  'excerpt' => [
    'required' => true,
    'min' => 10,
    'max' => 255,
  ],
  'email' => [
    'email' => true,
  ]
]);


if (!$validation->hasErrors()) {
  if ($db->query("INSERT INTO posts (`title`, `content`, `excerpt`) VALUES (:title,:content,:excerpt)", $data)) {
    $_SESSION['success'] = "Запись добавлена";
  } else {
    $_SESSION['error'] = "Запись не добавлена";
  }
  redirect('/');
} else {
  require VIEWS . '/posts/create.tpl.php';
}

