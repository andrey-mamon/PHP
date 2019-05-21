<?php
if (! empty($del)) {
    $sql = "DELETE FROM users WHERE id = " . $del;
    $res = mysqli_query(connect(), $sql);
    header('Location: ?page=2');
    exit;
}


$sql = "SELECT id, fio, login, password, date, count FROM users";
$res = mysqli_query(connect(), $sql);

$content = '<h1>Пользователи</h1>';
while ($row = mysqli_fetch_assoc($res)) {
    $content .= <<<php
    <h3>{$row['login']}</h3>
    <a href="?del={$row['id']}&page=2">Del</a>
    <a href="?id={$row['id']}&page=4">More..</a>
    <a href="?id={$row['id']}&page=5">Update..</a>
    <hr>
php;

}
