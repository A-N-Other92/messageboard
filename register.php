<!DOCTYPE html>
<html>

      <?php $pagename = "Register";
            include('includes/header.php'); ?>

<!-- page content -->


      <div class="row">
         <div class="col-md-4">
           <form class="form" action="register_check.php" method="post">

             <div class="form-group">
               <?php if(isset($_SESSION['regErrors']['emptyname'])) {echo $_SESSION['regErrors']['emptyname'] . '<BR>';}
               ?>
             </div>

             <div class="form-group">
               <?php if(isset($_SESSION['regErrors']['nametaken'])) {echo $_SESSION['regErrors']['nametaken'] . '<BR>';}
               ?>
             </div>

             <div class="form-group">
               <label for="">Username</label>
               <input type="text" class="form-control" id="username" name="username" placeholder="username"  <?php if(isset($_SESSION['register']['username'])) { echo 'value= "'. $_SESSION['register']['username'] .'"'; }  ?> >
             </div>

             <div class="form-group">
               <?php if(isset($_SESSION['regErrors']['emailblank'])) {echo $_SESSION['regErrors']['emailblank'] . '<BR>';}
               ?>
             </div>

             <div class="form-group">
               <?php if(isset($_SESSION['regErrors']['emailtaken'])) {echo $_SESSION['regErrors']['emailtaken'] . '<BR>';}
               ?>
             </div>

             <div class="form-group">
               <label for="">Email address</label>
               <input type="email" class="form-control" id="email1" name="email1" placeholder="email address" <?php if(isset($_SESSION['register']['email1'])) { echo 'value= "'. $_SESSION['register']['email1'] .'"'; }  ?> >
             </div>
             
             <div class="form-group">
               <?php if(isset($_SESSION['regErrors']['emailmatch'])) {echo $_SESSION['regErrors']['emailmatch'] . '<BR>';}
               ?>
             </div>

             <div class="form-group">
               <label for="">Confirm email address</label>
               <input type="email" class="form-control" id="email2" name="email2" placeholder="confirm email address" <?php if(isset($_SESSION['register']['email2'])) { echo 'value= "'. $_SESSION['register']['email2'] .'"'; }  ?> >
             </div>
             <div class="form-group">
               <label for="">Password</label>
               <input type="password" class="form-control" id="password1" name="password1" placeholder="password" <?php if(isset($_SESSION['register']['password1'])) { echo 'value= "'. $_SESSION['register']['password1'] .'"'; }  ?> >
             </div>
             

             <div class="form-group">
               <?php if(isset($_SESSION['regErrors']['passmatch'])) {echo $_SESSION['regErrors']['passmatch'] . '<BR>';}
                     if(isset($_SESSION['regErrors']['passlength'])) {echo $_SESSION['regErrors']['passlength'] . '<BR>';}
               ?>
             </div>
             

             <div class="form-group">
               <label for="">Confirm password</label>
               <input type="password" class="form-control" id="password2" name="password2" placeholder="confirm password" <?php if(isset($_SESSION['register']['password2'])) { echo 'value= "'. $_SESSION['register']['password2'] .'"'; }  ?> >
             </div>
             <button type="submit" class="btn btn-default">Register</button>

           </form>

         </div>



         <div class="col-md-8 ">

         </div>



      </div>


      </form>

      <!-- initialize the session variables of the form if set  -->
      
      <?php
      if(isset($_SESSION['register']))
      {
         $_SESSION ['register']= array();
         setcookie(session_name(),'',time()-3600);
         session_destroy();
      }

      if(isset($_SESSION['regErrors']))
      {
         $_SESSION['regErrors'] = array();
         setcookie(session_name(),'',time()-3600);
         @session_destroy();                       // remove warning from potentially un-initialised session being destroyed
      }


      ?>



<!-- end of page content -->

      <?php include('includes/footer.php'); ?>





    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  </body>
</html>

