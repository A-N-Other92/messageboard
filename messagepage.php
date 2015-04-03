<?php

    session_start();


    $_SESSION['messagestart'] = (int)$_GET['s'];
    $topic=$_GET['t'];


    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $extra = 'index.php?topicmess=' . $topic;

    header("Location: http://$host$uri/$extra");
    exit;






?>


