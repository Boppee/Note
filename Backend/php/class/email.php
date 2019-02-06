<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require 'PHPMailer/src/Exception.php';
  require 'PHPMailer/src/PHPMailer.php';
  require 'PHPMailer/src/SMTP.php';
  //class to send a verification Email
  class vEmail extends company{

    private $send;

    function __construct($email){
      $mail = new PHPMailer();
      $mail->IsSMTP(); // enable SMTP
      $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
      $mail->SMTPAuth = true; // authentication enabled
      $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
      $mail->Host = "smtp.gmail.com";
      $mail->Port = 465; // or 587
      $mail->IsHTML(true);
      $mail->Username = "webutvecklingemail@gmail.com";
      $mail->Password = "Emil7670";
      $mail->SetFrom("webutvecklingemail@gmail.com", $this->companyName);

      $mail->addAddress($email);

      $mail->Subject  = 'Email verification from '.$this->companyName;

      $this->send = "test";//generateRandomString(10);

      $mail->Body = $this->send;

      $mail->send();
    }

    public function getCode() {
      return $this->send;
    }

  }
  class changePwd extends company {

    private $send;

    function __construct($senderEmail, $link) {
      $mail = new PHPMailer();
      $mail->IsSMTP(); // enable SMTP
      $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
      $mail->SMTPAuth = true; // authentication enabled
      $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
      $mail->Host = "smtp.gmail.com";
      $mail->Port = 465; // or 587
      $mail->IsHTML(true);
      $mail->Username = "webutvecklingemail@gmail.com";
      $mail->Password = "Emil7670";
      $mail->SetFrom("webutvecklingemail@gmail.com", $this->companyName);

      $mail->addAddress($senderEmail);
      $mail->Subject  = 'Email verification from '.$this->companyName;
      $this->send = $link;
      $mail->Body = $this->send;

      $mail->send();
    }
  }

?>
