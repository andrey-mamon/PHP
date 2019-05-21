<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $file = PUBLIC_DIR . '/' . $_FILES['userfile']['name'];
    copy($_FILES['userfile']['tmp_name'], $file);
    header('Location: ?page=1');
    exit();
}


$content = <<<php
<h1>Главная</h1>

<form enctype="multipart/form-data" method="post">
    <input name="name" type="text">
    <input name="userfile" type="file">
    <input type="submit" value="Отправить файл" >
</form>

php;
