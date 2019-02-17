<?php
session_start();
header('Content-Type: application/json');
require_once '../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {


  $session = new session();
  if ($session->checkPrem("delete", "units")) {

    $connect = new connect();
    $connection = $connect->newConnectionPre("removeUnits", "");

    $table = strip_tags($_POST["table"]);
    $id = strip_tags($_POST["id"]);

    $qu = "DELETE FROM `".$table."` WHERE `id` = :id";

    $sth = $connection->prepare($qu);
    $sth->bindParam(':id', $id, PDO::PARAM_INT);
    if ($sth->execute()) {
          echo json_encode($table.$id);
    }


  }
}
?>
