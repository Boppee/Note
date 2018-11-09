<?php
  session_start();

  require_once '../../../php/load.php';

  $enc = new encoder("private");
  $salt = new salt();

  $userData = grabUserData($_SESSION["loginAttempt"]["username"]);

  $postSalt = $_POST["salt"];

  $sessionCode = $enc->decode($_SESSION["loginAttempt"]["sessionCode"], $_SESSION["iv"]);
  $postCode = strip_tags($_POST["code"]);

  if ($salt->verifySalt("returnLoginSalt", $postSalt)) {
    if ($sessionCode == $postCode) {

      $enc->setKey("public");

      $credArray = array(
        'uid' => $enc->encode($_SESSION["loginAttempt"]["username"], $_SESSION["iv"]),
        'pwd' => $enc->encode($_SESSION["loginAttempt"]["password"], $_SESSION["iv"])
      );

      $perms = array(
        'pages' => json_decode($userData["pages"]),
        'perms' => json_decode($userData["perms"])
      );

      unset($_SESSION["loginAttempt"]);
      unset($_SESSION["perms"]);

      $_SESSION["signedIn"] = true;
      $_SESSION["cred"] = $credArray;
      $_SESSION["perms"] = $perms;

    }else {
      echo "wrong code";
    }
  }else {
    echo "salt";
  }
?>
