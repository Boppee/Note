<?php
  session_start();
  header('Content-type: application/json');
  require_once '../../../../php/load.php';

  if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

    $session = new session();
    if ($session->checkPrem("list", "units")) {
      $enc = new encoder("rev");

      $connect = new connect();
      $connection = $connect->newConnectionPre("FetchPublic", "units");

      $sth = $connection->prepare("SELECT * FROM `units`");
      $sth->execute();

      $test = $sth->fetchAll(PDO::FETCH_ASSOC);

      echo json_encode($test);
    }
  }
?>
