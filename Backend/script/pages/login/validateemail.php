<?php
  session_start();

  require_once '../../../php/load.php';

  $enc = new encoder("private");

  $userData = grabUserData($_SESSION["loginAttempt"]["username"]);

  $sessionSalt = $enc->decode($_SESSION["loginAttempt"]["salt"], $_SESSION["iv"]);
  $postSalt = $_POST["salt"];

  $sessionCode = $enc->decode($_SESSION["loginAttempt"]["sessionCode"], $_SESSION["iv"]);
  $postCode = strip_tags($_POST["code"]);

  if ($sessionSalt == $postSalt) {
    if ($sessionCode == $postCode) {

      $credArray = array(
        'uid' => $_SESSION["loginAttempt"]["username"],
        'pwd' => $_SESSION["loginAttempt"]["password"],
      );
      // FIXME: need to add pages and perms

    }else {
      echo "wrong code";
    }
  }else {
    echo "salt";
  }
?>
