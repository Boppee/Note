<?php
  header('Content-type: application/json');
  require_once '../../../php/load.php';

  $connect = new connect();
  $connection = $connect->newConnectionPre("FetchPublic", "promnews");

  $sth = $connection->prepare("SELECT * FROM `promotions`");
  $sth->execute();
  $test = $sth->fetchAll(PDO::FETCH_ASSOC);
  foreach ($test as $key => $value) {
    if ($value["news_con"] != 0) {
      $sth = $connection->prepare("SELECT `name` FROM `news` WHERE `id` = :id");
      $sth->bindParam(':id', $value["news_con"], PDO::PARAM_INT);
      $sth->execute();
      $test[$key]["nname"] = $sth->fetchAll(PDO::FETCH_ASSOC)[0]["name"];
    }else {
      $test[$key]["nname"] = "no connection";
    }
  }
  $connection = $connect->newConnectionPre("FetchPublic", "products");
  foreach ($test as $key => $value) {
    $sth = $connection->prepare("SELECT `name` FROM `1` WHERE `product_id` = :id");
    $sth->bindParam(':id', $value["product_id"], PDO::PARAM_INT);
    $sth->execute();
    $test[$key]["pname"] = $sth->fetchAll(PDO::FETCH_ASSOC)[0]["name"];
  }

  echo json_encode($test);
?>
