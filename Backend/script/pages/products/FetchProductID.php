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
    $sth = $connection->prepare("SELECT * FROM `1` WHERE product_id = :id");
    $sth->bindParam(':id', $id, PDO::PARAM_INT);
    $sth->execute();

    $echo = $sth->fetchAll(PDO::FETCH_ASSOC);

    $connection = $connect->newConnectionPre("FetchPublic", "products");
    $sth = $connection->prepare("SELECT `name` FROM `cats` WHERE `id` = :id");
    $sth->bindParam(':id', $echo[0]["categorie_id"], PDO::PARAM_INT);
    $sth->execute();

    $cat = $sth->fetchAll(PDO::FETCH_ASSOC);

    if (isset($cat[0])) {
      $echo[0]["cat_name"] = $cat[0]["name"];
    }

    $connection = $connect->newConnectionPre("FetchPublic", "products");
    $sth = $connection->prepare("SELECT `name` FROM `manufacturer` WHERE `id` = :id");
    $sth->bindParam(':id', $echo[0]["manufacturer"], PDO::PARAM_INT);
    $sth->execute();

    $man = $sth->fetchAll(PDO::FETCH_ASSOC);

    if (isset($man[0])) {
      $echo[0]["man_name"] = $man[0]["name"];
    }


    if (!$session->checkPrem("list", "orders")) {
      unset($echo["orders"]);
    }
    $echo[0]["stocks"] = json_decode($echo[0]["stocks"]);
    $echo[0]["imgs"] = json_decode($echo[0]["imgs"]);

    $catId = $echo[0]["categorie_id"];

    if ($catId != 1) {

      $sth = $connection->prepare("SELECT * FROM `cats` WHERE `id` = :id");
      $sth->bindParam(':id', $echo[0]["categorie_id"]);
      $sth->execute();
      $cat = $sth->fetch(PDO::FETCH_ASSOC);

      if ($cat["havetable"] == 1) {
        $sth = $connection->prepare("SELECT * FROM `".$catId."` WHERE `product_id` = :id");
        $sth->bindParam(':id', $echo[0]["product_id"]);
        $sth->execute();
        $echo["catSpecs"] = $sth->fetchAll(PDO::FETCH_ASSOC)[0];
      }
    }

    echo json_encode($echo, true);

  }else {
    http_response_code(401);
  }
}else {
  http_response_code(401);
}
?>
