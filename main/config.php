<?php

const ADMIN_KEY = '__YES__';
const SOL = 'hghj7865gjhggf7tuib67';

function connect()
{
    static $link;
    if (empty($link)) {
        $link = mysqli_connect('localhost','root','','geekbrains');
        $link->set_charset("utf8");
    }
    return $link;
}

function clearStr($str)
{
    return mysqli_real_escape_string(connect(),strip_tags(trim($str)));
}

function closeNotAuth($msg = 'Нет доступа')
{
    if (empty($_SESSION['userId'])) {
        $_SESSION['msg'] = $msg;
        header('Location: ?page=auth');
        exit();
    }
}

function closeNotAdmin($msg = 'Нет доступа')
{
    if (empty($_SESSION['adminKey']) || $_SESSION['adminKey'] !== ADMIN_KEY) {
        $_SESSION['msg'] = $msg;
        header('Location: /');
        exit();
    }
}

function isAuth()
{
    if (! empty($_SESSION['userId'])) return true;
}

function isAdmin()
{
    if (! empty($_SESSION['adminKey']) && $_SESSION['adminKey'] === ADMIN_KEY) return true;
}

function getCountInCart()
{
    $count = 0;
    if (! empty($_SESSION['goods'])) {
        $count = count($_SESSION['goods']);
    }
    return $count;
}