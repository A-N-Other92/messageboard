<!DOCTYPE html>
<html>

<?php $pagename = "Message board";
include('includes/header.php');
include('classes/postMessageClass.php');

?>

<!-- page content -->

<div class="row">
  <div class="col-md-8">

    <?php

    $postmessage = new postMessageClass($_GET['topicno']);

    ?>

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