<?php

  header('Content-Type: application/json');
  require_once '../connect.php';

  $connection = connect("products", "");

  $id = strip_tags($_POST["id"]);

  $echo = array();

  $cats = $connection->prepare("SELECT * FROM `cats` WHERE `id` = :id");
  $cats->bindParam(':id', $id);
  $cats->execute();
  $cats = $cats->fetchAll(PDO::FETCH_ASSOC);

  if ($cats[0]["havetable"] == 1) {
    $var = "SHOW FULL COLUMNS FROM `".$id."`";
    $sth = $connection->prepare($var);
    $sth->execute();
    $data = $sth->fetchAll(PDO::FETCH_ASSOC);

    $echo["tableStruc"] = $data;

  }else {
    $echo["tableStruc"] = false;
  }

  $childs = json_decode($cats[0]["child"]);

  foreach ($childs as $key => $value) {
    $db = $connection->prepare("SELECT * FROM `cats` WHERE `id` = :id");
    $db->bindParam(':id', $value);
    $db->execute();
    $echo["childs"][$key]["cat"] = $db->fetchAll(PDO::FETCH_ASSOC)[0];

    $db = $connection->prepare("SELECT * FROM `1` WHERE `categorie_id` = :id AND `visible` = 1 LIMIT 4");
    $db->bindParam(':id', $value);
    $db->execute();

    $products = $db->fetchAll(PDO::FETCH_ASSOC);

    if (isset($products[0])) {
      $products[0]["imgs"] = json_decode($products[0]["imgs"]);
      $echo["childs"][$key]["products"] = $products;
    }else {
      $echo["childs"][$key]["products"] = false;
    }
  }
  $db = $connection->prepare("SELECT * FROM `1` WHERE `categorie_id` = :id AND `visible` = 1");
  $db->bindParam(':id', $id);
  $db->execute();

  $echo["products"] = $db->fetchAll(PDO::FETCH_ASSOC);

  foreach ($echo["products"] as $key => $value) {
    $db = $connection->prepare("SELECT * FROM `".$id."` WHERE `product_id` = :id");
    $db->bindParam(':id', $value["product_id"]);
    $db->execute();
    $echo["products"][$key]["tableData"] = $db->fetch(PDO::FETCH_ASSOC);
  }

  foreach ($echo["products"] as $key => $value) {
    $echo["products"][$key]["imgs"] = json_decode($echo["products"][$key]["imgs"]);
  }


  echo json_encode($echo);

?>
