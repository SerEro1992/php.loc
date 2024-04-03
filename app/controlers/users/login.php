<?php
$title = 'Вход в систему';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $db = \wfm\App::get(\wfm\Db::class);


  $data = load(['email', 'password']);
  $validator = new \wfm\Validator();

  $validation = $validator->validate($data, [
    'email' => [
      'email' => true
    ],
    'password' => [
      'required' => true,
    ]
  ]);


  if (!$validation->hasErrors()) {
    if (!$user = $db->query("SELECT * FROM users WHERE email = ?", [$data['email']])->find()) {
      $_SESSION['error'] = "Не правильный email или пароль";
      redirect();
    }
    if (!password_verify($data['password'], $user['password'])) {
      $_SESSION['error'] = "Не правильный email или пароль";
      redirect();
    }

//    $_SESSION['user'] = [
//      'id' => $user['id'],
//      'name' => $user['name'],
//      'email' => $user['email'],
//    ];
    foreach ($user as $key => $value) {
      if ($key === 'password') continue;
      $_SESSION['user'][$key] = $value;
    }


    $_SESSION['success'] = "Вы успешно авторизовались";
    redirect(PATH);

  }

}


require_once VIEWS . '/users/login.tpl.php';

// redirect('/');
