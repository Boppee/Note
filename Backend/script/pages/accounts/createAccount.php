<?php

  session_start();
  header('Content-type: application/json');
  require_once '../../../php/load.php';

  if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

    $session = new session();
    if ($session->checkPrem("create", "accounts")) {

      $connect =  new connect();
      $connection = $connect->newConnectionPre("CreateAdminAccount");
      $enc = new encoder("private");

      $fileName = $_FILES['file']['name'];
      $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
      $fileError = $_FILES['file']['error'];
      $fileContent = file_get_contents($_FILES['file']['tmp_name']);
      $imgErrors = array();

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
        $imgtype = $fileP.".".pathinfo($fileName, PATHINFO_EXTENSION);
      }

      $uid = strip_tags($_POST["uid"]);
      $pwd = strip_tags($_POST["pwd"]);
      $email = strip_tags($_POST["email"]);
      $active = strip_tags($_POST["active"]);

      $uid = $enc->revEncode($uid, "");
      $iv = $enc->generatIv();
      $email = $enc->encode($email, $iv);
      $pwd = password_hash($pwd, PASSWORD_DEFAULT);

      $perms = $_POST["perms"];

      $sth = $connection->prepare("INSERT INTO `accounts` (`active`, `username`, `password`, `iv`, `email`, `new_permsys`, `img`) VALUES (:active, :u, :p, :i, :e, :perms, :imgtype)");
      $sth->bindParam(':active', $active);
      $sth->bindParam(':u', $uid);
      $sth->bindParam(':p', $pwd);
      $sth->bindParam(':i', $iv);
      $sth->bindParam(':e', $email);
      $sth->bindParam(':perms', $perms);
      $sth->bindParam(':imgtype', $imgtype);
      $sth->execute();

      echo $_POST["uid"];

    }
  }

?>
