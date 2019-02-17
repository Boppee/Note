<?php
session_start();
header('Content-type: application/json');
require_once '../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  $session = new session();
  if ($session->checkPrem("delete", "accounts")) {

    $enc = new encoder("rev");

    $uid = $enc->revEncode($_POST["uid"], "");

    $connect = new connect();
    $connection = $connect->newConnectionPre("removeAccounts", "");

    $sth = $connection->prepare("DELETE FROM `accounts` WHERE username = :id");
    $sth->bindParam(':id', $uid);
    $sth->execute();

  }
}
?>
