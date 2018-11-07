<?php

  require_once '../../php/load.php';
  require_once '../../php/login.php';

  $connect = new connect();

  $connection = $connect->newConnectionPre("FetchFromAccounts");

  session_start();
  //grabing userinputs
  $uid = $_POST["uid"];
  $salt = $_POST["salt"];
  $pwd = $_POST["pwd"];
  //check if value are set
  if (isset($pwd) && isset($salt) && isset($uid)) {
    if ($_SESSION["logincaptcha"]["pass"]) {
      if ($salt == $_SESSION["salt"]) {
        $login = new login($pwd, $uid);
      }else {
        echo "Salt error";
      }
    }else {
      echo "captcha error";
    }
  }else {
    echo "missing inputs";
  }
?>
