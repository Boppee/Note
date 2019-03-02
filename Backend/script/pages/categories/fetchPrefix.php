<?php

  header('Content-Type: application/json');
  require_once '../../../php/load.php';

  $connect = new connect();
  $connection = $connect->newConnectionPre("FetchPublic", "units");
  $sth = $connection->prepare("SELECT * FROM `prefix`");
  $sth->execute();

  echo json_encode(utf8_converter($sth->fetchAll(PDO::FETCH_ASSOC)), true);
?>
