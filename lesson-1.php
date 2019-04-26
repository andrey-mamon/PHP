<!--
Задание 1. Установить ПО

Установлен XAMPP

Задание 2. Выполнить примеры из методички

Ниже...
-->

<?php
$name = "GeekBrains user";
echo "Hello, $name!";
// Hello, GeekBrains user!
?><br>

<?php
define('MY_CONST', 100);
echo MY_CONST; // 100
?><br>

<?php
$int10 = 42;
$int2 = 0b101010;
$int8 = 052;
$int16 = 0x2A;
echo "Десятеричная система $int10 <br>"; // 42
echo "Двоичная система $int2 <br>"; // 42
echo "Восьмеричная система $int8 <br>"; // 42
echo "Шестнадцатеричная система $int16 <br>"; // 42
?><br>

<?php
$precise1 = 1.5;
$precise2 = 1.5e4;
$precise3 = 6E-8;
echo "$precise1 | $precise2 | $precise3"; // 1.5 | 15000 | 6.0E-8
?><br>

<?php
$a = 1;
echo "$a<br>"; // 1
echo '$a'; // $a
?><br>

<?php
$a = 10;
$b = (boolean)$a; // true => 1
echo $b; // 1
?><br>

<?php
$a = 'Hello,';
$b = ' world';
$c =$a . $b;
echo $c; // Hello, world
?><br>


<?php
$a = 4;
$b = 5;
echo $a + $b . '<br>'; // сложение => 9
echo $a * $b . '<br>'; // умножение => 20
echo $a - $b . '<br>'; // вычитание => -1
echo $a / $b . '<br>'; // деление => 0.8
echo $a % $b . '<br>'; // остаток от деления => 4
echo $a ** $b . '<br>'; // возведение в степень => 1024
?><br>

<?php
$a = 4;
$b = 5;
$a += $b; // $a = $a + $b = 4 + 5 = 9
echo 'a = '. $a . '<br>';

$a = 0;
echo $a++ . '<br>'; // Постинкремент
// 0; a = 1
echo ++$a . '<br>'; // Преинкремент
// 2; a = 2
echo $a-- . '<br>'; // Постдекремент
// 2; a = 1
echo --$a . '<br>'; // Предекремент
// 0; a = 0
?><br>

<?php
$a = 4;
$b = 5;
var_dump($a == $b); // Сравнение по значению => false
var_dump($a === $b); // Сравнение по значению и типу => false
var_dump($a > $b); // Больше => false
var_dump($a < $b); // Меньше => true
var_dump($a <> $b); // Не равно => true
var_dump($a != $b); // Не равно => true
var_dump($a !== $b); // Не равно без приведения типов => true
var_dump($a <= $b); // Меньше или равно => true
var_dump($a >= $b); // Больше или равно => false
?><br>

<!--Задание 3. Объяснить, как работает данный код-->

<?php
$a = 5;
$b = '05';
var_dump($a == $b); // Почему true?
// строка $b приводится к числу int = 5 => 5 == 5 => true
var_dump((int)'012345'); // Почему 12345?
// явное приведение строки к числу int; ведущий 0 у числа опускается
var_dump((float)123.0 === (int)123.0); // Почему false?
// нарушено строгое сравнение так как значения одинаковые, а типы разные
var_dump((int)0 === (int)'hello, world'); // Почему true?
// строка без ведущего числа приводится к int = 0, поэтому совпадают и типы, и значения
?>

<!--Задание 4.
Используя имеющийся HTML-шаблон, сделать так, чтобы главная страница генерировалась через PHP. Создать блок переменных в начале страницы. Сделать так, чтобы h1, title и текущий год генерировались в блоке контента из созданных переменных.
-->

<?php
$title = "Geekbrains Homework";
$header = "Домашнее задание 4 к уроку 1";
$currentYear = date("Y");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title ?></title>
</head>
<body>
    <h1><?php echo $header ?></h1>
    
<!--5. *Используя только две переменные, поменяйте их значение местами. Например, если a = 1, b = 2, надо, чтобы получилось b = 1, a = 2. Дополнительные переменные использовать нельзя.
-->
    
<?php
    $a = 4;
    $b = 5;
        
    echo 'a = ' . $a . '<br>';
    echo 'b = ' . $b . '<br>';
        
    $a = $a + $b; // a = 9; b = 5
    $b = $a - $b; // a = 9; b = 4
    $a = $a - $b; // a = 5; b = 4
        
    echo 'a = a + b // 9 = 4 + 5 // a = 9; b = 5<br>';
    echo 'b = a - b // 4 = 9 - 5 // a = 9; b = 4<br>';
    echo 'a = a - b // 5 = 9 - 4 // a = 5; b = 4<br>';
    echo 'a = ' . $a . '<br>';
    echo 'b = ' . $b . '<br>';
?>
    
    <footer><hr>Все права защищены &copy; <?php echo $currentYear ?></footer>
</body>
</html>