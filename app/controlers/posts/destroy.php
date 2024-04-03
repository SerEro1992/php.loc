<?php
$db = \wfm\App::get(\wfm\Db::class);

$api_data = json_decode(file_get_contents('php://input'), 1);

$data = $api_data ?? $_POST;
$id = $data['id'] ?? 0;

$db->query("DELETE FROM posts WHERE id = ?", [$id]);

if ($db->rowCount()) {
  $res['answer'] = $_SESSION['success'] = 'Successfully deleted!';
} else {
  $res['answer'] = $_SESSION['error'] = 'Something went wrong!';
}
if ($api_data) {
  echo json_encode($res);
  exit();
}

redirect('/');


