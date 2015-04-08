<?php

class activateAccount {

      protected $username;
      protected $email;

      function __construct($u,$e) {
          $this->username  = trim($u);
          $this->email     = trim($e);

          $this->accAccount($this->username,$this->email);
      }


      private function accAccount($unsafe_un,$unsafe_em) {


          try {

              // Create the object:
  
              $pdo = new PDO('mysql:dbname=a8978141_1;host=mysql3.000webhost.com','a8978141_1','leephp1');   // put this outside htdocs with an include and a parameter on line above for database

              $username = $pdo->quote($unsafe_un);
              $email    = $pdo->quote($unsafe_em);
              
              $username = htmlentities($username);
              $email    = htmlentities($email);
              
              $username = strip_tags($username);
              $email    = strip_tags($email);

                if($pdo->exec("UPDATE users SET registered = 'Y', date_joined = NOW() WHERE username = $username AND email = $email AND registered IS NULL")) {
                   echo "<h4>You're account as now been activated. You can login</h4>";
                }
                else {
                   echo "<h4>You're Account is already active or you're here by mistake</h4>";
                }

              // Unset the object:
              unset($pdo);

          } catch (PDOException $e) { // Report the error!
              echo '<p class="error">An error occurred: ' . $e->getMessage() . '</p>';
              exit;
          }   // end of catch-try block

      }  // end of accAccount function


}  //  end of activateAccount class

?>































