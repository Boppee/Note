<?php

  session_start();
  header('Content-type: application/json');
  require_once '../../../php/load.php';

  if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

    $limit = strip_tags($_POST["limit"]);

    $session = new session();
    if ($session->checkPrem("list", "units")) {
      echoAccount($limit);
    }
  }
  function echoAccount($limit){
    $enc = new encoder("rev");

    $connect = new connect();
    $connection = $connect->newConnectionPre("FetchPublic", "products");

    $sth = $connection->prepare("SELECT * FROM `prefix`");
    $sth->execute();

    $test = $sth->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($test);
  }

?>
