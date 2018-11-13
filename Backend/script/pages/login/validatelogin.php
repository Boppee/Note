<?php

  header('Content-type: application/json');

  session_start();
  require_once '../../../php/load.php';

  $salt = new salt();

  //check if value are set
  $uid = strip_tags($_POST["uid"]);
  $postSalt = strip_tags($_POST["salt"]);
  $pwd = strip_tags($_POST["pwd"]);

  if (in_array("login", $_SESSION["perms"]["perms"])) {
    if (!isset($_SESSION["signedIn"])) {
      if (isset($pwd) && isset($salt) && isset($uid)) {
        if ($_SESSION["logincaptcha"]) {
        if ($salt->verifySalts("login", $postSalt)) {

            $enc = new encoder("private");

            $userData = grabUserData($uid);

            if (isset($userData["username"])) {
              if (password_verify($pwd, $userData["password"])) {
                if ($userData["active"]) {
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
                  $errors = array("inactive user");
                }
              }else {
                $errors = array("password or username");
              }
            }else {
              $errors = array("password or username");
            }
          }else {
            $errors = array("salt error");
          }
        }else {
          $errors = array("captcha error");
        }
      }else {
        $errors = array("missing inputs");
      }
    }else {
      goToPage("?page=dashboard");
    }
  }
  if (isset($errors)) {
    $errorArray["salt"] = $salt->generatSalt("login");
    echo json_encode($errorArray);
  }
?>
