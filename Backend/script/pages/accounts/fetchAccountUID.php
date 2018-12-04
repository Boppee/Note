<?php
session_start();
header('Content-type: application/json');
require_once '../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  $enc = new encoder("rev");

  $uid = $enc->revEncode($_POST["uid"], "");

  $session = new session();
  if ($session->checkPrem("manageAccounts")) {


    $encPr = new encoder("private");

    $connect = new connect();
    $connection = $connect->newConnectionPre("FetchFromAccounts");

    $sth = $connection->prepare("SELECT `active`, `username`, `email`, `iv`, `img`, `lastlogon`, `json_page`, `json_perms` FROM `accounts` WHERE `username` = :uid");
    $sth->bindParam(':uid', $uid);
    $sth->execute();

    $account = $sth->fetch(PDO::FETCH_LAZY);
    $echo["username"] = $enc->revDecode($account["username"]);
    $echo["email"] = $encPr->decode($account["email"], $account["iv"]);
    $echo["img"] = $account["img"];
    $echo["pages"] = json_decode($account["json_page"]);
    $echo["perms"] = json_decode($account["json_perms"]);
    $echo["lastlogon"] = $account["lastlogon"];

    unset($account);

    echo json_encode($echo);

  }
}
?>
