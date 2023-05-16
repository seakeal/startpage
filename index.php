<?php

// Site entry!

// Redirect to page
if (array_key_exists('page', $_GET)) {
    switch ($_GET['page']) {
        case 'home':
            include 'pages/home.php';
            break;
        case 'archive':
            include 'pages/archive.php';
            break;
        default:
            include 'pages/404.php';
            break;
    }
} else {
    include 'pages/home.php';
}



?>
