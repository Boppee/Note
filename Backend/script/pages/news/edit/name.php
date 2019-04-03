<?php
session_start();
header('Content-Type: application/json');
require_once '../../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  $session = new session();
  if ($session->checkPrem("create", "news")) {

    $connect = new connect();
    $connection = $connect->newConnectionPre("modifyNews", "");

    $val = strip_tags($_POST["val"]);
    $id = strip_tags($_POST["id"]);

    $sth = $connection->prepare("UPDATE `news` SET `name` = :name WHERE `id` = :id");
    $sth->bindParam(':name', $val);
    $sth->bindParam(':id', $id);
    $sth->execute();

  }else {
    http_response_code(401);
  }
}else {
  http_response_code(401);
}
?>
