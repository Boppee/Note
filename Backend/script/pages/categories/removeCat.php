<?php
session_start();
header('Content-Type: application/json');
require_once '../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  if ($session->checkPrem("delete", "categories")) {

    $id = strip_tags($_POST["id"]);

    $connect = new connect();
    $connection = $connect->newConnectionPre("deleteCats", "products");

    $sth = $connection->prepare("SELECT * FROM `cats` WHERE `id` = :id");
    $sth->bindParam(':id', $id, PDO::PARAM_INT);
    $sth->execute();
    $cats = $sth->fetchAll(PDO::FETCH_ASSOC);

    $checkedChilds = array($id);

    if ($cats[0]["child"] != "[]") {

      $childToCheck = json_decode($cats[0]["child"]);

      while (count($childToCheck) != 0) {

        $sth = $connection->prepare("SELECT * FROM `cats` WHERE `id` = :id");
        $sth->bindParam(':id', $childToCheck[0], PDO::PARAM_INT);
        $sth->execute();
        $temp = $sth->fetchAll(PDO::FETCH_ASSOC);

        if ($temp[0]["child"] != "[]") {
          $tempChilds = json_decode($temp[0]["child"]);

          for ($i=0; $i < count($tempChilds); $i++) {
            array_push($childToCheck, $tempChilds[$i]);
          }
        }

        array_push($checkedChilds, $childToCheck[0]);
        array_splice($childToCheck, 0, 1);
      }
    }

    foreach ($checkedChilds as $key => $value) {
      $sth = $connection->prepare("SELECT * FROM `products` WHERE `cats` = :id");
      $sth->bindParam(':id', $value, PDO::PARAM_INT);
      $sth->execute();
      $products = $sth->fetchAll(PDO::FETCH_ASSOC);

      foreach ($products as $key => $value) {
        $sth = $connection->prepare("UPDATE `products` SET `categorie_id` = '1' WHERE `id` = :id");
        $sth->bindParam(':id', $value["id"], PDO::PARAM_INT);
        $sth->execute();
      }

      $sth = $connection->prepare("DROP TABLE `".$value."`");
      $sth->execute();
      $sth = $connection->prepare("DELETE FROM `cats` WHERE `cats`.`id` = :id");
      $sth->bindParam(':id', $value, PDO::PARAM_INT);
      $sth->execute();

    }

    $sth = $connection->prepare("SELECT * FROM `cats` WHERE `id` = :id");
    $sth->bindParam(':id', $cats[0]["par"], PDO::PARAM_INT);
    $sth->execute();
    $updateCats = $sth->fetchAll(PDO::FETCH_ASSOC);

    $update = json_decode($updateCats[0]["child"]);

    $key = array_search($id, $update);

    array_splice($update, $key, 1);

    $update = json_encode($update);

    $sth = $connection->prepare("UPDATE `cats` SET `child` = :newArray WHERE `id` = :id;");
    $sth->bindParam(':id', $cats[0]["par"], PDO::PARAM_INT);
    $sth->bindParam(':newArray', $update);
    $sth->execute();

  }else {
    http_response_code(401);
  }
}else {
  http_response_code(401);
}

?>
