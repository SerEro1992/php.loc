<?php

$db = \wfm\App::get(\wfm\Db::class);

// пост по id
//$id = $_GET['id'] ?? 0;
//$post = $db->query("SELECT * FROM posts WHERE id = ?  LIMIT 1", [$id])->findOrFail();

// пост по слаг
$slug = route_param('slug');
$post = $db->query("SELECT * FROM posts WHERE slug = ?  LIMIT 1", [$slug])->findOrFail();






$title = 'Пост о ' . $post['title'];

require_once VIEWS . "/posts/show.tpl.php";
