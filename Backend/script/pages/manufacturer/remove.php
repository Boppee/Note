<?php
session_start();
header('Content-Type: application/json');
require_once '../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  $session = new session();
  if ($session->checkPrem("delete", "manufacturer")) {

    $connect = new connect();
    $connection = $connect->newConnectionPre("removeManufacturer", "");

    $id = strip_tags($_POST["id"]);

    $sth = $connection->prepare("DELETE FROM `manufacturer` WHERE `id` = :id");
    $sth->bindParam(':id', $id, PDO::PARAM_INT);
    if ($sth->execute()) {
      echo json_encode(true);
    }


  }
}
?>