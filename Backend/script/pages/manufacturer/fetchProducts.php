<?php

  session_start();
  header('Content-type: application/json');
  require_once '../../../php/load.php';

  if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

    $id = strip_tags($_POST["manufacturer"]);

    $session = new session();
    if ($session->checkPrem("list", "accounts")) {
      $enc = new encoder("rev");

      $connect = new connect();
      $connection = $connect->newConnectionPre("FetchFromProducts", "");

      $sth = $connection->prepare("SELECT `product_id`, `visible`, `name`, `imgs`, `price`, `totalstock` FROM `1` WHERE `manufacturer` = :id");
      $sth->bindParam(':id', $id, PDO::PARAM_INT);
      $sth->execute();

      $test = $sth->fetchAll(PDO::FETCH_ASSOC);

      echo json_encode($test);
    }else {
      http_response_code(401);
    }
  }else {
    http_response_code(401);
  }

?>
