<?php

   session_start();
   include('./classes/checkLogin.php');


   if(isset($_POST['username'])) {$username=$_POST['username'];} else {$username="";}
   if(isset($_POST['password'])) {$password=$_POST['password'];} else {$password="";}

   $loginForm = new checkLogin($username,$password);

   $loginForm->redirectPage();


?>


