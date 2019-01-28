<?php
session_start();
header('Content-type: application/json');
require_once '../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  $enc = new encoder("rev");

  $session = new session();
  if ($session->checkPrem("list", "products")) {

    $id = $_POST["id"];

    $connect = new connect();
    $connection = $connect->newConnectionPre("FetchFromProducts");
    $sth = $connection->prepare("SELECT * FROM `products` WHERE id = :id");
    $sth->bindParam(':id', $id, PDO::PARAM_INT);
    $sth->execute();

    $echo = $sth->fetchAll(PDO::FETCH_ASSOC);

    if (!$session->checkPrem("list", "categories")) {

    }
    if (!$session->checkPrem("list", "orders")) {
      
    }

    echo json_encode($echo);

  }
}
?>
