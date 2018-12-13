<?php

session_start();
header('Content-type: application/json');
require_once '../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  $session = new session();
  if ($session->checkPrem("mod", "accounts")) {

    $connect = new connect();

    $encPr = new encoder("private");

    $uid = strip_tags($_POST["uid"]);
    $userdata = grabUserData($uid);
    $uid = $encPr->revEncode($uid, "");

    $val = strip_tags($_POST["val"]);
    $index = strip_tags($_POST["index"]);

    $iv = $userdata["iv"];

    if ($index == "email") {
      $val = $encPr->encode($val, $iv);
    }
    if ($index == "username") {
      $uidtest = grabUserData($val);
      if (!isset($uidtest["username"])) {
        $val = $encPr->revEncode($val, "");
      }else {
        $errors = array('status' => "errors", 'errors' => "Username taken!", );
        echo json_encode($errors);
        exit();
      }
    }

    $connection = $connect->newConnectionPre("UpdateAccount");

    $sth = $connection->prepare("UPDATE `accounts` SET `".$index."`= :val WHERE username = :uid");

    $sth->bindParam(':val', $val);
    $sth->bindParam(':uid', $uid);

    $sth->execute();

    echo "done";

  }
}

?>
