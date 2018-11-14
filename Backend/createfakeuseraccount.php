<?php

  //JUST FOR TESTING

  session_start();

  require 'php/load.php';

  $enc = new encoder("private");
  $connect =  new connect();

  $connection = $connect->newConnectionPre("CreateAdminAccount");

  $uid = "sa";
  $pwd = "sa";
  $email = "emil00.sandberg@gmail.com";

  $uid = $enc->revEncode($uid, "");
  $iv = $enc->generatIv();
  $email = $enc->encode($email, $iv);
  $pwd = password_hash($pwd, PASSWORD_DEFAULT);

  $pages = array("dashboard");
  $perms = array("logout");

  $pages = json_encode($pages);
  $perms = json_encode($perms);

  $sth = $connection->prepare("INSERT INTO `accounts`(`username`, `password`, `iv`,`email`, `json_page`, `json_perms`) VALUES (:u,:p,:i,:e,:page,:perms)");
  $sth->bindParam(':u', $uid);
  $sth->bindParam(':p', $pwd);
  $sth->bindParam(':i', $iv);
  $sth->bindParam(':e', $email);
  $sth->bindParam(':page', $pages);
  $sth->bindParam(':perms', $perms);
  $sth->execute();

?>
