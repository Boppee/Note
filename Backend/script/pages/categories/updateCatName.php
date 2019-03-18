<?php
session_start();
header('Content-Type: application/json');
require_once '../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  if ($session->checkPrem("modify", "categories")) {
    $id = strip_tags($_POST["id"]);
    $name = $_POST["name"];

    if (strpos($name, '<') === 0) {
      preg_match('/<i class="fas .*.*"><\/i>/i', $name, $output_array);
      if (count($output_array) == 0) {
        http_response_code(400);
        die();
      }
    }

    $connect = new connect();
    $connection = $connect->newConnectionPre("modifyCats", "");

    $sth = $connection->prepare("UPDATE `cats` SET `name` = :name WHERE `id` = :id");
    $sth->bindParam(':name', $name);
    $sth->bindParam(':id', $id, PDO::PARAM_INT);
    if ($sth->execute()) {
      http_response_code(200);
    }else {
      http_response_code(304);
    }

  }else {
    http_response_code(401);
  }
}else {
  http_response_code(401);
}

?>
