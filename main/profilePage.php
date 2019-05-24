<?php
function index() {
   closeNotAdmin();

   $sql = "SELECT id, fio, login, password, date 
   FROM users WHERE id = " . $id;

   $content = '<h1>Пользователь</h1>';

   $res = mysqli_query(connect(), $sql);
   $row = mysqli_fetch_assoc($res);

   $content .= <<<php
       <h3>Добро пожаловать, {$row['fio']}!</h3>
       <p>Логин: {$row['login']}</p>
php;

   return $content;
}
