<?php
session_start();
header('Content-type: application/json');
require_once '../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  $session = new session();
  if ($session->checkPrem("list", "accounts")) {

    $connect = new connect();
    $connection = $connect->newConnectionPre("perms");
    $sth = $connection->prepare("SELECT * FROM `privileges`");
    $sth->execute();
    $fetch = $sth->fetchAll(PDO::FETCH_ASSOC);
    foreach ($fetch as $key => $value) {
      $fetch[$key]["privileges"] = json_decode($fetch[$key]["privileges"]);
    }
    echo json_encode($fetch);
  }
}
?>
