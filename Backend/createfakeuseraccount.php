<?php
session_start();

require 'php/load.php';

$enc = new encoder("private");
$connect =  new connect();

$connection = $connect->newConnectionPre("CreateAdminAccount");
  for ($i=0; $i < 100; $i++) {

      $uid = $i;
      $pwd = "kuk";
      $email = "emil00.sandberg@gmail.com";

      $uid = $enc->revEncode($uid, "");
      $iv = $enc->generatIv();
      $email = $enc->encode($email, $iv);
      $pwd = password_hash($pwd, PASSWORD_DEFAULT);

      $pages = array("dashboard", "settings", "logout", "myaccount","accounts","products","statistics", "order");
      $perms = array("logout");

      $pages = json_encode($pages);
      $perms = json_encode($perms);

      echo $uid;
      echo "<br>";
      echo $pwd;
      echo "<br>";
      echo $iv;
      echo "<br>";
      echo $email;
      echo "<br>";

      $sth = $connection->prepare("INSERT INTO `accounts` (`username`, `password`, `iv`,`email`, `json_page`, `json_perms`) VALUES (:u,:p,:i,:e,:page,:perms)");
      $sth->bindParam(':u', $uid);
      $sth->bindParam(':p', $pwd);
      $sth->bindParam(':i', $iv);
      $sth->bindParam(':e', $email);
      $sth->bindParam(':page', $pages);
      $sth->bindParam(':perms', $perms);
      $sth->execute();
  }
  //JUST FOR TESTIN

?>
