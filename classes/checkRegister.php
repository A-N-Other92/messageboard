<?php

class checkRegister {

   protected  $username;
   protected  $email1;
   protected  $email2;
   protected  $password1;
   protected  $password2;


   function __construct($un,$em1,$em2,$pw1,$pw2) {
      $this->username = trim($un);
      $this->email1 = trim($em1);
      $this->email2 = trim($em2);
      $this->password1 = trim($pw1);
      $this->password2 = trim($pw2);

      $_SESSION['regErrors'] = array();

      $this->validateReg();
      $this->checkDatabase();

   }

   private function validateReg() {

      /* check username */

      if($this->username=='') {

         $_SESSION['regErrors']['emptyname'] = "Please enter a username!";
         
      }


      /* Check password */

      if($this->password1 != $this->password2) {

         $_SESSION['regErrors']['passmatch'] = "The passwords don't match!";

      }

      if(strlen($this->password1) < 4) {

         $_SESSION['regErrors']['passlength'] = "The password is under 4 characters long!";

      }

      if(strlen($this->password1) > 20) {

         $_SESSION['regErrors']['passlength'] = "The password is over 20 characters long!";
          
      }

      /* check email */

      if($this->email1 != $this->email2) {

         $_SESSION['regErrors']['emailmatch'] = "The email addresses don't match";

      }

      if($this->email1 == '') {

         $_SESSION['regErrors']['emailblank'] = "Please enter your email address!";

      }




   } // end of validateReg()


   private function checkDatabase() {

      try {
                                                                                        
          // Create the object:  
                                                       
          $pdo = new PDO('mysql:dbname=a8978141_1;host=mysql3.000webhost.com','a8978141_1','leephp1');   // put this outside htdocs with an include and a parameter on line above for database

          $q = "SELECT username FROM users WHERE username = '$this->username' "  ;
          $r=$pdo->query($q);
          if($r->rowCount() > 0) {

             $_SESSION['regErrors']['nametaken'] = "That username is already taken!";

          }

          // set session variables as needed


          $q = "SELECT email FROM users WHERE email = '$this->email1'";
          $r=$pdo->query($q);
          if($r->rowCount() > 0) {

             $_SESSION['regErrors']['emailtaken'] = "That email address is already registered!";

          }


          unset($pdo);

      } catch (PDOException $e) { // Report the error!
          echo '<p class="error">An error occurred: ' . $e->getMessage() . '</p>';
          exit;
      }   // end of catch-try block


   } // end of checkDatabase()




   public function redirectPage() {

      if(get_magic_quotes_gpc()) {

         $this->username = stripslashes($this->username); 
         $this->email1 = stripslashes($this->email1); 
         $this->email2 = stripslashes($this->email2);      
      }

      $_SESSION['register']['username']   = $this->username;
      $_SESSION['register']['email1']     = $this->email1;
      $_SESSION['register']['email2']     = $this->email2;
      $_SESSION['register']['password1']  = $this->password1;
      $_SESSION['register']['password2']  = $this->password2;


      $host  = $_SERVER['HTTP_HOST'];
      $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

      if(empty($_SESSION['regErrors'])) {

      $extra = 'regEmail.php';  // change accordingly

      }
      else {

      $extra = 'register.php';  // change accordingly

      }

      header("Location: http://$host$uri/$extra");
      exit;


   }    // end of redirectPage()

}  //  endof checkRegister class

?>
