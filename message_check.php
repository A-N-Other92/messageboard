<?php

    session_start();
    include('config.php');  // Put above htdocs folder for extra security

    if(isset($_POST['messagebox']) && !empty($_POST['messagebox']) && isset($_POST['topic']) ) {

          $tpc = $_POST['topic'];
          $uid = (int)$_SESSION['loggedin']['id'];
          $mess =  (string)TRIM($_POST['messagebox']);

          try {

              // Create the object:

              $pdo = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST , DB_USER , DB_PASS);   // put this outside htdocs with an include and a parameter on line above for database   

              $mess = htmlentities($mess);     // Security
              $mess = strip_tags($mess);       // Security

              $qry = "INSERT INTO messages (topicid,userid,message,date_posted) VALUES (:tpc,:uid,:mess,NOW() )";
              $stmt = $pdo->prepare($qry);

              $results = $stmt->execute(array(':tpc' => $tpc,':uid' => $uid,':mess' => $mess));
              
              unset($pdo);

              $extra = 'verifymessage.php?topic=' . $tpc ;


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
