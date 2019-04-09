<?php

  header('Content-Type: application/json');
  require_once '../connect.php';

  $connection = connect("products", "");

  $id = strip_tags(intval($_POST["id"]));

  $products = $connection->prepare("SELECT * FROM `1` WHERE `product_id` = :id");
  $products->bindParam(':id', $id);
  $products->execute();
  $echo = $products->fetchAll(PDO::FETCH_ASSOC);

  if ($echo[0]["categorie_id"] != 1) {
    $cats = $connection->prepare("SELECT * FROM `cats` WHERE `id` = :id");
    $cats->bindParam(':id', $echo[0]["categorie_id"]);
    $cats->execute();
    $cat = $cats->fetchAll(PDO::FETCH_ASSOC);

    if ($cat[0]["havetable"] == 1) {
      $echo["struc"]["status"] = 1;
      $var = "SHOW FULL COLUMNS FROM `".$id."`";
      $sth = $connection->prepare($var);
      $sth->execute();
      $echo["struc"]["data"] = $sth->fetchAll(PDO::FETCH_ASSOC);
    }else {
      $echo["struc"]["status"] = 0;
    }
  }else {
    $echo["struc"]["status"] = 0;
  }

  if (isset($echo[0])) {
    $echo[0]["imgs"] = json_decode($echo[0]["imgs"]);

    unset($echo[0]["visible"]);

    $echo[0]["stocks"] = json_decode($echo[0]["stocks"]);

    if (isset($_POST["o"])) {
      $echo["o"] = strip_tags($_POST["o"]);
    }

    $echo["productData"] = $echo[0];
    unset($echo[0]);

    echo json_encode($echo);
  }else {
    http_response_code(404);
  }



?>
