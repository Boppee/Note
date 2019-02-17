<?php
session_start();
header('Content-Type: application/json');
require_once '../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  if ($session->checkPrem("list", "categories")) {

    $connect = new connect();
    $connection = $connect->newConnectionPre("FetchFromcategories", "");
    $sth = $connection->prepare("SELECT * FROM `cats` WHERE id = :id");
    $sth->bindParam(':id', $_POST["id"], PDO::PARAM_INT);
    $sth->execute();
    $echo = $sth->fetchAll(PDO::FETCH_ASSOC);

    if ($echo[0]["havetable"] == 0) {
      $arrayName = array('table' => false, 'data' => $echo[0]);
    }else {
      $var = "DESCRIBE `".strip_tags($_POST["id"])."`";
      $connection = $connect->newConnectionPre("FetchFromProducts",, "");
      $sth = $connection->prepare($var);
      $sth->execute();
      $data = $sth->fetchAll(PDO::FETCH_ASSOC);

      $arrayName = array('table' => true, 'data' => $echo[0], 'structure' => $data[0]);
    }
    echo json_encode($arrayName);
  }
}
?>
