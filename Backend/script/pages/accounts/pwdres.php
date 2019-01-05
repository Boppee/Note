<?php

session_start();
require_once '../../../php/load.php';

if (isset($_SESSION["signedIn"])) {

  $enc = new encoder("rev");

  $session = new session();
  if ($session->checkPrem("respwd", "accounts")) {

    $uid = strip_tags($_POST["uid"]);
    $newPwd = $_POST["newPwd"];


    $enc = new encoder("public");
    $encP = new encoder("private");
    $sendUid = $enc->decode($_SESSION["cred"]["uid"], $_SESSION["iv"]);
    $senderData = grabUserData($sendUid);
    $senderEmail = $encP->decode($senderData["email"], $senderData["iv"]);

    $sendCode = generateRandomString(24);
    $retrunCode = generateRandomString(24);

    $pwd = $enc->revEncode($newPwd, "");
    $storeCode = password_hash($sendCode, PASSWORD_DEFAULT);

    $link = "<a href='http://mrboppe.se/note/backend/verification.php?code=".$sendCode."&cr=".$sendUid."&uid=".$uid."'>Change Password</a>";

    $changePwd = new changePwd($senderEmail, $link);

    $connect = new connect();
    $connection = $connect->newConnectionPre("pwdChange");
    $sth = $connection->prepare("INSERT INTO `code`(`cr`, `uid`, `pwd`, `code`, `retruncode`) VALUES (:cr,:uid,:pwd,:code, :retrunCode)");
    $sth->bindParam(':cr', $sendUid);
    $sth->bindParam(':uid', $uid);
    $sth->bindParam(':pwd', $pwd);
    $sth->bindParam(':code', $storeCode);
    $storeReturnCode = password_hash($retrunCode, PASSWORD_DEFAULT);
    $sth->bindParam(':retrunCode', $storeReturnCode);
    $sth->execute();

    echo $retrunCode;

  }
}

?>
