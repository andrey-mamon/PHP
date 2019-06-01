<?php
function index()
{
	closeNotAuth();
    
    if (! isAdmin()) {
        header('Location: ?page=user&func=view&id=' . $_SESSION['userId']);
        exit;
    }

	$sql = "SELECT id, fio, login, password, date FROM users";
	$res = mysqli_query(connect(), $sql);

	$content =<<<php
		<h1>Пользователи</h1>
		<a href="?page=user&func=add">Добавить пользователя</a>
php;
	
	while ($row = mysqli_fetch_assoc($res)) {
		$content .= <<<php
		<h3>{$row['login']}</h3>
		<a href="?id={$row['id']}&page=user&func=del">Del</a>
		<a href="?id={$row['id']}&page=user&func=view">More..</a>
		<a href="?id={$row['id']}&page=user&func=update">Update..</a>
		<hr>
php;

	}
	return $content;
}

function view()
{
	closeNotAuth();

    if (isAdmin()) {
        $id = (int) $_GET['id'];
    } else {
        $id = $_SESSION['userId'];
    }
    
    $sql = "SELECT id, fio, login, password, date 
	FROM users WHERE id = " . $id;

    $content =<<<php
		<h1>Пользователь</h1>
		<a href="?page=user">Назад</a>
php;

	$res = mysqli_query(connect(), $sql);
	$row = mysqli_fetch_assoc($res);
	$date = date('d-m-Y', strtotime($row['date']));
	
    if (! isAdmin()) {
        $content .= '<h3>Добро пожаловать, ' . $row['fio'] . '!</h3>';
    }

	$content .= <<<php
		<p>Логин: {$row['login']}</p>
		<p>Дата регистрации: {$date}</p>
        <a href="?id={$row['id']}&page=user&func=update">Update..</a>
		<hr>
php;

	return $content;
}

function add()
{
    closeNotAdmin();

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$fio = clearStr($_POST['fio']);
		$login = clearStr($_POST['login']);
        $password = md5(clearStr($_POST['password']).SOL);
		$sql = "INSERT INTO users (fio, login, password)
		  VALUES ('{$fio}', '{$login}', '{$password}')";
		mysqli_query(connect(), $sql);
		$msg = 'Пользователь успешно добавлен';
		$_SESSION['msg'] = $msg;
		header('Location: ?page=user');
		exit;
	}

	$content =<<<php
	<h1>Добавление пользователя</h1>
	<form method="post" action="?page=user&func=add">
		<input type="text" name="fio" placeholder="fio"><br>
		<input type="text" name="login" placeholder="login"><br>
		<input type="text" name="password" placeholder="password"><br>
		<input type="submit">
	</form>
php;

	return $content;
}

function update()
{
	closeNotAuth();

    if (isAdmin()) {
        $id = (int) $_GET['id'];
    } else {
        $id = $_SESSION['userId'];
    }
    
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$fio = clearStr($_POST['fio']);
		$login = clearStr($_POST['login']);
		$password = md5(clearStr($_POST['password']).SOL);
		$sql = "UPDATE users 
			SET fio='{$fio}', login='{$login}', password='{$password}'
			WHERE id = {$id}";
		mysqli_query(connect(), $sql);
        $msg = 'Пользователь успешно обновлен';
		$_SESSION['msg'] = $msg;
		header('Location: ?page=user');
		exit;
	}

	$sql = "SELECT id, fio, login, password, date 
	FROM users WHERE id = " . $id;

	$res = mysqli_query(connect(), $sql);
	$row = mysqli_fetch_assoc($res);

	$content =<<<php
	<h1>Редактирование информации</h1>
	<form method="post" action="?page=user&func=update&id={$row['id']}">
		ФИО: <input type="text" name="fio" value="{$row['fio']}"><br>
		Логин: <input type="text" name="login" value="{$row['login']}"><br>
		Пароль: <input type="text" name="password"><br>
		<input type="submit" value="Обновить">
	</form>
php;

	return $content;
}

function del()
{
	closeNotAdmin();
    
    $id = (int) $_GET['id'];
	$msg = 'Что-то пошло не так...';

	if (! empty($id)) {
		$sql = "DELETE FROM users WHERE id = " . $id;
		$res = mysqli_query(connect(), $sql);
		$msg = 'Пользователь успешно удален';

	}

    $_SESSION['msg'] = $msg;
    header('Location: '.$_SERVER['HTTP_REFERER']);
    exit;
}