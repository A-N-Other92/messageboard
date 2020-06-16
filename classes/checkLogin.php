<?php

include('config.php');  // Put above htdocs folder for extra security
class checkLogin
{

   protected  $username;
   protected  $password;


   function __construct($un, $pw)
   {
      $this->username = trim($un);
      $this->password = trim($pw);

      $_SESSION['loginErrors'] = array();

      $this->validateLogin();
      $this->checkDatabase();
   }

   private function validateLogin()
   {

      /* check username */

      if ($this->username == '') {

         $_SESSION['loginErrors']['emptyname'] = "Please enter a username!";
      }


      /* Check password */

      if ($this->password == '') {

         $_SESSION['loginErrors']['emptypass'] = "Please enter a password!";
      }
   } // end of validateReg()


   private function checkDatabase()
   {

      try {

         // Create the object:

         $pdo = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST, DB_USER, DB_PASS);   // put this outside htdocs with an include and a parameter on line above for database

         $this->username = htmlentities($this->username);
         $this->password = htmlentities($this->password);
         $this->username = strip_tags($this->username);
         $this->password = strip_tags($this->password);


         $q = "SELECT userid, username FROM users WHERE username = '$this->username' AND password_enc = SHA1('$this->password') AND registered = 'Y' ";
         $r = $pdo->query($q);

         $this->password = "";

         if ($r->rowCount() < 1) {

            $_SESSION['loginErrors']['nonmatch'] = "There is no active account under that username and password!";
         } else {

            $r->setFetchMode(PDO::FETCH_ASSOC);
            $x = $r->fetch();
            $_SESSION['loggedin']['id'] = $x['userid'];
            $_SESSION['loggedin']['name'] = $x['username'];
         }

         // Unset the object:
         unset($pdo);
      } catch (PDOException $e) { // Report the error!
         echo '<p class="error">An error occurred: ' . $e->getMessage() . '</p>';
         exit;
      }   // end of catch-try block


   } // end of checkDatabase()




   public function redirectPage()
   {


      $host  = $_SERVER['HTTP_HOST'];
      $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

      if (empty($_SESSION['loginErrors'])) {

         $extra = 'index.php';  // change accordingly

      } else {

         if (get_magic_quotes_gpc()) {
            $this->username = stripslashes($this->username);
         }  // take slashes out so it prints correctly

         $_SESSION['login']['username']  = $this->username;
         $_SESSION['login']['password']  = $this->password;

         $extra = 'login.php';  // change accordingly

      }

      header("Location: http://$host$uri/$extra");
      exit;
   }    // end of redirectPage()



}  //  endof checkLogin class
