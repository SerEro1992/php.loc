<?php
//
//$db = \wfm\App::get(\wfm\Db::class);
//
//
//$fillable = ['name', 'email', 'password'];
//$data = load($fillable);
//
//$validator = new \wfm\Validator();
//
//$validation = $validator->validate($data, [
//  'name' => [
//    'required' => true,
//    'max' => 100,
//  ],
//  'email' => [
//    'email' => true,
//    'max' => 100,
//    'unique' => 'users:email'
//  ],
//  'password' => [
//    'required' => true,
//    'min' => 5
//  ]
//]);
//
//
//if (!$validation->hasErrors()) {
//  $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
//  if ($db->query("INSERT INTO users (`name`, `email`, `password`) VALUES (:name,:email,:password)", $data)) {
//    $_SESSION['success'] = "Вы успешно зарегистрировались";
//  } else {
//    $_SESSION['error'] = "Произошла ошибка при регистрации";
//  }
//  redirect('/');
//} else {
//  require VIEWS . '/users/register.tpl.php';
//}
