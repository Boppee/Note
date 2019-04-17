<?php
session_start();
header('Content-Type: application/json');
require_once '../../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  $session = new session();
  if ($session->checkPrem("modify", "products")) {

    $connect = new connect();
    $connection = $connect->newConnectionPre("modifyProducts", "");

    $id = strip_tags($_POST["id"]);
    $cat = strip_tags($_POST["cat"]);
    $index = strip_tags($_POST["index"]);
    $value = strip_tags($_POST["value"]);

    $sth = $connection->prepare("UPDATE `".$cat."` SET `".$index."`=:value WHERE product_id = :id");
    $sth->bindParam(':id', $id);
    $sth->bindParam(':value', $value);
    $sth->execute();

  }else {
    http_response_code(401);
  }
}else {
  http_response_code(401);
}
?>
