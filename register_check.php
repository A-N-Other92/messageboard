<?php

   session_start();
   include('./classes/checkRegister.php');


   if(isset($_POST['username'])) {$username=$_POST['username'];} else {$username="";}
   if(isset($_POST['email1'])) {$email1=$_POST['email1'];} else {$email1="";}
   if(isset($_POST['email2'])) {$email2=$_POST['email2'];} else {$email2="";}
   if(isset($_POST['password1'])) {$password1=$_POST['password1'];} else {$password1="";}   
   if(isset($_POST['password2'])) {$password2=$_POST['password2'];} else {$password2="";}

   $regForm = new checkRegister($username,$email1,$email2,$password1,$password2);
   
   $regForm->redirectPage();


?>


