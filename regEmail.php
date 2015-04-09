<!DOCTYPE html>
<html>

      <?php $pagename = "Email Sent";
            include('includes/header.php');
            include('./classes/registerEmail.php');
            include('./classes/addUser.php');
      ?>

<!-- page content -->

      <?php

        if(!empty($_SESSION['regErrors']) || empty($_SESSION['register']) ) {

            $host  = $_SERVER['HTTP_HOST'];
            $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra = 'index.php';  // change accordingly

            header("Location: http://$host$uri/$extra");       /* send to index page if there registration errors or no register values */
            exit();
        }


       /* Add new user to database but doesn't register them */

       $newuser =new addUser($_SESSION['register']['username'],$_SESSION['register']['email1'],$_SESSION['register']['password1']);

       unset($newuser);

       /* send email to new user so they can register */

         $regmail = new registerEmail($_SESSION['register']['email1'],
                                      "Messageboard details",
                                      "<h3>To register for the message board click the link below</h3>
                                      <h2><a href=http://www.examples.net84.net/messageboard/activate_account.php?un=" . $_SESSION['register']['username'] . "&em=" . $_SESSION['register']['email1'] . ">Click here to register on the messageboard</a></h2><BR>
                                      Your username is " . $_SESSION['register']['username'] . "<BR><BR> Your password is " . $_SESSION['register']['password1'] . "<BR>",
                                      "MIME-Version: 1.0\r\nContent-type: text/html; charset=charset=ISO-8859-1\r\nFrom:www.examples.net84.net\r\n");



       unset($regmail);

      if(isset($_SESSION['register']))
      {
         $_SESSION ['register']= array();
         setcookie(session_name(),'',time()-3600);
         session_destroy();
      }

      echo "<h4>You have been sent an email which contains your login details and a link to click to activate your account</h4>";

      ?>

<!-- end of page content -->



      <?php include('includes/footer.php'); ?>






    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  </body>
</html>

