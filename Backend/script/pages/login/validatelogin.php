<?php

  header('Content-type: application/json');

  session_start();
  require_once '../../../php/load.php';

  //grabing userinputs
  $uid = $_POST["uid"];
  $salt = $_POST["salt"];
  $pwd = $_POST["pwd"];
  //check if value are set
  $uid = strip_tags($uid);
  $salt = strip_tags($salt);
  $pwd = strip_tags($pwd);

  if (!isset($_SESSION["signedIn"])) {
    if (isset($pwd) && isset($salt) && isset($uid)) {
      if ($_SESSION["logincaptcha"]) {
        if ($salt == $_SESSION["salt"]) {

          $enc = new encoder("private");

          $userData = grabUserData($uid);

          if (password_verify($pwd, $userData["password"])) {
            $email = $enc->decode($userData["email"], $userData["iv"]);
            $vEmail = new vEmail($email);

            $sEmail = $enc->encode($vEmail->getCode(), $_SESSION["iv"]);

            $echosalt = uniqid(mt_rand(), true);

            $sessionSalt = $enc->encode($echosalt, $_SESSION["iv"]);

            $_SESSION["loginAttempt"] = array(
              'username' => $uid,
              'password' => $pwd,
              'salt' => $sessionSalt,
              'sessionCode' => $sEmail
            );

            $echoArray = array('salt' => $echosalt, 'status' => 'pass');
            unset($_SESSION["logincaptcha"]);
            echo json_encode($echoArray);

          }else {
            echo "password or username";
          }
        }else {
          echo "salt error";
        }
      }else {
        echo "captcha error";
      }
    }else {
      echo "missing inputs";
    }
  }else {
    goToPage("?page=dashboard");
  }
?>
