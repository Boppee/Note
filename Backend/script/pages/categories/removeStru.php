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
    $sth->execute();

    $var = "SHOW FULL COLUMNS FROM `".$id."`";
    $connection = $connect->newConnectionPre("FetchPublic", "products");
    $sth = $connection->prepare($var);
    $sth->execute();
    $data = $sth->fetchAll(PDO::FETCH_ASSOC);

    if (count($data) != 1) {
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
