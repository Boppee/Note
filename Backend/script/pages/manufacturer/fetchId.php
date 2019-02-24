<?php
  header('Content-type: application/json');
  require_once '../../../php/load.php';

  $connect = new connect();
  $connection = $connect->newConnectionPre("FetchPublic", "products");

  $id = strip_tags($_POST["id"]);

  $sth = $connection->prepare("SELECT * FROM `manufacturer` WHERE `id` = :id");
  $sth->bindParam(':id', $id, PDO::PARAM_INT);
  $sth->execute();
  $test = $sth->fetchAll(PDO::FETCH_ASSOC);

  echo json_encode($test);
?>
