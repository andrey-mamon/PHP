<?php
function index()
{
   $sql = "SELECT id, name, description, image, price FROM goods";
   $res = mysqli_query(connect(), $sql);

   $content = '<h1>Каталог товаров</h1>';
   while ($row = mysqli_fetch_assoc($res)) {
       $content .= <<<php
       <form method="post" action="?page=goods&func=add">
           <h3>{$row['name']}</h3>
           <p>Price: {$row['price']}</p>
           <input type="hidden" name="id" value="{$row['id']}">
           <input type="submit" value="Bay">
       </form>
       <hr>
php;

   }
   $content .= renderCart();
   return $content;
}

function add() {
   closeNotAdmin();

   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       if (isset($_POST['id'])) $id = (int)$_POST['id'];
       // поиск в каталоге товаров
       $sql = "SELECT id, name, description, image, price
               FROM goods 
               WHERE id = '$id'";
       $res = mysqli_query(connect(), $sql);
       $row = mysqli_fetch_assoc($res);
       
       if (! isset($_SESSION['cart'])) {
           $_SESSION['cart'] = array();
       }
       // поиск товара в корзине
       goodInCart = false;
       foreach( $_SESSION['cart'] as $cart_item ) {
           if ($cart_it['id'] == $id) {
               $cart_it['quantity']++;
               goodInCart = true;
           }
       }
       // добавить товар если такого нет
       if (! goodInCart) {
           $row['quantity'] = 1;
           $_SESSION['cart'][] = $row;
       }
   }
   exit;

   $content .= renderCart();
   return $content;
}

function update() {
   closeNotAdmin();

   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       if (isset($_POST['id'])) $id = (int)$_POST['id'];
       if (isset($_POST['quantity'])) $quantity = (int)$_POST['quantity'];
       // поиск товара в корзине
       foreach( $_SESSION['cart'] as $key => $cart_item ) {
           if ($cart_it['id'] == $id) {
               if ($quantity > 0) {
                   $cart_it['quantity'] = $quantity;
               } else {
                   unset($cart_item[$key]);
               }
           }
       }
   }
   exit;

   $content .= renderCart();
   return $content;
}

function renderCart() {
   closeNotAdmin();
   if (! empty($_SESSION['cart'])) {
       
       $content = '<h1>Корзина</h1>';
       foreach( $_SESSION['cart'] as $cart_item ) {
           $content .=<<<php
           <form method="post" action="?page=goods&func=update">
               <h3>{$cart_item['name']}</h3>
               <p>Price: {$cart_item['price']}</p>
               <p>Quantity: 
                   <input type="number" name="quantity" min="0" max="1000" value="{$cart_item['quantity']}">
               </p>
               <input type="hidden" name="id" value="{$cart_item['id']}">
               <input type="submit" value="Update">
           </form>
php;
       }

   } else {
       $content =<<<php
       <h1>Корзина</h1>
       <h4>Корзина пуста</h4>
php;
   }
   
   return $content;
}
