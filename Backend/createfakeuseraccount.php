<?php

  session_start();

  require 'php/load.php';

  $enc = new encoder("databas");
  $connect =  new connect();

  $connection = $connect->newConnectionPre("CreateAdminAccount");

  $username = "test";
  $password = "test";
  $email = "emil00.sandberg@gmail.com";

  $iv = $enc->generatIv();

  $pwd = password_hash($pwd, PASSWORD_DEFAULT);
  $enc->encode($pwd, $iv);
  $uid = $enc->revEncode($username, "");

  /*$sth = $c->prepare("INSERT INTO `accounts`(`uid`, `pwd`, `email`, `iv`) VALUES (:u,:p,:e,:i)");
  $sth->bindParam(':u', $uid);
  $sth->bindParam(':p', $pwd);
  $sth->bindParam(':e', $email);
  $sth->bindParam(':i', $iv);
  $sth->execute();*/

?>
