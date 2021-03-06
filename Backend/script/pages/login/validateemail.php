<?php

  header('Content-type: application/json');

  session_start();

  require_once '../../../php/load.php';

  $enc = new encoder("private");
  $salt = new salt();

  $userData = grabUserData($_SESSION["loginAttempt"]["username"]);

  $postSalt = strip_tags($_POST["salt"]);

  $sessionCode = $enc->decode($_SESSION["loginAttempt"]["sessionCode"], $_SESSION["iv"]);
  $postCode = strip_tags($_POST["code"]);

  if ($salt->verifySalts("returnLoginSalt", $postSalt)) {
    if ($sessionCode == $postCode) {

      $enc->setKey("public");

      $credArray = array(
        'uid' => $enc->encode($_SESSION["loginAttempt"]["username"], $_SESSION["iv"]),
        'pwd' => $enc->encode($_SESSION["loginAttempt"]["password"], $_SESSION["iv"])
      );

      $_SESSION["new_permsys"] = json_decode($userData["new_permsys"], true);

      updateLogon($_SESSION["loginAttempt"]["username"]);

      unset($_SESSION["loginAttempt"]);
      unset($_SESSION["perms"]);
      unset($_SESSION["pages"]);

      $_SESSION["signedIn"] = true;
      $_SESSION["cred"] = $credArray;
      if (isset($_SESSION["afterlogin"])) {
        $echoArray = array('status' => "pass", 'page' => $_SESSION["afterlogin"]);
      }else {
        $echoArray = array('status' => "pass", 'page' => "?page=".$_SESSION["new_permsys"][0]);
      }

      unset($_SESSION["afterlogin"]);
      echo json_encode($echoArray);

    }else {
      $errors["error"] = "wrong code";
    }
  }else {
    $errors = array("salt");
  }
  if (isset($errors)) {
    $errors["salt"] = $salt->generatSalt("returnLoginSalt");
    echo json_encode($errors);
  }
?>
