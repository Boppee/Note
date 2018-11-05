<?php

  require_once '../../php/load.php';

  $connect = new connect(/* FIXME: add users)*/;
  $databasEncoder = new encoder("databas");
  $sessionEncoder = new encoder("session");

  $connection = $connect->newConnectionPre();

  session_start();

  $uid = $_POST["uid"];
  $salt = $_POST["salt"];
  $pwd = $_POST["pwd"];

  if (isset($pwd) && isset($salt) && isset($uid)) {
    if ($_SESSION["logincaptcha"]["pass"]) {

    }else {
      echo "captcha error";
    }
  }else {
    echo "missing inputs";
  }
?>
