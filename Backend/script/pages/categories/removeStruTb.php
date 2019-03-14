<?php
session_start();
header('Content-Type: application/json');
require_once '../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  if ($session->checkPrem("modify", "categories")) {

    //posted Data
    $id = strip_tags($_POST["id"]);

    if ($id != 1) {
      $connect = new connect();
      $connection = $connect->newConnectionPre("modifyCats", "products");

      $sth = $connection->prepare("DROP TABLE `".$id."`");
      if ($sth->execute()) {
        $sth = $connection->prepare("UPDATE `cats` SET `havetable` = '0' WHERE `id` = :id");
        $sth->bindParam(':id', $id, PDO::PARAM_INT);
        if ($sth->execute()) {
          http_response_code(200);
        }else {
          http_response_code(304);
        }
      }
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
