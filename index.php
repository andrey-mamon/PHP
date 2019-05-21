<?php
const PUBLIC_DIR = __DIR__;

include ('config.php');

if (isset($_GET['page'])) $page = (int)$_GET['page'];
if (isset($_GET['del'])) $del = (int)$_GET['del'];
if (isset($_GET['id'])) $id = (int)$_GET['id'];

switch ($page) {
    case 1: include ('pages/mainPage.php'); break;
    case 2: include ('pages/usersPage.php'); break;
    case 3: include ('pages/userAddPage.php'); break;
    case 4: include ('pages/userPage.php'); break;
    case 5: include ('pages/userUpdatePage.php'); break;
    case 6: include ('pages/catalogPage.php'); break;
    case 7: include ('pages/singlePage.php'); break;
    case 8: include ('pages/reviewPage.php'); break;
    case 9: include ('pages/calculator1Page.php'); break;
    case 10: include ('pages/calculator2Page.php'); break;
    default: include ('pages/mainPage.php'); break;
}
$file = file_get_contents('main.html');

echo str_replace('{CONTENT}', $content, $file);
