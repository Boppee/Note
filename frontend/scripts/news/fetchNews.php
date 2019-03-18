<?php

header('Content-Type: application/json');
require_once '../connect.php';

$connection = connect("promnews", "");
$sth = $connection->prepare("SELECT * FROM `news`");
$sth->execute();

$echo = $sth->fetchAll(PDO::FETCH_ASSOC);

foreach ($echo as $key => $value) {
  $echo[$key]["imgs"] = json_decode($echo[$key]["imgs"]);
}

echo json_encode($echo);

?>
