<?php
session_start();
header('Content-Type: application/json');
require_once '../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  $enc = new encoder("rev");

  $session = new session();
  if ($session->checkPrem("delete", "products")) {

    $connect = new connect();
    $connection = $connect->newConnectionPre("removeProduct", "");

    $id = strip_tags($_POST["id"]);

    $sth = $connection->prepare("SELECT `categorie_id` FROM `1` WHERE `product_id` = :id");
    $sth->bindParam(':id', $id);
    $sth->execute();
    $pdata = $sth->fetch(PDO::FETCH_ASSOC);

    $sth = $connection->prepare("SELECT * FROM `cats` WHERE `id` = :id");
    $sth->bindParam(':id', $pdata["categorie_id"]);
    $sth->execute();
    $cat = $sth->fetch(PDO::FETCH_ASSOC);

    if ($cat["havetable"] == 1 && $pdata["categorie_id"] != 1) {
      $sth = $connection->prepare("DELETE FROM `".$pdata["categorie_id"]."` WHERE `product_id` = :id");
      $sth->bindParam(':id', $id);
      $sth->execute();
    }

    $sth = $connection->prepare("DELETE FROM `1` WHERE `product_id` = :id");
    $sth->bindParam(':id', $id);
    $sth->execute();

  }else {
    http_response_code(401);
  }
}else {
  http_response_code(401);
}
?>
