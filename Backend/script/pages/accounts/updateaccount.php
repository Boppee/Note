<?php

session_start();
require_once '../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  $session = new session();
  if ($session->checkPrem("modify", "accounts")) {

    if (!isset($_SESSION["cur"])) {
      $_SESSION["cur"] = 0;
    }

    $imgErrors = array();

    $connect = new connect();

    $encPr = new encoder("private");
    $encRe =  new encoder("rev");

    $uid = strip_tags($_POST["uid"]);
    $userdata = grabUserData($uid);
    $uid = $encPr->revEncode($uid, "");


    $index = strip_tags($_POST["index"]);

    if ($index != "img") {
      $val = strip_tags($_POST["val"]);
    }


    $iv = $userdata["iv"];

    if ($index == "email") {
      $val = $encPr->encode($val, $iv);
    }
    if ($index == "username") {
      $uidtest = grabUserData($val);
      if (!isset($uidtest["username"])) {
        $val = $encPr->revEncode($val, "");
      }else {
        header('Content-type: application/json');
        $errors = array('status' => "errors", 'errors' => "Username taken!", );
        echo json_encode($errors);
        exit();
      }
    }
    if ($index == "img") {
      if ($userdata["img"] != "def") {
        if (file_exists("../../../img/accounts/".$userdata["img"])) {
          unlink("../../../img/accounts/".$userdata["img"]);
        }
      }
      $fileName = $_FILES['file']['name'];
      $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
      $fileError = $_FILES['file']['error'];
      $fileContent = file_get_contents($_FILES['file']['tmp_name']);

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
        $fileP = checkIfFileName(pathinfo($fileName, PATHINFO_EXTENSION));
        $filePath = "../../../img/accounts/".$fileP.".".pathinfo($fileName, PATHINFO_EXTENSION);
        move_uploaded_file($_FILES["file"]["tmp_name"], $filePath);
        $imgD = $fileP.".".pathinfo($fileName, PATHINFO_EXTENSION);

        $connection = $connect->newConnectionPre("UpdateAccount");

        $sth = $connection->prepare("UPDATE `accounts` SET `img`= :imgd WHERE username = :uid");
        $sth->bindParam(':imgd', $imgD);
        $sth->bindParam(':uid', $uid);

        $sth->execute();

        $_SESSION["cur"] += 1;
      }
    }

    if ($index != "img") {
      $connection = $connect->newConnectionPre("UpdateAccount");

      $sth = $connection->prepare("UPDATE `accounts` SET `".$index."`= :val WHERE username = :uid");

      $sth->bindParam(':val', $val);
      $sth->bindParam(':uid', $uid);

      $sth->execute();

      $_SESSION["cur"] += 1;
    }
    if ($_POST["nr"] == $_SESSION["cur"]) {
      unset($_SESSION["cur"]);
      echo "done";
    }
  }
}
function checkIfFileName($fileType){
  $a = 0;
  $error = false;
  while ($a < 1) {
    $tempString = generateRandomString(10);
    if (file_exists("../../../img/accounts/".$tempString.".".$fileType)) {
      $error = true;
    }
    if (!$error) {
      $a++;
    }
  }
  return $tempString;
}
?>
