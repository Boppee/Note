<?php

  header('Content-type: application/json');

  session_start();
  require_once '../../../php/load.php';
  $salt = new salt();

  //grabing userinputs
  $uid = $_POST["uid"];
  $salt = $_POST["salt"];
  $pwd = $_POST["pwd"];
  //check if value are set
  $uid = strip_tags($uid);
  $salt = strip_tags($salt);
  $pwd = strip_tags($pwd);

  if (in_array("login", $_SESSION["perms"]["perms"])) {
    if (!isset($_SESSION["signedIn"])) {
      if (isset($pwd) && isset($salt) && isset($uid)) {
        if ($_SESSION["logincaptcha"]) {
          if ($salt->verifySalt("login", $salt)) {

            $enc = new encoder("private");

            $userData = grabUserData($uid);

            if ($userData["active"]) {
              if (password_verify($pwd, $userData["password"])) {

                $email = $enc->decode($userData["email"], $userData["iv"]);
                $vEmail = new vEmail($email);

                $sEmail = $enc->encode($vEmail->getCode(), $_SESSION["iv"]);

                $_SESSION["loginAttempt"] = array(
                  'username' => $uid,
                  'password' => $pwd,
                  'sessionCode' => $sEmail
                );

                $echoArray = array('salt' => $salt->generatSalt("returnLoginSalt"), 'status' => 'pass');
                unset($_SESSION["logincaptcha"]);
                echo json_encode($echoArray);

              }else {
                echo "password or username";
              }
            }else {
              echo "inactive user";
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
  }else {
    echo "fuck off bot fgt";
  }
?>
