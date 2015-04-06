<?php

class checkLogin {

   protected  $username;
   protected  $password;


   function __construct($un,$pw) {
      $this->username = trim($un);
      $this->password = trim($pw);

      $_SESSION['loginErrors'] = array();

      $this->validateLogin();
      $this->checkDatabase();

   }

   private function validateLogin() {

      /* check username */

      if($this->username=='') {

         $_SESSION['loginErrors']['emptyname'] = "Please enter a username!";

      }


      /* Check password */

      if($this->password == '') {

         $_SESSION['loginErrors']['emptypass'] = "Please enter a password!";

      }


   } // end of validateReg()


   private function checkDatabase() {

      try {

          // Create the object:
          $pdo = new PDO('mysql:dbname=messageboard1;host=localhost', 'root', '');        // put this outside htdocs with an include and a parameter on line above for database

          $this->username = htmlentities($this->username);      // Security
          $this->password = htmlentities($this->password);
          $this->username = strip_tags($this->username);
          $this->password = strip_tags($this->password);       // Security

          //  $mess = mysql_real_escape_string($mess);    Use this if all else fails
          $this->username = $pdo->quote($this->username);
          $this->password = $pdo->quote($this->password);


          $q = "SELECT userid, username FROM users WHERE username = $this->username AND password_enc = SHA1($this->password) AND registered = 'Y' "  ;
          $r=$pdo->query($q);
          
          $this->username = str_replace('\'','',$this->username);  // remove quotes from username that were used for security
          $this->password = "";

          if($r->rowCount() < 1) {

             $_SESSION['loginErrors']['nonmatch'] = "There is no active account under that username and password!";

          }
          else  {

             $r->setFetchMode(PDO::FETCH_ASSOC);
             $x=$r->fetch();
             $_SESSION['loggedin']['id'] = $x['userid'];
             $_SESSION['loggedin']['name'] = $x['username'];

          }

          // set session variables as needed

          // Unset the object:
          unset($pdo);

      } catch (PDOException $e) { // Report the error!
          echo '<p class="error">An error occurred: ' . $e->getMessage() . '</p>';
          exit;
      }   // end of catch-try block


   } // end of checkDatabase()




   public function redirectPage() {


      $host  = $_SERVER['HTTP_HOST'];
      $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

      if(empty($_SESSION['loginErrors'])) {

         $extra = 'index.php';  // change accordingly

      }
      else {

         $_SESSION['login']['username']  = $this->username;
         $_SESSION['login']['password']  = $this->password;

         $extra = 'login.php';  // change accordingly

      }

      header("Location: http://$host$uri/$extra");
      exit;


   }    // end of redirectPage()



}  //  endof checkLogin class


?>
