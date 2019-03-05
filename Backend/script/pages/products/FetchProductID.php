<?php
session_start();
header('Content-Type: application/json');
require_once '../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  $enc = new encoder("rev");

  $session = new session();
  if ($session->checkPrem("list", "products")) {

    $id = $_POST["id"];

    $connect = new connect();
    $connection = $connect->newConnectionPre("FetchFromProducts", "");
    $sth = $connection->prepare("SELECT * FROM `products` WHERE id = :id");
    $sth->bindParam(':id', $id, PDO::PARAM_INT);
    $sth->execute();

    $echo = $sth->fetchAll(PDO::FETCH_ASSOC);

    if (!$session->checkPrem("list", "categories")) {
      unset($echo["categories"]);
    }
    if (!$session->checkPrem("list", "orders")) {
      unset($echo["orders"]);
    }
    $echo[0]["stock"] = json_decode($echo[0]["stock"]);
    $echo[0]["imgs"] = json_decode($echo[0]["imgs"]);

    echo json_encode($echo, true);

  }else {
    http_response_code(401);
  }
}else {
  http_response_code(401);
}
?>
