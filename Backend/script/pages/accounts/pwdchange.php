<?php

session_start();
require_once '../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  $enc = new encoder("rev");

  $session = new session();
  if ($session->checkPrem("respwd", "accounts")) {

    $code = $_POST["code"];
    $uid = $_POST["uid"];
    $cr = $_POST["cr"];
    $rcode = $_POST["returncode"];
    $id = $_POST["id"];


    $connect = new connect();
    $connection = $connect->newConnectionPre("pwdChange");

    $sth = $connection->prepare("SELECT `cr`, `uid`, `pwd`, `code` FROM `code` WHERE id = :id");
    $sth->bindParam(':id', $id);
    $sth->execute();
    $data = $sth->fetch(PDO::FETCH_ASSOC);

    $enc = new encoder("public");

    if ($data["cr"] == $enc->decode($_SESSION["cred"]["uid"], $_SESSION["iv"]) && password_verify($code, $data["code"]) && $enc->decode($_SESSION["returncode"], $_SESSION["iv"]) == $rcode) {
      $uid = $enc->revEncode($uid, "");

      $encR = new encoder("rev");

      $newPwd = password_hash($encR->revDecode($data["pwd"], ""), PASSWORD_DEFAULT);
      $sth = $connection->prepare("UPDATE `accounts` SET `password`= :newpwd WHERE `username` = :uid");
      $sth->bindParam(':uid', $uid);
      $sth->bindParam(':newpwd', $newPwd);
      $sth->execute();
    }

  }
}
?>
