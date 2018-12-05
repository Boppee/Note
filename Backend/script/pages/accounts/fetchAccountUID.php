<?php
session_start();
header('Content-type: application/json');
require_once '../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  $enc = new encoder("rev");

  $uid = $enc->revEncode($_REQUEST["uid"], "");

  $session = new session();
  if ($session->checkPrem("manageAccounts")) {

    $encPr = new encoder("private");

    $account = grabUserData();
    $echo["username"] = $enc->revDecode($account["username"]);
    $echo["email"] = $encPr->decode($account["email"], $account["iv"]);
    $echo["img"] = $account["img"];
    $echo["pages"] = json_decode($account["json_page"]);
    $echo["perms"] = json_decode($account["json_perms"]);
    $echo["lastlogon"] = $account["lastlogon"];

    echo json_encode($echo);

  }
}
?>
