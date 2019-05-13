<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Домашнее задание 4</title>
    <style>
        img {
            width: 300px;
            height: 200px;
            margin: 10px;
        }
        .img-box {
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            grid-gap: 2vw;
        }
    </style>
</head>
<body>

    <h1>Домашнее задание 4</h1>
    <h3>Галерея 1</h3>
    <div class="img-box">
<?php
    
$img = [
    'img/week0_700.jpg',
    'img/week1_700.jpg',
    'img/week2_700.jpg',
    'img/week3_700.jpg',
    'img/week4_700.jpg'
];
    
foreach ($img as $item) {
    echo "<a href=" . $item . ">";
    echo "<img src=" . $item . " />";
    echo "</a><br>";
}

?>
    </div><hr>
    
    <form enctype="multipart/form-data" action="upload.php" method="POST">
        <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
        Отправить этот файл: <input name="uploadfile" type="file" />
        <input type="submit" value="Отправить файл" />
    </form><hr>
    
    <h3>Галерея 2</h3>
    <div class="img-box">
<?php
    
$dir = './img';
$files = preg_grep('/^([^.])/', scandir($dir));

foreach ($files as $item) {
    echo "<a href=" . $dir ."/". $item . ">";
    echo "<img src=" . $dir ."/". $item . " />";
    echo "</a><br>";
}
    
?>
    </div>
    
</body>
</html>