<!DOCTYPE html>
<html>
<?php
$pagename = "Message board";
include('includes/header.php');
include('classes/showTopics.php');
include('classes/showMessages.php');
?>
<!-- page content -->

<div class="row">
   <div class="col-md-8">


      <?php

      if (!isset($_GET['topicmess'])) {

         $_SESSION['messagestart'] = 0;    // messages start from page one when selected from thread page

         echo '<h3>Topics</h3>';

         if (isset($_SESSION['topicstart'])) {
            $topicstart = $_SESSION['topicstart'];
         } else {
            $topicstart = 0;
         }

         $showtopics = new showTopics($topicstart, 5);
      } else {

         if (isset($_SESSION['messagestart'])) {
            $messagestart = $_SESSION['messagestart'];
         } else {
            $messagestart = 0;
         }

         $showmessages = new showMessages($messagestart, $_GET['topicmess'], 5);

         echo '<BR>';

         if (isset($_SESSION['loggedin'])) {
            echo '<div class="underline"><a href="post_message.php?topicno=' . $_GET['topicmess'] . '"><h4>Submit a message</h4></a></div>';
         } else {
            echo '<h4>You must be logged in to post a message</h4>';
         }

         echo '<BR>';

         echo '<div class="underline"><a href="topicreset.php"><h4>Return to list of threads</h4></a></div>';
      }

      ?>


      <?php
      if (!isset($_GET['topicmess'])) {

         if (isset($_SESSION['loggedin'])) {
            echo '<div class="underline"><a href="newtopic.php"><h3>Start a new topic</h3></a></div>';
         } else {
            echo '<h3>You must be logged in to start a new topic</h3>';
         }
      }
      ?>

   </div>
   <div class="col-md-4">

      <!--  Room for additional content on the right of messages and threads     -->


   </div>
</div>


<!-- end of page content -->


<?php include('includes/footer.php'); ?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>