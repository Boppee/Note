<?php
session_start();
header('Content-Type: application/json');
require_once '../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {


  $session = new session();
  if ($session->checkPrem("modify", "units")) {

    $connect = new connect();
    $connection = $connect->newConnectionPre("modifyManufacturer", "");

    $id = strip_tags($_POST["id"]);
    $data = $_POST["updates"];

    $success = count($data);
    $cur = 0;

    if (isset($data["name"])) {
      $qu = "UPDATE `manufacturer` SET `name` = :name WHERE `id` = :id";
      $sth = $connection->prepare($qu);
      $sth->bindParam(':name', $data["name"]);
      $sth->bindParam(':id', $id, PDO::PARAM_INT);
      if ($sth->execute()) {
        $cur++;
      }
    }
    if (isset($data["website"])) {
      $qu = "UPDATE `manufacturer` SET `website` = :website WHERE `id` = :id";
      $sth = $connection->prepare($qu);
      $sth->bindParam(':website', $data["website"]);
      $sth->bindParam(':id', $id, PDO::PARAM_INT);
      if ($sth->execute()) {
        $cur++;
      }
    }
    if (isset($data["country"])) {
      $qu = "UPDATE `manufacturer` SET `country` = :country WHERE `id` = :id";
      $sth = $connection->prepare($qu);
      $sth->bindParam(':country', $data["country"]);
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

  }
}
?>
