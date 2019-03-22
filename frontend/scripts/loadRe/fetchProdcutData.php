
<?php

  header('Content-Type: application/json');
  require_once '../connect.php';

  $connection = connect("products", "");

  $products = $connection->prepare("SELECT * FROM `1` WHERE `visible` = 1 ORDER BY RAND() LIMIT 1");
  $products->bindParam(':search', $text);
  $products->execute();
  $echo = $products->fetchAll(PDO::FETCH_ASSOC);

  $echo[0]["imgs"]= json_decode($echo[0]["imgs"]);

  echo json_encode($echo[0]);

?>
