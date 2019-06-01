<?php
function index()
{    
    closeNotAuth();
    
    if (empty($_SESSION['goods'])) {
        return '<h2>Корзина пуста</h2>';
    }
    $content = <<<php
    <form method="post" action="?page=orders&func=add">
        <textarea 
            name="comment" 
            placeholder="Введите контактные данные" 
            id="" 
            cols="30" 
            rows="5"></textarea><br>
            <input type="submit" value="Создать заказ">    
    </form>
php;
    $totalPrice = 0;
    foreach ($_SESSION['goods'] as $id => $good) {
        $totalPrice += ($good['price'] * $good['count']);
        $content .= <<<php
        <h2>{$good['name']}</h2>
        <p>
            Количество: 
            <a href="?page=cart&func=del&id={$id}">-</a>
            {$good['count']}
            <a href="?page=cart&func=add&id={$id}&notMsg=1">+</a>
            <br>
            Цена за единицу: {$good['price']}
        </p>  
php;
    }
    if ($totalPrice) {
        $content .= "<p>Всего: {$totalPrice}</p>";
    }

    return $content;
}

function add()
{    
    closeNotAuth();
    $id = (int) $_GET['id'];
    $msg = 'Что-то пошло не так...';
    
    if (! empty($id)) {
        $sql = "SELECT id, name, description, price, hide
                FROM goods WHERE id = {$id}";
        $res = mysqli_query(connect(), $sql);
        $row = mysqli_fetch_assoc($res);
        if (! empty($row)) {
            if (empty($_SESSION['goods'][$id])) {
                $_SESSION['goods'][$id] = [
                  'price' =>  $row['price'],
                  'name' =>  $row['name'],
                  'count' =>  1,
                ];
            } else {
                $_SESSION['goods'][$id]['count'] += 1;
            }
            $msg = 'Товар добавлен в корзину';
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $count = getCountInCart();
        $array = [
          'count' => $count,
          'msg' => $msg
        ];
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
        exit;
    }


    if (empty($_GET['notMsg'])) {
        $_SESSION['msg'] = $msg;
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

function del()
{    
    closeNotAuth();
    $id = (int) $_GET['id'];
    $msg = 'Что-то пошло не так...';
    
    if (! empty($id) && $_SESSION['goods'][$id]) {
        if ($_SESSION['goods'][$id]['count'] != 1) {
            $_SESSION['goods'][$id]['count'] -= 1;
        } else {
            unset($_SESSION['goods'][$id]);
        }
        $msg = 'Товар удален';
    }

    $_SESSION['msg'] = $msg;
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}