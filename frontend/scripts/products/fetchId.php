<?php

  header('Content-Type: application/json');
  require_once '../connect.php';

  $connection = connect("products", "");

  $id = strip_tags($_POST["id"]);

  $products = $connection->prepare("SELECT * FROM `1` WHERE `product_id` = :id");
  $products->bindParam(':id', $id);
  $products->execute();
  $echo = $products->fetchAll(PDO::FETCH_ASSOC);

  $echo[0]["imgs"] = json_decode($echo[0]["imgs"]);

  unset($echo[0]["visible"]);
  unset($echo[0]["stocks"]);

  if (isset($_POST["o"])) {
    $echo["o"] = strip_tags($_POST["o"]);
  }

  $echo["productData"] = $echo[0];
  unset($echo[0]);

  echo json_encode($echo);

?>