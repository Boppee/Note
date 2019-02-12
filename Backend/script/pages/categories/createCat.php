<?php
session_start();
header('Content-Type: application/json');
require_once '../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  if ($session->checkPrem("create", "categories")) {

    $parent = $_POST["parent"];
    $name = $_POST["newCat"];

    $connect = new connect();
    $connection = $connect->newConnectionPre("creatCats");

    $sth = $connection->prepare("SELECT * FROM `cats` WHERE id = :id");
    $sth->bindParam(':id', $parent, PDO::PARAM_INT);
    $sth->execute();
    $echo = $sth->fetchAll(PDO::FETCH_ASSOC);
    $newchildArray = json_decode($echo[0]["child"]);

    $layer = $echo[0]["layer"]+1;

    $sth = $connection->prepare("INSERT INTO `cats`(`name`, `par`, `layer`) VALUES (:name,:par,:layer)");
    $sth->bindParam(':par', $parent, PDO::PARAM_INT);
    $sth->bindParam(':name', $name);
    $sth->bindParam(':layer', $layer, PDO::PARAM_INT);
    $sth->execute();

    $id = $connection->lastInsertId();

    array_push($newchildArray, $id);

    $newchildArray = json_encode($newchildArray);

    $sth = $connection->prepare("UPDATE `cats` SET `child`=:child WHERE id = :id");
    $sth->bindParam(':id', $echo[0]["id"], PDO::PARAM_INT);
    $sth->bindParam(':child', $newchildArray);
    $sth->execute();
  }
}

?>
