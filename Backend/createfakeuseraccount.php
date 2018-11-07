<?php

  //JUST FOR TESTING

  session_start();

  require 'php/load.php';

  $enc = new encoder("private");
  $connect =  new connect();

  $connection = $connect->newConnectionPre("CreateAdminAccount");

  $uid = "boppe";
  $pwd = "test";
  $email = "emil00.sandberg@gmail.com";

  $uid = $enc->revEncode($uid, "");
  $iv = $enc->generatIv();
  $email = $enc->encode($email, $iv);
  $pwd = password_hash($pwd, PASSWORD_DEFAULT);

  $sth = $connection->prepare("INSERT INTO `accounts`(`username`, `password`, `iv`,`email`) VALUES (:u,:p,:i,:e)");
  $sth->bindParam(':u', $uid);
  $sth->bindParam(':p', $pwd);
  $sth->bindParam(':i', $iv);
  $sth->bindParam(':e', $email);
  $sth->execute();

?>
