<?php

// Разрешенные типы файлов
$allow = [
    'image/jpg', 'image/jpeg', 'image/bmp', 'image/png', 'image/svg+xml'
];
$allowSize = 30000;

$uploaddir = './img/';
$uploadfile = $uploaddir.basename($_FILES['uploadfile']['name']);

if (!in_array(strtolower($_FILES['uploadfile']['type']), $allow)) {
    echo "<h3>Ошибка! Недопустимый тип файла!</h3>";
    exit;
}

if (($_FILES['uploadfile']['size']) > $allowSize) {
    echo "<h3>Ошибка! Недопустимый размер файла!</h3>";
    exit;
}

if (copy($_FILES['uploadfile']['tmp_name'], $uploadfile)) {
    echo "<h3>Файл успешно загружен на сервер</h3>";
} else {
    echo "<h3>Ошибка! Не удалось загрузить файл на сервер!</h3>";
    exit;
}

?>