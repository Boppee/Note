<?php

header('Content-Type: application/json');
require_once '../connect.php';

$connection = connect("promnews", "");

$id = $_POST["id"];

$sth = $connection->prepare("SELECT * FROM `news` WHERE id = :id AND `visible` = 1");
$sth->bindParam(':id', $id);
$sth->execute();

$echo = $sth->fetchAll(PDO::FETCH_ASSOC);

foreach ($echo as $key => $value) {
  $echo[$key]["imgs"] = json_decode($echo[$key]["imgs"], true);
}

echo json_encode($echo);

?>
