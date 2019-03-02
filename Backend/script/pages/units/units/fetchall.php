<?php

  header('Content-type: application/json');
  require_once '../../../../php/load.php';

  $enc = new encoder("rev");

  $connect = new connect();
  $connection = $connect->newConnectionPre("FetchPublic", "units");

  $sth = $connection->prepare("SELECT * FROM `units`");
  $sth->execute();

  $test = $sth->fetchAll(PDO::FETCH_ASSOC);

  echo json_encode(utf8_converter($test));

?>
