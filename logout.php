<?php

   session_start();

   if(isset($_SESSION['loggedin'])) {

      $_SESSION['loggedin'] = array();
      setcookie(session_name('loggedin'),'',time()-3600);
      @session_destroy();

   }

      $host  = $_SERVER['HTTP_HOST'];
      $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
      $extra = 'index.php';
      header("Location: http://$host$uri/$extra");
      exit;


?>


