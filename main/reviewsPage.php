<?php
function index()
{
	$content = '';
    if (isAuth()) {
        $content = <<<php
            <h1>Добавить отзыв</h1>
            <form method="post" action="?page=reviews&func=add">
                Ваше имя: <input type="text" name="name"><br><br>
                Отзыв: <textarea name="text" rows="10" cols="45"></textarea><br><br>
                <input type="submit" value="Отправить"> </form>
php;
    }
    
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
        if (isAdmin()) {
            $content .= <<<php
                <a href="?id={$row['id']}&page=reviews&func=del">Удалить отзыв</a>
php;
        }
	}
	return $content;
}

function add()
{    
    closeNotAuth();
    $msg = 'Что-то пошло не так...';
    
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$name = clearStr($_POST['name']);
		$text = clearStr($_POST['text']);
		$sql = "INSERT INTO reviews (name, text)
		  VALUES ('{$name}', '{$text}')";
		mysqli_query(connect(), $sql);
		$msg = 'Отзыв успешно добавлен';
	}

   $_SESSION['msg'] = $msg;
   header('Location: '.$_SERVER['HTTP_REFERER']);
   exit;
}

function del()
{    
	closeNotAdmin();
    $id = (int) $_GET['id'];
	$msg = 'Что-то пошло не так...';

	if (! empty($id)) {
		$sql = "DELETE FROM reviews WHERE id = " . $id;
		$res = mysqli_query(connect(), $sql);
		$msg = 'Отзыв успешно удален';

	}

    $_SESSION['msg'] = $msg;
	header('Location: '.$_SERVER['HTTP_REFERER']);
    exit;
}