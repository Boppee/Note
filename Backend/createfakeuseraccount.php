<?php
session_start();

require 'php/load.php';

$enc = new encoder("private");
$connect =  new connect();

$connection = $connect->newConnectionPre("CreateAdminAccount");
//  for ($i=0; $i < 100; $i++) {

      $uid = "sa";
      $pwd = "sa";
      $email = "emil00.sandberg@gmail.com";

      $uid = $enc->revEncode($uid, "");
      $iv = $enc->generatIv();
      $email = $enc->encode($email, $iv);
      $pwd = password_hash($pwd, PASSWORD_DEFAULT);

      $pages = '["dashboard","settings","logout","myaccount",["account","list","resetpassword","create","mod"]]';

      echo $uid;
      echo "<br>";
      echo $pwd;
      echo "<br>";
      echo $iv;
      echo "<br>";
      echo $email;
      echo "<br>";

      $sth = $connection->prepare("INSERT INTO `accounts` (`username`, `password`, `iv`, `email`, `new_permsys`) VALUES (:u,:p,:i,:e,:perms)");
      $sth->bindParam(':u', $uid);
      $sth->bindParam(':p', $pwd);
      $sth->bindParam(':i', $iv);
      $sth->bindParam(':e', $email);
      $sth->bindParam(':perms', $pages);
      $sth->execute();
  //}
  //JUST FOR TESTIN

?>
