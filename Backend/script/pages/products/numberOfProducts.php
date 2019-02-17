<?php
  header('Content-type: application/json');
  require_once '../../../php/load.php';
  $connect = new connect();
  $connection = $connect->newConnectionPre("FetchFromProducts", "");

  $sth = $connection->prepare("SELECT COUNT(1) as total FROM products");
  $sth->execute();
  echo json_encode($sth->fetchAll(PDO::FETCH_ASSOC));
?>
