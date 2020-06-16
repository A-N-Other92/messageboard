<!DOCTYPE html>
<html>

<?php $pagename = "Login";
include('includes/header.php'); ?>

<!-- page content -->

<div class="row">
  <div class="col-md-4">
    <form class="form" action="login_check.php" method="post">

      <div class="form-group">
        <?php if (isset($_SESSION['loginErrors']['emptyname'])) {
          echo $_SESSION['loginErrors']['emptyname'] . '<BR>';
        }
        ?>
      </div>

      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" id="username" placeholder="username" <?php if (isset($_SESSION['login']['username'])) {
                                                                                                        echo 'value= "' . $_SESSION['login']['username'] . '"';
                                                                                                      }  ?>>
      </div>

      <div class="form-group">
        <?php if (isset($_SESSION['loginErrors']['emptypass'])) {
          echo $_SESSION['loginErrors']['emptypass'] . '<BR>';
        }
        ?>
      </div>

      <div class="form-group">
        <?php if (isset($_SESSION['loginErrors']['nonmatch'])) {
          echo $_SESSION['loginErrors']['nonmatch'] . '<BR>';
        }
        ?>
      </div>

      <div class="form-group">
        <label for="">Password</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="password" <?php if (isset($_SESSION['login']['password'])) {
                                                                                                            echo 'value= "' . $_SESSION['login']['password'] . '"';
                                                                                                          }  ?>>
      </div>
      <button type="submit" class="btn btn-default">Login</button>


    </form>
    <BR>

  </div>


  <div class="col-md-8 ">

  </div>



</div>




<!-- initialize the session variables of the form if set  -->

<?php
if (isset($_SESSION['login'])) {
  $_SESSION['login'] = array();
  setcookie(session_name('login'), '', time() - 3600);
  //     session_destroy();
}

if (isset($_SESSION['loginErrors'])) {
  $_SESSION['loginErrors'] = array();
  setcookie(session_name('loginErrors'), '', time() - 3600);
  //   @session_destroy();                       // remove warning from potentially un-initialised session being destroyed
}


?>



<!-- end of page content -->


<?php include('includes/footer.php'); ?>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>

</html>