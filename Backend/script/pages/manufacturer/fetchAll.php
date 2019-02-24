<?php
  header('Content-type: application/json');
  require_once '../../../php/load.php';

  $connect = new connect();
  $connection = $connect->newConnectionPre("FetchPublic", "products");

  $sth = $connection->prepare("SELECT * FROM `manufacturer`");
  $sth->execute();
  $test = $sth->fetchAll(PDO::FETCH_ASSOC);

  echo json_encode($test);
?>
