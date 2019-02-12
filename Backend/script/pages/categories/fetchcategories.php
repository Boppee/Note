<?php
session_start();
header('Content-Type: application/json');
require_once '../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  if ($session->checkPrem("list", "categories")) {

    $connect = new connect();
    $connection = $connect->newConnectionPre("FetchFromcategories");
    $sth = $connection->prepare("SELECT * FROM `cats`");
    $sth->execute();

    $echo = $sth->fetchAll(PDO::FETCH_ASSOC);

    foreach ($echo as $key => $value) {
      $echo[$key]["child"] = json_decode($echo[$key]["child"]);
    }

    echo json_encode($echo);

  }
}
?>
