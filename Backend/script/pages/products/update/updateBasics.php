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
    $index = strip_tags($_POST["index"]);
    $value = strip_tags($_POST["value"]);

    if ($index == "categorieSelector") {
      $index = "categorie_id";
      $sth = $connection->prepare("SELECT * FROM `1` WHERE `product_id` = :id");
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
        $cat = $sth->fetch(PDO::FETCH_ASSOC);
      }
      if ($value != 1) {
        echo "string";
        $sth = $connection->prepare("SELECT * FROM `cats` WHERE `id` = :id");
        $sth->bindParam(':id', $value);
        $sth->execute();
        $newCat = $sth->fetch(PDO::FETCH_ASSOC);

        $sth = $connection->prepare("INSERT INTO `".$value."` (`product_id`) VALUES (:lastId)");
        $sth->bindParam(':lastId', $id);
        $sth->execute();
      }

    }

    $sth = $connection->prepare("UPDATE `1` SET `".$index."`=:value WHERE `product_id` = :id");
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
