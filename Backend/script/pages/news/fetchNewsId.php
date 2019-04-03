<?php
session_start();
header('Content-Type: application/json');
require_once '../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  $enc = new encoder("rev");

  $session = new session();
  if ($session->checkPrem("list", "news")) {

    $connect = new connect();
    $connection = $connect->newConnectionPre("fetchNews", "");

    $id = $_POST["id"];

    $sth = $connection->prepare("SELECT * FROM `news` WHERE id = :id");
    $sth->bindParam(':id', $id);
    $sth->execute();

    $echo = $sth->fetchAll(PDO::FETCH_ASSOC);

    foreach ($echo as $key => $value) {
      $echo[$key]["imgs"] = json_decode($echo[$key]["imgs"], true);
    }

    echo json_encode($echo[0]);


  }else {
    http_response_code(401);
  }
}else {
  http_response_code(401);
}
?>
