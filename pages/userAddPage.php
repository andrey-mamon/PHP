<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = clearStr($_POST['login']);
    $password = clearStr($_POST['password']);
    $sql = "INSERT INTO users (login, password)
      VALUES ('{$login}', '{$password}')";
    mysqli_query(connect(), $sql);
    header('Location: ?page=3');
    exit;
}

$content =<<<php
<h1>Добавление пользователя</h1>
<form method="post">
    <input type="text" name="login">
    <input type="text" name="password">
    <input type="submit">
</form>
php;

