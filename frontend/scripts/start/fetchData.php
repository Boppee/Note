<?php

  header('Content-Type: application/json');
  require_once '../connect.php';

  $connection = connect("products", "");

  $products = $connection->prepare("SELECT * FROM `1` ORDER BY RAND() LIMIT 30");
  $products->bindParam(':id', $id);
  $products->execute();
  $random = $products->fetchAll(PDO::FETCH_ASSOC);

  foreach ($random as $key => $value) {
    $random[$key]["imgs"] = json_decode($random[$key]["imgs"]);
  }

  echo json_encode($random);

?>
