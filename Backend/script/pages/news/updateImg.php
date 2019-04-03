<?php
session_start();
header('Content-Type: application/json');
require_once '../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  $session = new session();
  if ($session->checkPrem("create", "news")) {

    $connect = new connect();
    $connection = $connect->newConnectionPre("modifyNews", "");

    $id = strip_tags($_POST["id"]);

    $action = strip_tags($_POST["action"]);
    $img = strip_tags($_POST["img"]);

    $sth = $connection->prepare("SELECT `id`, `imgs` FROM `news` WHERE id = :id");
    $sth->bindParam(':id', $id);
    $sth->execute();

    $imgs = $sth->fetchAll(PDO::FETCH_ASSOC);

    $imgArray = json_decode($imgs[0]["imgs"], true);

    for ($i=0; $i < count($imgArray); $i++) {
      if ($imgArray[$i]["n"] == $img) {
        $pos = $i;
      }
    }

    if ($action == "down") {
      $temp = $imgArray[$pos];
      $temp2 = $imgArray[($pos+1)];
      $imgArray[$pos] = $temp2;
      $imgArray[($pos+1)] = $temp;
    }
    if ($action == "up") {
      $temp = $imgArray[$pos];
      $temp2 = $imgArray[($pos-1)];
      $imgArray[$pos] = $temp2;
      $imgArray[($pos-1)] = $temp;
    }
    if ($action == "remove") {
      @unlink("../../../../frontend/pages/news/imgs/".$id."/".$imgArray[$pos]["n"].".".$imgArray[$pos]["t"]);
      array_splice($imgArray, $pos, 1);
    }

    $imgArray = json_encode($imgArray);

    $sth = $connection->prepare("UPDATE `news` SET `imgs` = :array WHERE `id` = :id");
    $sth->bindParam(':id', $id, PDO::PARAM_INT);
    $sth->bindParam(':array', $imgArray);
    $sth->execute();

    echo "ok";

  }else {
    http_response_code(401);
  }
}else {
  http_response_code(401);
}
?>
