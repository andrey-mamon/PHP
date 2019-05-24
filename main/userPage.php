<?php
function index() {
   closeNotAdmin();

	//usersPage.php
	if (! empty($del)) {
		$sql = "DELETE FROM users WHERE id = " . $del;
		$res = mysqli_query(connect(), $sql);
		header('Location: ?page=user');
	}

	$sql = "SELECT id, fio, login, password, date, count FROM users";
	$res = mysqli_query(connect(), $sql);

	$content = '<h1>Пользователи</h1>';
	while ($row = mysqli_fetch_assoc($res)) {
		$content .= <<<php
		<h3>{$row['login']}</h3>
		<a href="?del={$row['id']}&page=user">Del</a>
		<a href="?id={$row['id']}&page=user&func=view">More..</a>
		<a href="?id={$row['id']}&page=user&func=update">Update..</a>
		<hr>
php;

	}
	return $content;
}

function view() {
	closeNotAdmin();

	//userPage.php
	$sql = "SELECT id, fio, login, password, date, count 
	FROM users WHERE id = " . $id;

	$content = '<h1>Пользователь</h1>';

	$res = mysqli_query(connect(), $sql);
	$row = mysqli_fetch_assoc($res);
	$date = date('d-m-Y', strtotime($row['date']));
	$content .= <<<php
		<h3>{$row['login']}</h3>
		<p>{$row['fio']}</p>
		<p>Дата регистрации: {$date}</p>
		<hr>
php;

	return $content;
}

function add() {
	closeNotAdmin();

	//userAddPage.php
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

function update() {
	closeNotAdmin();

	//userUpdatePage.php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$login = clearStr($_POST['login']);
		$password = clearStr($_POST['password']);
		$sql = "UPDATE users 
			SET login='{$login}',password='{$password}'
			WHERE id = {$id}";
		mysqli_query(connect(), $sql);
		header('Location: ?page=user');
		exit;
	}

	$sql = "SELECT id, fio, login, password, date, count 
	FROM users WHERE id = " . $id;

	$res = mysqli_query(connect(), $sql);
	$row = mysqli_fetch_assoc($res);

	$content =<<<php
	<h1>Редактирование информации</h1>
	<form method="post">
		<input type="text" name="login" value="{$row['login']}">
		<input type="text" name="password" value="{$row['password']}">
		<input type="submit">
	</form>
php;

	return $content;
}

function delete() {
   closeNotAdmin();

	//usersPage.php
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
	return $content;
}