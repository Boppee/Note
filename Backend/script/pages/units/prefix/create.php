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
    $base = strip_tags($_POST["base"]);
    $exponent = strip_tags($_POST["exponent"]);

    $sth = $connection->prepare("INSERT INTO `prefix` (`name`, `short`, `base`, `exponent`) VALUES (:name, :short, :base, :exponent)");
    $sth->bindParam(':name', $name);
    $sth->bindParam(':short', $short);
    $sth->bindParam(':base', $base, PDO::PARAM_INT);
    $sth->bindParam(':exponent', $exponent, PDO::PARAM_INT);
    $sth->execute();

    echo json_encode($connection->lastInsertId());

  }
}

?>
