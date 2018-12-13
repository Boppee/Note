<?php

session_start();
header('Content-type: application/json');
require_once '../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  $session = new session();
  if ($session->checkPrem("manageAccounts")) {

    $connect = new connect();

    $encPr = new encoder("private");

    $uid = strip_tags($_POST["uid"]);
    $userdata = grabUserData($uid);
    $uid = $encPr->revEncode($uid, "");

    $val = strip_tags($_POST["val"]);
    $index = strip_tags($_POST["index"]);

    $iv = $userdata["iv"];

    if ($index == "email") {
      $val = $encPr->encode($val, $iv);
    }
    if ($index == "username") {
      $val = $encPr->revEncode($val, "");
    }

    $connection = $connect->newConnectionPre("UpdateAccount");

    $sth = $connection->prepare("UPDATE `accounts` SET `".$index."`= :val WHERE username = :uid");

    $sth->bindParam(':val', $val);
    $sth->bindParam(':uid', $uid);

    $sth->execute();

  }
}

?>
