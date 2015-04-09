<?php

class registerEmail {

      protected $to;
      protected $subject;
      protected $body;
      protected $mime;

      function __construct($t,$s,$b,$m) {
          $this->to       = trim($t);
          $this->subject  = trim($s);
          $this->body     = trim($b);
          $this->mime     = trim($m);

          $this->sendEmail();
      }


      private function sendEmail() {

          mail($this->to,$this->subject,$this->body,$this->mime);

      }


}  //  end of registerEmail class

?>
