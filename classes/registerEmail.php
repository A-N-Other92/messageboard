<?php

class registerEmail {

      protected $to;
      protected $subject;
      protected $body;

      function __construct($t,$s,$b) {
          $this->to       = trim($t);
          $this->subject  = trim($s);
          $this->body     = trim($b);

          $this->sendEmail();
      }


      private function sendEmail() {

          mail($this->to,$this->subject,$this->body);

      }


}  //  end of registerEmail class

?>
