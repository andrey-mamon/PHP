<?php
 
$html = file_get_contents('index.html');
 
$menu = [
    'Главная',
    'Новости',
    ['Новости о спорте', 'Новости о политеке', 'Новости о мире'],
    'Контакты',
    'Справка',
];
   
function renderMenuItem($item) {
    return "<li><a>{$item}</a></li>";
}
 
function renderMenuList($items) {
    $menuString = "";
    foreach ($items as $item) {
        if (is_array($item)) {
            $menuString .= renderMenuList($item);
            continue;
        }
        $menuString .= renderMenuItem($item);
    }    
    return "<ul>{$menuString}</ul>";
}
 
function str_to_utf8 ($str) { 
    if (mb_detect_encoding($str, 'UTF-8', true) === false) {
        $str = mb_convert_encoding($str, "UTF-8");
    }
    return $str;
}
 
$menuHtml = renderMenuList($menu);
 
$html = str_to_utf8($html);
$html = str_replace('{Menu}', $menuHtml, $html);
echo $html;
 
?>
