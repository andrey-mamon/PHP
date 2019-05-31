<?php
function index()
{    
    $sql = "SELECT id, name, description, price, hide FROM goods WHERE hide = false";
    $res = mysqli_query(connect(), $sql);
    $content = '<h1>Товары</h1>';
    
    if (isAdmin()) {
        $content .= <<<php
            <a href="?page=goods&func=add">Добавить новый товар</a><br><br>
php;
    }
	
    while ($row = mysqli_fetch_assoc($res)) {
        $content .=<<<php
		<a href="?page=goods&func=view&id={$row['id']}">{$row['name']}</a>
        <p>{$row['price']} р.</p>
        <hr>
php;
   }
   return $content;
}

function view()
{    
    $id = (int) $_GET['id'];
    $sql = "SELECT id, name, description, price, hide FROM goods WHERE id = $id";
    $res = mysqli_query(connect(), $sql);
    $content = '
       <script src="/js/main.js"></script>
       <a href="?page=goods">Все товары</a>
    ';
    $row = mysqli_fetch_assoc($res);
    $content .= <<<php
        <h1>{$row['name']}</h1>
        <p>{$row['price']}р.</p>
        <p>{$row['description']}</p>
php;
    
    if (isAuth()) {
        $content .= <<<php
            <p style="color: red; cursor: pointer">
                <i onclick="add({$id})">Добавить в корзину</i>
            </p>
php;
    }

    if (isAdmin()) {
        $content .= <<<php
            <a href="?id={$id}&page=goods&func=archive">Archive</a>
            <a href="?id={$id}&page=goods&func=update">Update..</a>
            <hr>
php;
    }
    return $content;
}

function add()
{    
	closeNotAdmin();
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = clearStr($_POST['name']);
        $description = clearStr($_POST['description']);
        $price = clearStr($_POST['price']);
        $sql = "INSERT INTO goods (name, description, price)
          VALUES ('{$name}', '{$description}', '{$price}')";
        mysqli_query(connect(), $sql);
        $msg = 'Товар успешно добавлен';
        $_SESSION['msg'] = $msg;
        header('Location: ?page=goods');
        exit;
	}

	
	$content = <<<php
	<h1>Добавление товара</h1>
	<form method="post" action="?page=goods&func=add">
		<input type="text" name="name" placeholder="name"><br>
		<input type="text" name="price" placeholder="price"><br>
		<textarea 
           name="description" 
           placeholder="Введите описание товара" 
           id="" 
           cols="30" 
           rows="5"></textarea><br>
		<input type="submit" value="Добавить товар">
	</form>
php;

	return $content;
}

function update()
{    
	closeNotAdmin();
    $id = (int) $_GET['id'];
    
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$name = clearStr($_POST['name']);
		$description = clearStr($_POST['description']);
		$price = clearStr($_POST['price']);
		$sql = "UPDATE goods 
			SET name='{$name}', description='{$description}', price='{$price}'
			WHERE id = {$id}";
		mysqli_query(connect(), $sql);
		header('Location: ?page=goods&func=view&id=' . $id);
		exit;
	}

	$sql = "SELECT id, name, description, price, hide FROM goods WHERE id = " . $id;

	$res = mysqli_query(connect(), $sql);
	$row = mysqli_fetch_assoc($res);

	$content = <<<php
	<h1>Редактирование информации</h1>
	<form method="post" action="?page=goods&func=update&id={$id}">
		Наименование: <input type="text" name="name" value="{$row['name']}"><br>
		Цена: <input type="text" name="price" value="{$row['price']}"><br>
		Описание: <textarea 
            name="description" 
            placeholder="Введите описание товара" 
            id="" 
            cols="30" 
            rows="5">{$row['description']}</textarea><br>
		<input type="submit">
	</form>
php;

	return $content;
}

function archive()
{    
	closeNotAdmin();
    $id = (int) $_GET['id'];
	$msg = 'Что-то пошло не так...';

	if (! empty($id)) {
		$sql = "UPDATE goods SET hide = true WHERE id = {$id}";
		$res = mysqli_query(connect(), $sql);
		$msg = 'Товар отправлен в архив';

	}

    $_SESSION['msg'] = $msg;
	header('Location: ?page=goods');
    exit;
}