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

           echo '<h3><a href="index.php?topicmess=' . $tpc . '">Message posted! Click here to see it.</a></h3>';

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

