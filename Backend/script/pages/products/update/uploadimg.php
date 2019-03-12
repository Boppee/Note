<?php
session_start();
header('Content-Type: application/json');
require_once '../../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {


  $session = new session();
  if ($session->checkPrem("modify", "products")) {

    $pid = $_POST["pid"];

    $connect = new connect();
    $connection = $connect->newConnectionPre("FetchFromProducts", "");
    $sth = $connection->prepare("SELECT `imgs` FROM `products` WHERE id = :id");
    $sth->bindParam(':id', $pid, PDO::PARAM_INT);
    $sth->execute();
    $imgArray = json_decode($sth->fetchAll(PDO::FETCH_ASSOC)[0]["imgs"], true);

    $fileName = $_FILES['file']['name'];
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
    $fileError = $_FILES['file']['error'];
    $fileContent = file_get_contents($_FILES['file']['tmp_name']);

    $imgErrors = array();

    $imgname = getFileName($imgArray);

    if ($_FILES["file"]["size"] > 5000000) {
      array_push($imgErrors, "file size");
    }
    if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif" && $fileType != "bmp") {
      array_push($imgErrors, "file format");
    }
    if (getimagesize($_FILES["file"]["tmp_name"]) == false) {
      array_push($imgErrors, "not a img");
    }
    if (count($imgErrors) == 0) {
      if (!file_exists("../../../img/p/".$pid)) {
        mkdir("../../../../img/p/".$pid, 0700);
      }
      $filePath = "../../../../img/p/".$pid."/".$imgname.".".pathinfo($fileName, PATHINFO_EXTENSION);
      move_uploaded_file($_FILES["file"]["tmp_name"], $filePath);
      $imgtype = pathinfo($fileName, PATHINFO_EXTENSION);
      $newArray = array('imgtype' => $imgtype, 'name' => $imgname);
      array_push($imgArray, $newArray);
    }

    $imgArray = json_encode($imgArray);

    $connect->newConnectionPre("UpdateProducts", "");
    $sth = $connection->prepare("UPDATE `products` SET `imgs`= :array WHERE id = :id");
    $sth->bindParam(':id', $pid, PDO::PARAM_INT);
    $sth->bindParam(':array', $imgArray);
    if ($sth->execute()) {
      $newArray["id"] = $pid;
      echo json_encode($newArray);
    }
  }else {
    http_response_code(401);
  }
}else {
  http_response_code(401);
}
function getFileName($array) {
  $a = 0;
  $error = false;
  while ($a < 1) {
    $tempString = generateRandomString(10);
    foreach ($array as $key => $value) {
      if ($value["name"] == $tempString) {
        $error = true;
      }
    }
    if (!$error) {
      $a++;
    }
  }
  return $tempString;
}
?>
