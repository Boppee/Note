<?php

  header('Content-type: application/json');

  session_start();

  //grabing userinputs
  $uid = $_POST["uid"];
  $salt = $_POST["salt"];
  $pwd = $_POST["pwd"];
  //check if value are set
  $uid = strip_tags($uid);
  $salt = strip_tags($salt);
  $pwd = strip_tags($pwd);

  require_once '../../../php/load.php';

  if (!isset($_SESSION["signedIn"])) {
    if (isset($pwd) && isset($salt) && isset($uid)) {
      if ($_SESSION["logincaptcha"]) {
        unset($_SESSION["logincaptcha"]);
        if ($salt == $_SESSION["salt"]) {

          $enc = new encoder("private");

          $userData = grabUserData($uid);

          if (password_verify($pwd, $userData["pwd"])) {
            $email = $enc-decode($userData["email"], $userData["iv"]);
            $email->sendVerifyEmail();

            $echosalt = uniqid(mt_rand(), true);

            $_SESSION["loginAttempt"] = array(
              'username' => $uid,
              'password' => $pwd,
              'time' => date(),
              'salt' => $echosalt
            );

            $echoArray = array('salt' => $echosalt, );

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
