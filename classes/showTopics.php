<?php

class showTopics {

      protected $topicstart;
      protected $topicdisplay;


      function __construct($ts,$td) {
          $this->topicstart  = $ts;
          $this->topicdisplay  = $td;

          $this->listTopics();
      }


      private function listTopics() {


          try {

              // Create the object:

              $pdo = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST , DB_USER , DB_PASS);   // put this outside htdocs with an include and a parameter on line above for database

              $qry = "SELECT * FROM topic ORDER BY topicid";     /* Find out how many topics altogether */
              $results = $pdo->query($qry);
              $topic_count = $results->rowCount();

              if($topic_count > $this->topicdisplay) {
                 $pages = ceil($topic_count/$this->topicdisplay);
              }
              else {
                 $pages = 1;
              }



              $qry = "SELECT * FROM topic ORDER BY topicid DESC LIMIT $this->topicstart, $this->topicdisplay";    /* list a page of topics */
              $results = $pdo->query($qry);

              $results->setFetchMode(PDO::FETCH_ASSOC);

              echo '<table class="table table-bordered">';

              while ($row = $results->fetch()){

                 $qry2 = "SELECT messageid FROM messages WHERE topicid =" . $row['topicid'];
                 $results2 = $pdo->query($qry2);
                 $messagecount = $results2->rowCount();

                 echo '<tr class="underline" ><td class="col-md-6" ><a class="underline" href="index.php?topicmess=' . $row['topicid'] . '">' . $row['topicname'] . '</a></td><td class="col-md-2">' . $messagecount . ' messages </td></tr>';
             

              }

              echo '</table>';                

                

              if ($pages > 1) {

	          echo '<br /><p>';
	          $current_page = ($this->topicstart/$this->topicdisplay) + 1;

                 echo '<div class="underline">';   
                 echo '<table class="table-bordered"><tr>';
                 
        	  // Make all the numbered pages:
	         for ($i = 1; $i <= $pages; $i++) {
	          	  if ($i != $current_page) {
		          echo '<td class="cellpad5"><a href="topicpage.php?s=' . (($this->topicdisplay * ($i - 1))) . '">' . $i . '</a></td>';
		          } else {
		          echo '<td class="cellpad5">' . $i . '</td>';
	                  }
     	         } // End of FOR loop.

                 echo '</tr></table>';
                 echo '</div>';
                
	         echo '</p>';

              }

              unset($pdo);

          } catch (PDOException $e) { // Report the error!
              echo '<p class="error">An error occurred: ' . $e->getMessage() . '</p>';
              exit;
          }   // end of catch-try block

      }  // end of listTopics function


}  //  end of addUser class
