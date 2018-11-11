<?php

  header('Content-type: application/json');

  session_start();
  require_once '../../../php/load.php';

  $salt = new salt();

  //grabing userinputs
  $uid = $_POST["uid"];
  $postSalt = $_POST["salt"];
  $pwd = $_POST["pwd"];
  //check if value are set
  $uid = strip_tags($uid);
  $postSalt = strip_tags($postSalt);
  $pwd = strip_tags($pwd);

  $errorArray = array("errors" => 1);

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
                  $errorArray["error"] = "inactive user";
                }
              }else {
                $errorArray["error"] = "password or username";
              }
            }else {
              $errorArray["error"] = "password or username";
            }
          }else {
            $errorArray["error"] = "salt error";
          }
        }else {
          $errorArray["error"] = "captcha error";
        }
      }else {
        $errorArray["error"] = "missing inputs";
      }
    }else {
      goToPage("?page=dashboard");
    }
  }else {
    echo "fuck off bot fgt";
  }
  if (count($errorArray) > 1) {
    $returnSalt = $salt->generatSalt("login");
    $errorArray["salt"] = $returnSalt;
    echo json_encode($errorArray);
  }
?>
