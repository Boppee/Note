<?php
session_start();
header('Content-Type: application/json');
require_once '../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  if ($session->checkPrem("modify", "categories")) {

    //posted Data
    $name = strip_tags($_POST["name"]);
    $id = strip_tags($_POST["id"]);

    $connect = new connect();
    $connection = $connect->newConnectionPre("modifyCats", "products");

    $sth = $connection->prepare("ALTER TABLE `".$id."` DROP `".$name."`");
    if ($sth->execute()) {
      http_response_code(200);
    }else {
      http_response_code(304);
    }


  }else {
    http_response_code(401);
  }
}else {
  http_response_code(401);
}

?>
