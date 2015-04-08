<?php

class showMessages {

      protected $messagestart;
      protected $topicmessage;
      protected $messagedisplay;

      function __construct($ms,$tm,$md) {
          $this->messagestart   = $ms;
          $this->topicmessage   = $tm;
          $this->messagedisplay  = $md;

          $this->listMessages($this->messagestart);
      }


      private function listMessages($ms) {

           try {

              // Create the object:
   
              $pdo = new PDO('mysql:dbname=a8978141_1;host=mysql3.000webhost.com','a8978141_1','leephp1');   // put this outside htdocs with an include and a parameter on line above for database

              $qry = "SELECT * FROM topic WHERE $this->topicmessage = topicid LIMIT 1";
              $results = $pdo->query($qry);

              $results->setFetchMode(PDO::FETCH_ASSOC);

              while ($row = $results->fetch()){

                 echo  '<h3>' . $row['topicname'] .  '</h3>';

              }

              // Unset the object:
              unset($pdo);

          } catch (PDOException $e) { // Report the error!
              echo '<p class="error">An error occurred: ' . $e->getMessage() . '</p>';
              exit;
          }   // end of catch-try block



          try {

              // Create the object:

              $pdo = new PDO('mysql:dbname=a8978141_1;host=mysql3.000webhost.com','a8978141_1','leephp1');   // put this outside htdocs with an include and a parameter on line above for database

              $qry = "SELECT * FROM messages WHERE $this->topicmessage = topicid";     /* Find out how many messages are in this thread */
              $results = $pdo->query($qry);
              $message_count = $results->rowCount();

              if($message_count > $this->messagedisplay) {
                 $pages = ceil($message_count/$this->messagedisplay);
              }
              else {
                 $pages = 1;
              }


              $qry = "SELECT * FROM messages, users WHERE $this->topicmessage = topicid AND users.userid = messages.userid ORDER BY date_posted, messageid LIMIT $ms, $this->messagedisplay ";
              $results = $pdo->query($qry);

              $results->setFetchMode(PDO::FETCH_ASSOC);

              while ($row = $results->fetch()){

      /*         echo  $row['userid'] . ' ' . $row['username'] . ' ' .  $row['message'] . ' ' . $row['date_posted'] .  '<BR>';

                 echo '<BR>';
     */

                 echo '<table class="table table-bordered">';

                 echo '<tr><td class="col-md-1">' . $row['date_posted'] . '</td><td class="col-md-2">' . $row['username'] . '</td><td class="col-md-5">' .  $row['message'] . '</td></tr>';

                 echo '</table>';


              }

              if ($pages > 1) {

	          echo '<br /><p>';
	          $current_page = ($this->messagestart/$this->messagedisplay) + 1;


        	  // Make all the numbered pages:
	         for ($i = 1; $i <= $pages; $i++) {
	          	  if ($i != $current_page) {
		          echo '<a href="messagepage.php?s=' . (($this->messagedisplay * ($i - 1))) . '&topic=' . $this->topicmessage . '">' . $i . '</a> ';
		          } else {
		          echo $i . ' ';
	                  }
     	         } // End of FOR loop.

	         echo '</p>';

              }

              // Unset the object:
              unset($pdo);

          } catch (PDOException $e) { // Report the error!
              echo '<p class="error">An error occurred: ' . $e->getMessage() . '</p>';
              exit;
          }   // end of catch-try block

      }  // end of listMessages function


}  //  end of showMessage class

?>































