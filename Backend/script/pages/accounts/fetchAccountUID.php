<?php
session_start();
header('Content-type: application/json');
require_once '../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  $enc = new encoder("rev");

  $session = new session();
  if ($session->checkPrem("list", "accounts")) {

    $encPr = new encoder("private");


    $account = grabUserData($_REQUEST["uid"]);
    $echo["username"] = $enc->revDecode($account["username"]);
    $echo["active"] = $account["active"];
    $echo["email"] = $encPr->decode($account["email"], $account["iv"]);
    $echo["img"] = $account["img"];
    $echo["new_permsys"] = json_decode($account["new_permsys"]);
    $echo["lastlogon"] = $account["lastlogon"];

    unset($account);

    echo json_encode($echo);

  }
}
?>
