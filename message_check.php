<?php

    session_start();

    if(isset($_POST['messagebox']) && !empty($_POST['messagebox']) && isset($_POST['topic']) ) {

          $tpc = $_POST['topic'];
          $uid = (int)$_SESSION['loggedin']['id'];
          $mess =  (string)TRIM($_POST['messagebox']);

          try {

              // Create the object:
              $pdo = new PDO('mysql:dbname=messageboard1;host=localhost', 'root', '');

              $qry = "INSERT INTO messages (topicid,userid,message,date_posted) VALUES ('$tpc','$uid','$mess',NOW() )";

              $results = $pdo->exec($qry);

              unset($pdo);

              $extra = 'verifymessage.php?topic=' . $tpc ;


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


