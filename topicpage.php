<?php

    session_start();


    $_SESSION['topicstart'] = (int)$_GET['s'];


    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $extra = 'index.php';

    header("Location: http://$host$uri/$extra");
    exit;






?>


