<?php

    session_start();
    include('config.php');  // Put above htdocs folder for extra security

      if(isset($_POST['topicname']) && TRIM($_POST['topicname']) != "" ) {

          $topicname = (string)TRIM($_POST['topicname']);

          $topicname = htmlentities($topicname);    
          $topicname = strip_tags($topicname);

          $uid = (int)$_SESSION['loggedin']['id'];

          try {

              // Create the object:

              $pdo = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST , DB_USER , DB_PASS);   // put this outside htdocs with an include and a parameter on line above for database

              $qry = "INSERT INTO topic (topicname,userid) VALUES (:tpcn,:uid )";
              $stmt = $pdo->prepare($qry);

              $results = $stmt->execute(array(':tpcn' => $topicname,':uid' => $uid)); 

              $tpc = $pdo->lastInsertId();

              unset($pdo);

              $extra = 'post_message.php?topicno=' . $tpc ;


          } catch (PDOException $e) { // Report the error!
              echo '<p class="error">An error occurred: ' . $e->getMessage() . '</p>';
              exit;
          }   // end of catch-try block


    }
    else {
       $extra = 'index.php';  // change accordingly
    }


    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

    header("Location: http://$host$uri/$extra");
    exit;
