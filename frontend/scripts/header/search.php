<?php

  header('Content-Type: application/json');
  require_once '../connect.php';

  $connection = connect("products", "");

  $text = "%".strip_tags($_POST["text"])."%";

  $products = $connection->prepare("SELECT * FROM `1` WHERE `name` LIKE :search AND `visible` = 1");
  $products->bindParam(':search', $text);
  $products->execute();
  $echo["products"] = $products->fetchAll(PDO::FETCH_ASSOC);

  foreach ($echo["products"] as $key => $value) {
    $echo["products"][$key]["imgs"] = json_decode($echo["products"][$key]["imgs"]);
  }

  $text = "%".strip_tags($_POST["text"])."%";

  $cats = $connection->prepare("SELECT * FROM `cats` WHERE `name` LIKE :search");
  $cats->bindParam(':search', $text);
  $cats->execute();
  $echo["cats"] = $cats->fetchAll(PDO::FETCH_ASSOC);

  echo json_encode($echo);

?>
