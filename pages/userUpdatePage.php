<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = clearStr($_POST['login']);
    $password = clearStr($_POST['password']);
    $sql = "UPDATE users 
        SET login='{$login}',password='{$password}'
        WHERE id = {$id}";
    mysqli_query(connect(), $sql);
    header('Location: ?page=2');
    exit;
}

$sql = "SELECT id, fio, login, password, date, count 
FROM users WHERE id = " . $id;

$res = mysqli_query(connect(), $sql);
$row = mysqli_fetch_assoc($res);

$content =<<<php
<h1>Редактирование информации</h1>
<form method="post">
    <input type="text" name="login" value="{$row['login']}">
    <input type="text" name="password" value="{$row['password']}">
    <input type="submit">
</form>
php;

