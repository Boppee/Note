<?php
session_start();
header('Content-Type: application/json');
require_once '../../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  $session = new session();
  if ($session->checkPrem("create", "products")) {

    $connect = new connect();
    $connection = $connect->newConnectionPre("modifyProducts", "");

    $id = strip_tags($_POST["id"]);

    $sth = $connection->prepare("SELECT `imgs` FROM `1` WHERE `product_id` = :id");
    $sth->bindParam(':id', $id);
    $sth->execute();
    $imgArray = $sth->fetch(PDO::FETCH_ASSOC);

    $imgArray = json_decode($imgArray["imgs"]);


    $fileName = $_FILES['img']['name'];
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
    $fileError = $_FILES['img']['error'];
    $fileContent = file_get_contents($_FILES['img']['tmp_name']);

    $imgErrors = array();

    $imgname = generateRandomString(10);

    if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif" && $fileType != "bmp") {
      array_push($imgErrors, "file format");
    }
    if (getimagesize($_FILES["img"]["tmp_name"]) == false) {
      array_push($imgErrors, "not a img");
    }
    if (count($imgErrors) == 0) {
      if (!file_exists("../../../../../frontend/pages/products/imgs/".$id)) {
        mkdir("../../../../../frontend/pages/products/imgs/".$id, 0700);
      }
      $filePath = "../../../../../frontend/pages/products/imgs/".$id."/".$imgname.".".pathinfo($fileName, PATHINFO_EXTENSION);
      move_uploaded_file($_FILES["img"]["tmp_name"], $filePath);
      $imgtype = pathinfo($fileName, PATHINFO_EXTENSION);
      $newArray = array('t' => $imgtype, 'n' => $imgname);
      array_push($imgArray, $newArray);

      $imgArray = json_encode($imgArray);

      $sth = $connection->prepare("UPDATE `1` SET `imgs` = :array WHERE `product_id` = :id");
      $sth->bindParam(':id', $id, PDO::PARAM_INT);
      $sth->bindParam(':array', $imgArray);
      $sth->execute();
    }

    echo "ok";

  }else {
    http_response_code(401);
  }
}else {
  http_response_code(401);
}
?>
