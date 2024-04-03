<?php

/** @var \wfm\Db $db */


$title = 'Главная страница';


// первый вариант подключения к базе данных
$db = \wfm\App::get(\wfm\Db::class);
//$posts = $db->query("SELECT * FROM posts ORDER BY id DESC")->findAll();
//$recent_posts = $db->query("SELECT * FROM posts ORDER BY id DESC LIMIT 3")->findAll();


$page = $_GET['page'] ?? 1;
$per_page = 3;
$total = $db->query("SELECT COUNT(*) FROM posts")->getColumn();
$pagination = new \wfm\Pagination((int)$page, $per_page, $total);
$start = $pagination->getStart();


// второй вариант подключения к базе данных
$posts = db()->query("SELECT * FROM posts ORDER BY id DESC LIMIT $start, $per_page")->findAll();
$recent_posts = db()->query('SELECT * FROM posts ORDER BY id DESC LIMIT 3')->findAll();


require_once VIEWS . "/posts/index.tpl.php";

