<?php

  header('Content-Type: application/json');
  require_once '../../../php/load.php';

  $id = strip_tags($_POST["id"]);

  $connect = new connect();
  $connection = $connect->newConnectionPre("FetchPublic", "products");
  //grab data to see if cat have table
  $sth = $connection->prepare("SELECT * FROM `cats` WHERE id = :id");
  $sth->bindParam(':id', $id, PDO::PARAM_INT);
  $sth->execute();
  $echo = $sth->fetchAll(PDO::FETCH_ASSOC);

  if ($echo[0]["havetable"] == 0) {
    $arrayName = array('table' => false, 'data' => $echo[0]);
  }else {
    //get data about the cats table
    $var = "SHOW FULL COLUMNS FROM `".$id."`";
    $connection = $connect->newConnectionPre("FetchPublic", "products");
    $sth = $connection->prepare($var);
    $sth->execute();
    $data = $sth->fetchAll(PDO::FETCH_ASSOC);

    $arrayName = array('table' => true, 'data' => $echo[0], 'structure' => $data);
  }
  echo json_encode($arrayName);

?>
