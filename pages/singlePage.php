<?php
$sql = "SELECT id, name, description, image 
FROM goods WHERE id = " . $id;

$content = '<h1>Товар</h1>';

$res = mysqli_query(connect(), $sql);
$row = mysqli_fetch_assoc($res);

$content .= <<<php
    <h3>{$row['name']}</h3>
    <p>{$row['description']}</p>
    <hr>
php;
