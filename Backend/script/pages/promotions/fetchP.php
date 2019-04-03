<?php
session_start();
header('Content-Type: application/json');
require_once '../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  $enc = new encoder("rev");

  $session = new session();
  if ($session->checkPrem("create", "promotions")) {

    $type = strip_tags($_POST["type"]);
    $val = strip_tags($_POST["val"]);

    $connect = new connect();
    $connection = $connect->newConnectionPre("FetchFromProducts", "");

    if ($type == "id") {
      $sth = $connection->prepare("SELECT * FROM `1` WHERE product_id = :id");
      $sth->bindParam(':id', $val, PDO::PARAM_INT);
      $sth->execute();
      $echo["products"] = $sth->fetchAll(PDO::FETCH_ASSOC);
    }elseif ($type == "name") {
      $sth = $connection->prepare("SELECT * FROM `1` WHERE name = :name");
      $sth->bindParam(':name', $val);
      $sth->execute();
      $echo["products"] = $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    foreach ($echo["products"] as $key => $value) {
      $echo["products"][$key]["imgs"] = json_decode($echo["products"][$key]["imgs"]);
    }

    echo json_encode($echo, true);

  }else {
    http_response_code(401);
  }
}else {
  http_response_code(401);
}
?>
