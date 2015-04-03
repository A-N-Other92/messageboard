<!DOCTYPE html>
<html>

      <?php $pagename = "Account activated";
            include('includes/header.php');
            include('./classes/activateAccount.php') ?>

<!-- page content -->


<!-- end of page content -->

      <?php

         if(isset($_GET['un']) && isset($_GET['em'])) {

            $activate = new activateAccount($_GET['un'],$_GET['em']);  /* write activateAccount class */

            unset($activate);
         }
         else {

            $host  = $_SERVER['HTTP_HOST'];
            $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra = 'index.php';  // change accordingly

            header("Location: http://$host$uri/$extra");       /* send to index page if there registration errors or no register values */
            exit();


         }

      ?>



      <?php include('includes/footer.php'); ?>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  </body>
</html>

