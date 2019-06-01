<?php
session_start();
include ('config.php');

$page = ! empty($_GET['page']) ? $_GET['page'] : 'index';
$func = ! empty($_GET['func']) ? $_GET['func'] : 'index';

$dir = __DIR__ . '/';

if (! file_exists($dir . $page . 'Page.php')) {
    $page = 'index';
}

include($dir . $page . 'Page.php');

if (! function_exists($func)) {
    $func = 'index';
}

$content = $func();

$msg = '';
if (! empty($_SESSION['msg'])) {
    $msg = $_SESSION['msg'];
    unset($_SESSION['msg']);
}


$file = file_get_contents($dir .'main.html');

$file = str_replace('{CONTENT}', $content, $file);
$file = str_replace('{__MSG__}', $msg, $file);

echo $file;