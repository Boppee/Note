<?php

  session_start();
  header('Content-type: application/json');
  require_once '../../../php/load.php';

  if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

    $limit = strip_tags($_POST["limit"]);

    $session = new session();
    if ($session->checkPrem("list", "accounts")) {
      echoAccount($limit);
    }
  }
  function echoAccount($limit){
    $enc = new encoder("rev");

    $connect = new connect();
    $connection = $connect->newConnectionPre("FetchFromAccounts");

    $sth = $connection->prepare("SELECT `active`, `username`, `lastlogon`, `json_page`, `json_perms` FROM `accounts` LIMIT :accountlimit");
    $sth->bindParam(':accountlimit', $limit, PDO::PARAM_INT);
    $sth->execute();

    $test["accounts"] = $sth->fetchAll(PDO::FETCH_ASSOC);

    foreach ($test["accounts"] as $key => $value) {
      $test["accounts"][$key]["username"] = $enc->revDecode($value["username"]);
      $test["accounts"][$key]["json_page"] = json_decode($value["json_page"]);
      $test["accounts"][$key]["json_perms"] = json_decode($value["json_perms"]);
    }

    echo json_encode($test);
  }

?>
