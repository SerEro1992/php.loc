<?php

$title = 'Регистрация';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $db = \wfm\App::get(\wfm\Db::class);


  $fillable = ['name', 'email', 'password'];
  $data = load($fillable);


  if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
    $data['avatar'] = $_FILES['avatar'];
  } else {
    $data['avatar'] = [];
  }


  $validator = new \wfm\Validator();

  $validation = $validator->validate($data, [
    'name' => [
      'required' => true,
      'max' => 100,
    ],
    'email' => [
      'email' => true,
      'max' => 100,
      'unique' => 'users:email'
    ],
    'password' => [
      'required' => true,
      'min' => 5
    ],
    'avatar' => [
//      'required' => true,
      'ext' => 'jpg|gif|webp|avif|png',
      'size' => 1024 * 1024,
    ],
  ]);


  if (!$validation->hasErrors()) {
    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    if ($db->query("INSERT INTO users (`name`, `email`, `password`) VALUES (?,?,?)", [$data['name'], $data['email'], $data['password']])) {

      if (!empty($data['avatar']['name'])) {
        $id = $db->getInsertId();
        $file_ext = get_file_ext($_FILES['avatar']['name']);
        $dir = '/avatars/' . date('Y') . '/' . date('m') . '/' . date('d');

        if (!is_dir(UPLOADS . $dir)) {
          mkdir(UPLOADS . $dir, 0755, true);
        }

        $file_path = UPLOADS . "{$dir} /avatar-{$id}.{$file_ext}";
        $file_url = "/uploads{$dir}/avatar-{$id}.{$file_ext}";

        if (move_uploaded_file($data['avatar']['tmp_name'], $file_path)) {

          $db->query("UPDATE users SET avatar = ? WHERE id = ?", [$file_url, $id]);
        } else {
          error_log("[" . date('Y-m-d H:i:s') . "] Ошибка загрузки аватара" . PHP_EOL, 3, ERRORS_LOG_FILE);
        }
      }


      $_SESSION['success'] = "Вы успешно зарегистрировались";
    } else {
      $_SESSION['error'] = "Произошла ошибка при регистрации";
    }
    redirect(PATH);
  }
}


require_once VIEWS . '/users/register.tpl.php';