<?php

  header('Content-type: application/json');
  require_once '../../../php/load.php';

  $connect = new connect();
  $connection = $connect->newConnectionPre("FetchPublic", "products");

  $text = strip_tags($_POST["text"]);
  //fetch suggestions from units when creating a table structure
  $sth = $connection->prepare("SELECT * FROM `manufacturer` WHERE `name` LIKE concat('%', :text, '%')");
  $sth->bindParam(':text', $text);
  $sth->execute();

  $test = $sth->fetchAll(PDO::FETCH_ASSOC);

  echo json_encode(utf8_converter($test));

?>
