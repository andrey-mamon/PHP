<?php

$link = mysqli_connect(
    'localhost',
    'root',
    '',
    'geekbrains'
);

$sql = "SELECT id, url, name, click_count FROM images ORDER BY click_count DESC";
$res = mysqli_query($link, $sql); // or die(mysqli_error($link));

$html = '';
while ($row = mysqli_fetch_assoc($res)) {
    $html .= <<<php
    <div>
        <a href="single.php?id={$row['id']}">
            <img src={$row['url']} alt="{$row['name']}" />
        </a>
        <h5>Рейтинг: {$row['click_count']} </h5>
    </div>
php;
}

$temp = file_get_contents('template.tpl');
$temp = str_replace('{{CODE}}', $html, $temp);
echo $temp;

?>