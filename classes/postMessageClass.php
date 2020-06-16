<?php

class postMessageClass
{

  protected $topicid;

  function __construct($tid)
  {

    $this->topicid  = $tid;

    $this->postMessage($this->topicid);
  }


  private function postMessage($a)
  {

    try {

      // Create the object:

      $pdo = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST, DB_USER, DB_PASS);   // put this outside htdocs with an include and a parameter on line above for database


      $qry = "SELECT * FROM topic WHERE $a = topicid LIMIT 1";
      $results = $pdo->query($qry);

      $results->setFetchMode(PDO::FETCH_ASSOC);

      while ($row = $results->fetch()) {

        echo  '<h3>' . $row['topicname'] .  '</h3>';
      }

      // Unset the object:
      unset($pdo);
    } catch (PDOException $e) { // Report the error!
      echo '<p class="error">An error occurred: ' . $e->getMessage() . '</p>';
      exit;
    }   // end of catch-try block


    echo '<form method="post" action="message_check.php">
            <div class="form-group">
              <label class="sr-only" for="messagebox">Enter your message</label>
              <textarea class="form-control" rows="8" id="messagebox" name="messagebox" placeholder="Enter your message here (max 700 chars)" maxlength="700"></textarea><BR>
              <input type="hidden" name=topic value=' . $this->topicid  . ' />
              <button type="submit" class="btn btn-default">Submit message</button>
            </div>

          </form>';
  }  // end of postMessage function



}  //  end of postMessageClass class
