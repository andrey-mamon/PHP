<?php

$expression = '';
$result = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($_POST['operation'] == '/' && $_POST['x2'] == 0) {
        $result = 'На ноль делить нельзя';
    } else {

        $x1 = (int)$_POST['x1'];
        $x2 = (int)$_POST['x2'];

        $expression = $x1 . ' ' . $_POST['operation'] . ' ' . $x2 . ' = ';

        switch ($_POST['operation']) {
            case '+':
                $result = $x1 + $x2;
                break;
            case '-':
                $result = $x1 - $x2;
                break;
            case '*':
                $result = $x1 * $x2;
                break;
            case '/':
                $result = $x1 / $x2;
                break;
            default:
                $result = 'Операция не поддерживается';
        }
    }
}

$content = <<<php
<h1>Калькулятор 2</h1>
<form method="post">
    <input type="text" name="x1">
    <input type="text" name="x2">
    <input name="operation" type="submit" value="+">
    <input name="operation" type="submit" value="-">
    <input name="operation" type="submit" value="*">
    <input name="operation" type="submit" value="/">

</form>
php;

$content .= $expression . $result;

?>