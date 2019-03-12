<?php
session_start();
header('Content-Type: application/json');
require_once '../../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {


  $session = new session();
  if ($session->checkPrem("modify", "products")) {

    $id = strip_tags($_POST["product"]);
    $cat = strip_tags($_POST["cat"]);


    $connect = new connect();
    $connection = $connect->newConnectionPre("UpdateProducts", "");

    $sth = $connection->prepare("UPDATE `products` SET `cat_id` = :cat WHERE `id` = :id");
    $sth->bindParam(':id', $id, PDO::PARAM_INT);
    $sth->bindParam(':cat', $cat);

    $sth->execute();

  }else {
    http_response_code(401);
  }
}else {
  http_response_code(401);
}

?>
