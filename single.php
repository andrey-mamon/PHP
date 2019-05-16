<?php

$link = mysqli_connect(
    'localhost',
    'root',
    '',
    'geekbrains'
);

if (empty($_GET['id'])) {
    echo "Ошибка передачи параметра!";
    exit;
}

$id = (int)$_GET['id'];
$sql = "UPDATE images SET click_count = click_count + 1 WHERE id = $id";
mysqli_query($link, $sql);

$sql = "SELECT id, url, name, click_count FROM images WHERE id = $id";
$res = mysqli_query($link, $sql);

$row = mysqli_fetch_assoc($res);
$html = <<<php
    <h3>{$row['name']}</h3>
    <img src={$row['url']} alt="{$row['name']}" /><br>
    <h5>Число переходов: {$row['click_count']} </h5>
php;

echo $html;

?>