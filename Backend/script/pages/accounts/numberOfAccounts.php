<?php
  header('Content-type: application/json');
  require_once '../../../php/load.php';
  $connect = new connect();
  $connection = $connect->newConnectionPre("FetchFromAccounts");

  $sth = $connection->prepare("SELECT COUNT(1) as total FROM accounts");
  $sth->execute();

  echo json_encode($sth->fetchAll(PDO::FETCH_ASSOC));
?>
