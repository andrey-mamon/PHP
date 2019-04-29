<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Домашнее задание 2</title>
</head>

<body>

<?php
// 1. Объявить две целочисленные переменные $a и $b и задать им произвольные начальные значения. Затем написать скрипт, который работает по следующему принципу:
// •        если $a и $b положительные, вывести их разность;
// •        если $а и $b отрицательные, вывести их произведение;
// •        если $а и $b разных знаков, вывести их сумму;
// Ноль можно считать положительным числом.
 
$a = mt_rand(-100, 100);
$b = mt_rand(-100, 100);
 
echo "<h4>1. Генерируем случайные а и b</h4>";
echo "a = " . $a . ", b = " . $b . "<br>";
 
if (($a >= 0) && ($b >= 0)) {
    echo "a и b положительные: a - b = " . ($a - $b) . "<br><br>";
} else if (($a < 0) && ($b < 0)) {
    echo "a и b отрицательные: a * b = " . ($a * $b) . "<br><br>";
} else {
    echo "a и b разных знаков: a + b = " . ($a + $b) . "<br><br>";
}
 
// 2. Присвоить переменной $а значение в промежутке [0..15]. С помощью оператора switch организовать вывод чисел от $a до 15.
 
$a = mt_rand(0, 15);
echo "<h4>2. Генерируем случайное а от 0 до 15</h4>";
echo "a = " . $a . "<br>";
 
switch ($a) {
    case 0:
		echo $a++ . " ";
    case 1:
        echo $a++ . " ";
    case 2:
        echo $a++ . " ";
    case 3:
        echo $a++ . " ";
    case 4:
        echo $a++ . " ";
    case 5:
        echo $a++ . " ";
    case 6:
        echo $a++ . " ";
    case 7:
        echo $a++ . " ";
    case 8:
        echo $a++ . " ";
    case 9:
        echo $a++ . " ";
    case 10:
        echo $a++ . " ";
    case 11:
        echo $a++ . " ";
    case 12:
        echo $a++ . " ";
    case 13:
        echo $a++ . " ";
    case 14:
        echo $a++ . " ";
    case 15:
        echo $a++ . "<br><br>";
        break;
    default:
        echo "Неверные данные";
}
 
// 3. Реализовать основные 4 арифметические операции в виде функций с двумя параметрами. Обязательно использовать оператор return.
 
function add($arg1, $arg2) {
    return $arg1 + $arg2;
}
 
function subtract($arg1, $arg2) {
    return $arg1 - $arg2;
}
 
function multiply($arg1, $arg2) {
    return $arg1 * $arg2;
}
 
function divide($arg1, $arg2) {
    if ($arg2 == 0) return "Error!";
    return $arg1 / $arg2;
}
 
// 4. Реализовать функцию с тремя параметрами: function mathOperation($arg1, $arg2, $operation), где $arg1, $arg2 – значения аргументов, $operation – строка с названием операции. В зависимости от переданного значения операции выполнить одну из арифметических операций (использовать функции из пункта 3) и вернуть полученное значение (использовать switch).
 
echo "<h4>3-4. Функции с математическими операциями</h4>";
 
function mathOperation($arg1, $arg2, $operation) {
    switch ($operation) {
       case "+":
           return add($arg1, $arg2);
       case "-":
           return subtract($arg1, $arg2);
       case "*":
           return multiply($arg1, $arg2);
       case "/":
           return divide($arg1, $arg2);
default:
    echo "Неверный параметр вызова функции";
    }
}
 
function getRandom($stringArray) {
    $n = mt_rand(0, count($stringArray) - 1);
    return $stringArray[$n];
}

$a = mt_rand(-100, 100);
$b = mt_rand(-100, 100);    

$operationArray = ["+", "-", "*", "/"];
$operation = getRandom($operationArray);
$result = mathOperation($a, $b, $operation);
echo "a = " . $a . ", b = " . $b . ", operation = " . $operation . "<br>result = " . round($result, 2) . "<br><br>";
    
// 6. *С помощью рекурсии организовать функцию возведения числа в степень. Формат: function power($val, $pow), где $val – заданное число, $pow – степень.

echo "<h4>6. Возведение числа в степень с помощью рекурсии</h4>";    

$a = mt_rand(-10, 10);
$b = mt_rand(-10, 10);
echo "a = " . $a . ", b = " . $b . "<br>";
echo "a в степени b = " . power($a, $b);    

function power($val, $pow) {
 
    if ($pow == 0) {
        return 1;
    }
    if ($pow < 0) {
        return power(1 / $val, -$pow);
    }
    return $val * power($val, --$pow);

}
    
// 7. *Написать функцию, которая вычисляет текущее время и возвращает его в формате с правильными склонениями, например:
// 22 часа 15 минут
// 21 час 43 минуты
 
// 0, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20 часов
// 1, 21 час
// 2, 3, 4, 22, 23 часа
 
// 0, 5 - 20, 25 - 30, 35 - 40, 45 - 50, 55 - 59 минут
// 1, 21, 31, 41, 51 минута
// 2, 3, 4, 22, 23, 24, 32, 33, 34, 42, 43, 44, 52, 53, 54 минуты
  
echo "<h4>7. Текущее время в формате с правильными склонениями</h4>";
echo currentTime();
    
function currentTime() {
    $hour = date("H");
    $min = date("i");
    
    echo $hour;
    
    switch ($hour) {
        case 01:
        case 21:
            echo " час ";
            break;
        case 02:
        case 03:
        case 04:
        case 22:
        case 23:
            echo " часа ";
            break;
        default:
            echo " часов ";
    }
    
    echo $min;
    
    switch ($min) {
        case 01:
        case 21:
        case 31:
        case 41:
        case 51:
            echo " минута ";
            break;
        case 02:
        case 03:
        case 04:
        case 22:
        case 23:
        case 24:
        case 32:
        case 33:
        case 34:
        case 42:
        case 43:
        case 44:
        case 52:
        case 53:
        case 54:
            echo " минуты ";
            break;
        default:
            echo " минут ";
    }
}
    
// 5. Посмотреть на встроенные функции PHP. Используя имеющийся HTML-шаблон, вывести текущий год в подвале при помощи встроенных функций PHP.
    
echo "<h4>5. Год в подвале шаблона HTML</h4>";    
    
$html = file_get_contents('template.html');
$name = 'Задание 5';
$currentYear = date("Y");

$html = str_replace('{Title}', $name, $html);
$html = str_replace(
    '{Header}',
    '<h3>Меню</h3>',
    $html
);
$html = str_replace(
    '{Content}',
    '<h1>Hello world</h1>',
    $html
);
$html = str_replace(
    '{Footer}',
    "<footer><hr>Все права защищены &copy; {$currentYear}</footer>",
    $html
);
echo $html;
?>

</body>

</html>
