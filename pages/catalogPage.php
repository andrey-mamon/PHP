<?php

$sql = "SELECT id, name, description, image FROM goods";
$res = mysqli_query(connect(), $sql);

$content = '<h1>Каталог товаров</h1>';
while ($row = mysqli_fetch_assoc($res)) {
    $content .= <<<php
    <h3>{$row['name']}</h3>
    <a href="?id={$row['id']}&page=7">More..</a>
    <hr>
php;

}
