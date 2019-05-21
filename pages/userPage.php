<?php
$sql = "SELECT id, fio, login, password, date, count 
FROM users WHERE id = " . $id;

$content = '<h1>Пользователь</h1>';

$res = mysqli_query(connect(), $sql);
$row = mysqli_fetch_assoc($res);
$date = date('d-m-Y', strtotime($row['date']));
$content .= <<<php
    <h3>{$row['login']}</h3>
    <p>{$row['fio']}</p>
    <p>Дата регистрации: {$date}</p>
    <hr>
php;

