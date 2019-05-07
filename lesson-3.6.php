<?php

$html = file_get_contents('index.html');

$menu = [
    'Главная',
    'Новости',
    'subMenu' => ['Новости о спорте', 'Новости о политеке', 'Новости о мире'],
    'Контакты',
    'Справка',
];
    
echo "<ul>";
foreach ($menu as $key => $item){
    if ($key !== 'subMenu') {
        echo "<li><a>{$item}</a></li>";
        continue;
    }
    echo "<ul>";
    if (is_array($item)) {
        foreach ($item as $options) {
            echo "<li><a>{$options}</a></li>";
        }     
    }
    echo "</ul>";
}
echo "</ul>";

$html = preg_replace(
    '/<nav>*<\\/nav>/',
    '<h3>Меню</h3>',
    $html
);
echo $html;

?>