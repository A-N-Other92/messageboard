<?php

    session_start();

    if(isset($_POST['topicname']) && !empty(trim(($_POST['topicname']) ))) {

          $uid = (int)$_SESSION['loggedin']['id'];
          $topicname = TRIM($_POST['topicname']);

          try {

              // Create the object:
              $pdo = new PDO('mysql:dbname=messageboard1;host=localhost', 'root', '');

              $qry = "INSERT INTO topic (topicname,userid) VALUES ('$topicname','$uid')";

              $results = $pdo->exec($qry);

              $tpc = $pdo->lastInsertId();

              unset($pdo);

              $extra = 'post_message.php?topicno=' . $tpc ;


          } catch (PDOException $e) { // Report the error!
              echo '<p class="error">An error occurred: ' . $e->getMessage() . '</p>';
              exit;
          }   // end of catch-try block


    }
    else {

      //   $host  = $_SERVER['HTTP_HOST'];
      //   $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
         $extra = 'index.php';  // change accordingly

     //    header("Location: http://$host$uri/$extra");
     //    exit;

    }


    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
//    $extra = 'index.php';  // change accordingly

    header("Location: http://$host$uri/$extra");
    exit;






?>


