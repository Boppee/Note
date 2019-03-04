<?php
  header('Content-type: application/json');

  session_start();
  require_once '../../../php/load.php';

  $salt = new salt();

  //check if value are set
  $uid = strip_tags($_POST["uid"]);
  $postSalt = strip_tags($_POST["salt"]);
  $pwd = strip_tags($_POST["pwd"]);

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
                $errors["error"] = "inactive user";
              }
            }else {
              $errors["error"] = "password or username";
            }
          }else {
            print_r($userData);
            $errors["error"] = "password or username";
          }
        }else {
          $errors["error"] = "salt error";
        }
      }else {
        $errors["error"] = "captcha error";
      }
    }else {
      $errors["error"] = "missing inputs";
    }
  }else {
    goToPage("?page=dashboard");
  }
  if (isset($errors)) {
    $errors["salt"] = $salt->generatSalt("login");
    echo json_encode($errors);
  }
?>
