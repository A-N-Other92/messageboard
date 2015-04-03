<!DOCTYPE html>
<html>

      <?php $pagename = "Start new topic";
            include('includes/header.php');
        /*    include('classes/postMessageClass.php' ); */

      ?>

<!-- page content -->

  <div class="row">
    <div class="col-md-8">



          <form method="post" action="topic_check.php">
            <div class="form-group">
              <h3>Start a new thread</h3>
              <input type="text" class="form-control" name = "topicname" placeholder="Enter the name of the thread (max 60 chars)" maxlength="60"><BR>
              <button type="submit" class="btn btn-default">Submit</button>
            </div>

          </form>


    </div>
    <div class="col-md-4">





    </div>
  </div>




<!-- end of page content -->



      <?php include('includes/footer.php'); ?>






    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  </body>
</html>

