<?php

  header('Content-Type: application/json');
  require_once '../connect.php';

  $connection = connect("products", "");

  $id = strip_tags($_POST["id"]);

  $cats = $connection->prepare("SELECT * FROM `cats` WHERE `id` = :id");
  $cats->bindParam(':id', $id);
  $cats->execute();
  $cats = $cats->fetchAll(PDO::FETCH_ASSOC);

  $childs = json_decode($cats[0]["child"]);

  $echo = array();

  foreach ($childs as $key => $value) {
    $db = $connection->prepare("SELECT * FROM `cats` WHERE `id` = :id");
    $db->bindParam(':id', $value);
    $db->execute();
    $echo[$key]["cat"] = $db->fetchAll(PDO::FETCH_ASSOC)[0];

    $db = $connection->prepare("SELECT * FROM `1` WHERE `categorie_id` = :id AND `visible` = 1 LIMIT 4");
    $db->bindParam(':id', $value);
    $db->execute();

    $products = $db->fetchAll(PDO::FETCH_ASSOC);

    if (isset($products[0])) {
      $products[0]["imgs"] = json_decode($products[0]["imgs"]);
      $echo[$key]["products"] = $products;
    }else {
      $echo[$key]["products"] = false;
    }

  }

  echo json_encode($echo);

?>
