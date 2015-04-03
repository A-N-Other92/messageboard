<?php

class addUser {

      protected $username;
      protected $email;
      protected $password;

      function __construct($u,$e,$p) {
          $this->username  = trim($u);
          $this->email     = trim($e);
          $this->password  = trim($p);

          $this->createUser($this->username,$this->email,$this->password);
      }


      private function createUser($unsafe_un,$unsafe_em,$unsafe_pw) {


          try {

              // Create the object:
              $pdo = new PDO('mysql:dbname=messageboard1;host=localhost', 'root', '');     // put this outside htdocs with an include and a parameter on line above for database

              $username = $pdo->quote($unsafe_un);
              $email    = $pdo->quote($unsafe_em);
              $password = $pdo->quote($unsafe_pw);

              $pdo->exec("INSERT INTO users (username,email,password,password_enc) VALUES ($username,$email,$password,SHA1($password))");

              // Unset the object:
              unset($pdo);

          } catch (PDOException $e) { // Report the error!
              echo '<p class="error">An error occurred: ' . $e->getMessage() . '</p>';
              exit;
          }   // end of catch-try block

      }  // end of createUser function


}  //  end of addUser class

?>































