<?php

  session_start();
  header('Content-type: application/json');
  require_once '../../../php/load.php';

  if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

    $id = strip_tags($_POST["id"]);

    $session = new session();
    if ($session->checkPrem("list", "accounts")) {
      echoAccount($id);
    }else {
      http_response_code(401);
    }
  }else {
    http_response_code(401);
  }
  function echoAccount($id){
    $enc = new encoder("rev");

    $connect = new connect();
    $connection = $connect->newConnectionPre("FetchFromProducts", "");

    $sth = $connection->prepare("SELECT * FROM `1` WHERE `categorie_id` LIKE :id");
    $sth->bindParam(':id', $id, PDO::PARAM_INT);
    $sth->execute();

    $test = $sth->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($test);
  }

?>
