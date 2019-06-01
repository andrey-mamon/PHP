<?php
function index()
{
    closeNotAuth();
    
    if (isAdmin()) {
        $sql = "SELECT id, user_id, status, date, comment, order_items 
            FROM orders ORDER BY id DESC";
    } else {
        $userId = $_SESSION['userId'];
        $sql = "SELECT id, user_id, status, date, comment, order_items 
            FROM orders WHERE user_id = " . $userId . " ORDER BY id DESC";
    }
    
    $res = mysqli_query(connect(), $sql);
    $content = '';
    while ($row = mysqli_fetch_assoc($res)) {
        $totalPrice = 0;
        $order_items = json_decode($row['order_items'], true);
        $id = $row['id'];
        $content .= <<<php
            <hr>{$row['date']}
            <p>ID пользователя: {$row['user_id']}</p>
            <p>Статус: {$row['status']}</p>
php;
        
        foreach ($order_items as $good) {
            $totalPrice += ($good['price'] * $good['count']);
            $content .= <<<php
                <h2>{$good['name']}</h2>
                <p>
                    Количество: 
                    {$good['count']}
                    <br>
                    Цена за единицу: {$good['price']}
                </p>  
php;
        }
        if ($totalPrice) {
            $content .= "<p>Всего: {$totalPrice}</p>";
        }
        
        if (isAdmin()) {
            $content .= <<<php
                <a href="?id={$id}&page=orders&func=update&status=work">В работу</a>
                <a href="?id={$id}&page=orders&func=update&status=done">Выполнить</a>
php;
        }
        
        $content .= <<<php
            <a href="?id={$id}&page=orders&func=update&status=reset">Отменить</a>
php;
    }
    return $content;

}

function add()
{
    closeNotAuth();
    
    $msg = 'Что-то пошло не так...';
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $comment = clearStr($_POST['comment']);
        $order_items = json_encode($_SESSION['goods'], JSON_UNESCAPED_UNICODE);
        $user_id = $_SESSION['userId'];

        $sql = "INSERT INTO orders(user_id, comment, order_items) 
                VALUES ('{$user_id}', '{$comment}', '{$order_items}')";
        mysqli_query(connect(), $sql);
        unset($_SESSION['goods']);
        $msg = 'Ваш заказ принят. Его номер:' . mysqli_insert_id(connect());
    }

    $_SESSION['msg'] = $msg;
    header('Location: '.$_SERVER['HTTP_REFERER']);
    exit;
}

function update()
{
    closeNotAuth();
    
    $id = (int) $_GET['id'];
    $status = $_GET['status'];
    
    switch ($status) {
        case "work":
            $sql = "UPDATE orders SET status = 'В работе' WHERE id = {$id}";
            break;
        case "done":
            $sql = "UPDATE orders SET status = 'Выполнен' WHERE id = {$id}";
            break;
        case "reset":
            $sql = "UPDATE orders SET status = 'Отменен' WHERE id = {$id}";
            break;
        default:
            $msg = 'Ошибка изменения статуса';
    }
    
    mysqli_query(connect(), $sql);
    $_SESSION['msg'] = $msg;
    header('Location: '.$_SERVER['HTTP_REFERER']);
    exit;
}