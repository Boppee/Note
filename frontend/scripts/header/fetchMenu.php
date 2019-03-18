<?php

header('Content-Type: application/json');
require_once '../connect.php';

$connection = connect("products", "");
$sth = $connection->prepare("SELECT * FROM `cats`");
$sth->execute();

$echo = $sth->fetchAll(PDO::FETCH_ASSOC);

foreach ($echo as $key => $value) {
  $echo[$key]["child"] = json_decode($echo[$key]["child"]);
}

echo json_encode($echo);

?>
