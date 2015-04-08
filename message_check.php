<?php

    session_start();

    if(isset($_POST['messagebox']) && !empty($_POST['messagebox']) && isset($_POST['topic']) ) {

          $tpc = $_POST['topic'];
          $uid = (int)$_SESSION['loggedin']['id'];
          $mess =  (string)TRIM($_POST['messagebox']);

          try {

              // Create the object:

              $pdo = new PDO('mysql:dbname=a8978141_1;host=mysql3.000webhost.com','a8978141_1','leephp1');   // put this outside htdocs with an include and a parameter on line above for database

              $mess = htmlentities($mess);     // Security
              $mess = strip_tags($mess);       // Security

          //  $mess = mysql_real_escape_string($mess);    Use this if all else fails
          //  $mess = $pdo->quote($mess);                 not needed this time

              $qry = "INSERT INTO messages (topicid,userid,message,date_posted) VALUES ('$tpc','$uid','$mess',NOW() )";    // No quotes on $mess when put through PDO quote

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


