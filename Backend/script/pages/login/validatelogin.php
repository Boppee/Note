<?php

  require_once '../../php/load.php';
  require_once '../../php/login.php';

  $connect = new connect(/* FIXME: add users)*/;
  $privateEncoder = new encoder("private");
  $publicEncoder = new encoder("public");

  $connection = $connect->newConnectionPre();

  session_start();

  $uid = $_POST["uid"];
  $salt = $_POST["salt"];
  $pwd = $_POST["pwd"];

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
