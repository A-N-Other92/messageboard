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
         echo "Empty username";

      }


      /* Check password */

      if($this->password1 != $this->password2) {

         $_SESSION['regErrors']['passmatch'] = "The passwords don't match!";
           echo "Passwords don't match";

      }

      if(strlen($this->password1) < 4) {

         $_SESSION['regErrors']['passlength'] = "The password is under 4 characters long!";
           echo "Password under 4 chars";

      }

      if(strlen($this->password1) > 20) {

         $_SESSION['regErrors']['passlength'] = "The password is over 20 characters long!";
           echo "Password over 20 chars";

      }

      /* check email */

      if($this->email1 != $this->email2) {

         $_SESSION['regErrors']['emailmatch'] = "The email addresses don't match";
           echo "The email addresses don't match";

      }

      if($this->email1 == '') {

         $_SESSION['regErrors']['emailblank'] = "Please enter your email address!";
           echo "Please enter your email address!";

      }




   } // end of validateReg()


   private function checkDatabase() {

      try {
                                                                                        
          // Create the object:                                                         
          $pdo = new PDO('mysql:dbname=messageboard1;host=localhost', 'root', '');        // put this outside htdocs with an include and a parameter on line above for database

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

          // set session variables as needed

          // Unset the object:
          unset($pdo);

      } catch (PDOException $e) { // Report the error!
          echo '<p class="error">An error occurred: ' . $e->getMessage() . '</p>';
          exit;
      }   // end of catch-try block


   } // end of checkDatabase()




   public function redirectPage() {

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
