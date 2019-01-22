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
    $connection = $connect->newConnectionPre("FetchFromProducts");

    $sth = $connection->prepare("SELECT `id`, `visible`, `name`, `stock`, `imgs`, `price` FROM `products` LIMIT :itemlimit");
    $sth->bindParam(':itemlimit', $limit, PDO::PARAM_INT);
    $sth->execute();

    $test = $sth->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($test);
  }

?>
