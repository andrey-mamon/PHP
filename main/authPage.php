<?php
function index()
{
    $content = '<h1>Форма авторизации</h1>';
    if (!isset($_SESSION['adminKey']) || $_SESSION['adminKey'] != ADMIN_KEY) {
        $content .=<<<php

        <form method="post" action="?page=auth&func=login">
            <input name="login" placeholder="login">
            <input name="password" placeholder="password">
            <input type="submit" value="Login" >
        </form>

php;
    } else {
        $content .=<<<php
<a href="?page=auth&func=logout">Exit</a>
php;
    }

    return $content;
}

function login()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $login = clearStr($_POST['login']);
        $sql = "SELECT id, fio, password 
                FROM users 
                WHERE login = '$login'";
        $res = mysqli_query(connect(), $sql);
        $row = mysqli_fetch_assoc($res);

        $password = md5($_POST['password'].SOL);
        $_SESSION['msg'] = 'Не верный логин или пароль';
        if (! empty($login) && $password == $row['password']) {
            $_SESSION['adminKey'] = ADMIN_KEY;
            $_SESSION['msg'] = 'Вы авторизованы';
        }
        // на профиль пользователя
       $pos1 = stripos($_SERVER['HTTP_REFERER'], 'page=auth');
       if ($pos1 === false) {
           header('Location: ?page=profile&id=' . $row['id']);
       } else {
           header('Location: ' . $_SERVER['HTTP_REFERER']);
       }
    }
    exit;
}

function logout()
{
    session_destroy();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
