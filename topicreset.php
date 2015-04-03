<?php

   session_start();

      if(isset($_SESSION['topicstart'])) {
               $_SESSION['topicstart']=0;
      }


      $host  = $_SERVER['HTTP_HOST'];
      $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
      $extra = 'index.php';
      header("Location: http://$host$uri/$extra");
      exit;


?>


