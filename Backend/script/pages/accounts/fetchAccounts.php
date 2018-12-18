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

    $sth = $connection->prepare("SELECT `active`, `username`, `lastlogon`, `new_permsys` FROM `accounts` LIMIT :accountlimit");
    $sth->bindParam(':accountlimit', $limit, PDO::PARAM_INT);
    $sth->execute();

    $test = $sth->fetchAll(PDO::FETCH_ASSOC);
    //print_r(json_decode($test["accounts"][0]["new_permsys"], true));

    foreach ($test as $key => $value) {
      $test[$key]["username"] = $enc->revDecode($value["username"]);
      $test[$key]["new_permsys"] = json_decode($value["new_permsys"], true);
    }

    echo json_encode($test);
  }

?>
