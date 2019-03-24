<?php

  header('Content-Type: application/json');
  require_once '../connect.php';

  $connection = connect("products", "");

  $ids = json_decode($_POST["ids"]);
  $o = json_decode($_POST["o"]);

  $echoMe["prodcuts"] = array();
  $echoMe["o"] = array();

  foreach ($ids as $key => $value) {
    $products = $connection->prepare("SELECT * FROM `1` WHERE `product_id` = :id");
    $products->bindParam(':id', $value);
    $products->execute();
    $echo = $products->fetchAll(PDO::FETCH_ASSOC);

    $echo[0]["imgs"] = json_decode($echo[0]["imgs"]);

    unset($echo[0]["visible"]);
    unset($echo[0]["stocks"]);

    array_push($echoMe["prodcuts"], $echo[0]);
    array_push($echoMe["o"], $o[$key]);
  }

  echo json_encode($echoMe);

?>
