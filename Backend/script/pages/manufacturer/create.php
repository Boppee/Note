<?php
session_start();
header('Content-Type: application/json');
require_once '../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  if ($session->checkPrem("create", "units")) {

    $connect = new connect();
    $connection = $connect->newConnectionPre("createManufacturer", "");

    $name = strip_tags($_POST["name"]);
    $country = strip_tags($_POST["country"]);
    $website = strip_tags($_POST["website"]);

    $sth = $connection->prepare("INSERT INTO `manufacturer` (`name`, `country`, `website`) VALUES (:name, :country, :website)");
    $sth->bindParam(':name', $name);
    $sth->bindParam(':country', $country);
    $sth->bindParam(':website', $website);
    $sth->execute();

    echo json_encode($connection->lastInsertId());

  }
}

?>
