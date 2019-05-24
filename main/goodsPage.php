<?php
function index()
{
    $sql = "SELECT id, name, description, image FROM goods";
    $res = mysqli_query(connect(), $sql);

    $content = '<h1>Каталог товаров</h1>';
    while ($row = mysqli_fetch_assoc($res)) {
        $content .= <<<php
        <form method="post" action="?page=goods&func=add">
        <h3>{$row['name']}</h3>
        <a href="?id={$row['id']}&page=goods&func=add">More..</a>
        <input type="submit" value="Bay" >
        </form>
        <hr>
    php;

    }
    return $content;
}

function add() {
	closeNotAdmin();

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$login = clearStr($_POST['login']);
		$password = clearStr($_POST['password']);
		$sql = "INSERT INTO users (login, password)
		  VALUES ('{$login}', '{$password}')";
		mysqli_query(connect(), $sql);
		header('Location: ?page=user');
		exit;
	}

	$content =<<<php
	<h1>Добавление пользователя</h1>
	<form method="post">
		<input type="text" name="login">
		<input type="text" name="password">
		<input type="submit">
	</form>
php;

	return $content;
}