<?php
session_start();
header('Content-Type: application/json');
require_once '../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {


  $session = new session();
  if ($session->checkPrem("modify", "units")) {

    $connect = new connect();
    $connection = $connect->newConnectionPre("modifyUnits", "");

    $table = strip_tags($_POST["table"]);
    $id = strip_tags($_POST["id"]);
    $data = $_POST["updates"];

    $success = count($data);
    $cur = 0;

    if (isset($data["name"])) {
      $qu = "UPDATE `".$table."` SET `name` = :name WHERE `id` = :id";
      $sth = $connection->prepare($qu);
      $sth->bindParam(':name', $data["name"]);
      $sth->bindParam(':id', $id, PDO::PARAM_INT);
      if ($sth->execute()) {
        $cur++;
      }
    }
    if (isset($data["short"])) {
      $qu = "UPDATE `".$table."` SET `short` = :short WHERE `id` = :id";
      $sth = $connection->prepare($qu);
      $sth->bindParam(':short', $data["short"]);
      $sth->bindParam(':id', $id, PDO::PARAM_INT);
      if ($sth->execute()) {
        $cur++;
      }
    }
    if (isset($data["description"])) {
      $qu = "UPDATE `".$table."` SET `description` = :description WHERE `id` = :id";
      $sth = $connection->prepare($qu);
      $sth->bindParam(':description', $data["description"]);
      $sth->bindParam(':id', $id, PDO::PARAM_INT);
      if ($sth->execute()) {
        $cur++;
      }
    }
    if (isset($data["cbp"])) {
      $qu = "UPDATE `".$table."` SET `can_be_per` = :cbp WHERE `id` = :id";
      $sth = $connection->prepare($qu);
      $sth->bindParam(':cbp', $data["cbp"], $id, PDO::PARAM_INT);
      $sth->bindParam(':id', $id, PDO::PARAM_INT);
      if ($sth->execute()) {
        $cur++;
      }
    }
    if (isset($data["base"])) {
      $qu = "UPDATE `".$table."` SET `base` = :base WHERE `id` = :id";
      $sth = $connection->prepare($qu);
      $sth->bindParam(':base', $data["base"], $id, PDO::PARAM_INT);
      $sth->bindParam(':id', $id, PDO::PARAM_INT);
      if ($sth->execute()) {
        $cur++;
      }
    }
    if (isset($data["exponent"])) {
      $qu = "UPDATE `".$table."` SET `exponent` = :exponent WHERE `id` = :id";
      $sth = $connection->prepare($qu);
      $sth->bindParam(':exponent', $data["exponent"], $id, PDO::PARAM_INT);
      $sth->bindParam(':id', $id, PDO::PARAM_INT);
      if ($sth->execute()) {
        $cur++;
      }
    }
    if ($success == $cur) {
      echo json_encode($id);
    }else {
      echo json_encode("error");
    }

  }else {
    http_response_code(401);
  }
}else {
  http_response_code(401);
}
?>
