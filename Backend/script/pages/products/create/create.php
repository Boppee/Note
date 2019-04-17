<?php
session_start();
header('Content-Type: application/json');
require_once '../../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  $session = new session();
  if ($session->checkPrem("create", "products")) {

    $connect = new connect();
    $connection = $connect->newConnectionPre("createProducts", "");

    $name = strip_tags($_POST["name"]);
    unset($_POST["name"]);
    $price = strip_tags($_POST["price"]);
    unset($_POST["price"]);
    $cat = strip_tags($_POST["categories"]);
    unset($_POST["categories"]);
    $man = strip_tags($_POST["manufacturer"]);
    unset($_POST["manufacturer"]);

    $words = explode(' ', $name);
    $simname = $words[array_rand($words)];

    $sth = $connection->prepare("INSERT INTO `1` (
      `categorie_id`,
      `name`,
      `visible`,
      `price`,
      `manufacturer`,
      `imgs`,
      `totalstock`,
      `stocks`,
      `sp`,
      `sim`
    ) VALUES (
      :cat,
      :name,
      '1',
      :price,
      :man,
      '[]',
      '0',
      '[]',
      '',
      :simname
    )");
    $sth->bindParam(':cat', $cat);
    $sth->bindParam(':name', $name);
    $sth->bindParam(':price', $price);
    $sth->bindParam(':man', $man);
    $sth->bindParam(':simname', $simname);
    $sth->execute();
    $tableId = $connection->lastInsertId();

    if ($cat != 1) {
      $catString = "INSERT INTO `".$cat."` (`product_id`) VALUES (:lastId)";
      $sth = $connection->prepare($catString);
      $sth->bindParam(':lastId', $tableId);
      $sth->execute();

      $catSpec = array_keys($_POST);

      foreach ($catSpec as $key => $value) {
        $catString = "UPDATE `".$cat."` SET `".$value."` = :value WHERE `product_id` = :lastId";
        $sth = $connection->prepare($catString);
        $sth->bindParam(':lastId', $tableId);
        $val = strip_tags($_POST[$value]);
        $sth->bindParam(':value', $val);
        $sth->execute();
      }
    }


    $imgArray = array();
    $imgs = 1;


    foreach ($_FILES as $key => $value) {
      if ($value["type"] == "image/png") {
        if (!file_exists("../../../../../frontend/pages/products/imgs/".$tableId)) {
          mkdir("../../../../../frontend/pages/products/imgs/".$tableId, 0700);
        }

        $imgErrors = array();

        $fileName = $value['name'];
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        $fileError = $value['error'];
        $fileContent = file_get_contents($value['tmp_name']);

        if (getimagesize($value["tmp_name"]) == false) {
          array_push($imgErrors, "not a img");
        }

        $filePath = "../../../../../frontend/pages/products/imgs/".$tableId."/".$imgs.".".pathinfo($fileName, PATHINFO_EXTENSION);
        move_uploaded_file($value["tmp_name"], $filePath);
        $imgtype = pathinfo($fileName, PATHINFO_EXTENSION);
        $newArray = array('t' => $imgtype, 'n' => $imgs);
        array_push($imgArray, $newArray);
        $imgs++;
      }
    }

    $imgArray = json_encode($imgArray);

    $sth = $connection->prepare("UPDATE `1` SET `imgs` = :array WHERE `product_id` = :id");
    $sth->bindParam(':id', $tableId, PDO::PARAM_INT);
    $sth->bindParam(':array', $imgArray);
    $sth->execute();

  }else {
    http_response_code(401);
  }
}else {
  http_response_code(401);
}
?>
