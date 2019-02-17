<?php
session_start();
header('Content-Type: application/json');
require_once '../../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  if ($session->checkPrem("create", "units")) {

    $connect = new connect();
    $connection = $connect->newConnectionPre("createUnits", "");

    $name = strip_tags($_POST["name"]);
    $short = strip_tags($_POST["short"]);
    $description = strip_tags($_POST["description"]);
    $can_be_per = strip_tags($_POST["cbp"]);

    $sth = $connection->prepare("INSERT INTO `units` (`name`, `short`, `can_be_per`, `description`) VALUES (:name, :short, :cbp, :description)");
    $sth->bindParam(':name', $name);
    $sth->bindParam(':short', $short);
    $sth->bindParam(':description', $description);
    $sth->bindParam(':cbp', $can_be_per, PDO::PARAM_INT);
    $sth->execute();

    echo json_encode($connection->lastInsertId());
  }
}

?>
