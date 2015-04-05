<!DOCTYPE html>
<html>

      <?php $pagename = "Message OK";
            include('includes/header.php');

            if(isset($_GET['topic'])) {
               $tpc = $_GET['topic'];
            }
            else {
               $tpc = NULL;
            }

      ?>

<!-- page content -->

  <div class="row">
    <div class="col-md-2">




    </div>
    <div class="col-md-8">

        <?php

          try {

                 $messagedisplay = 5;

                 // Create the object:
                 $pdo = new PDO('mysql:dbname=messageboard1;host=localhost', 'root', '');

                 $qry = "SELECT * FROM messages WHERE '$tpc' = topicid";     /* Find out how many messages are in this thread */
                 $results = $pdo->query($qry);
                 $message_count = $results->rowCount();

                 if($message_count > $messagedisplay) {
                    $pages = ceil($message_count/$messagedisplay);
                 }
                 else {
                 $pages = 1;
                 }

                 $pagestart = (int)$messagedisplay * ($pages - 1);

                 // Unset the object:
                 unset($pdo);

              } catch (PDOException $e) { // Report the error!
                  echo '<p class="error">An error occurred: ' . $e->getMessage() . '</p>';
                  exit;
              }   // end of catch-try block




           echo '<h3><a href="messagepage.php?topic=' . $tpc . '&s=' . $pagestart . '">Message posted! Click here to see it.</a></h3>';
       //    echo '<h3><a href="index.php?topicmess=' . $tpc . '&s=' . $pagestart . '">Message posted! Click here to see it.</a></h3>';

        ?>

    </div>
    <div class="col-md-2">





    </div>


  </div>




<!-- end of page content -->



      <?php include('includes/footer.php'); ?>






    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  </body>
</html>

