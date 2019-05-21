<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = clearStr($_POST['name']);
    $text = clearStr($_POST['text']);
    $sql = "INSERT INTO reviews (name, text)
      VALUES ('{$name}', '{$text}')";
    mysqli_query(connect(), $sql);
    header('Location: ?page=8');
    exit;
}

$content = <<<php
<h1>Добавить отзыв</h1>
<form method="post">
    Ваше имя: <input type="text" name="name"><br><br>
    Отзыв: <textarea name="text" rows="10" cols="45"></textarea><br><br>
    <input type="submit" value="Отправить">
</form>
php;

$sql = "SELECT id, name, text, date FROM reviews ORDER BY id DESC";
$res = mysqli_query(connect(), $sql);

$content .= '<h1>Отзывы</h1>';
while ($row = mysqli_fetch_assoc($res)) {
    $date = date('d-m-Y', strtotime($row['date']));
    $content .= <<<php
    <h3>{$row['name']}</h3>
    <p>Дата отзыва: {$date}</p>
    <p>{$row['text']}</p>
    <hr>
php;

}