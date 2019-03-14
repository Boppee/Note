<?php

  header('Content-Type: application/json');
  require_once '../../../php/load.php';

  $connect = new connect();
  $connection = $connect->newConnectionPre("FetchPublic", "products");
  $sth = $connection->prepare("SELECT * FROM `cats`");
  $sth->execute();

  $cats = $sth->fetchAll(PDO::FETCH_ASSOC);

  $id = strip_tags($_POST["id"]);

  $a = 0;
  $echoArray = array();

  $pos = findId($id, $cats);

  $echoArray[$a] = array('id' => $cats[$pos]["id"], 'name' => $cats[$pos]["name"]);
  $a++;
  $parent = $cats[$pos]["par"];
  $layer = $cats[$pos]["layer"];

  for ($i=0; $i < $layer-1; $i++) {
    $pos = findId($parent, $cats);
    $echoArray[$a] = array('id' => $cats[$pos]["id"], 'name' => $cats[$pos]["name"]);
    $parent = $cats[$pos]["par"];
    $a++;
  }

  $echoArray[$layer] = array('id' => "1", 'name' => 'start');

  echo json_encode($echoArray);

  function findId($id, $cats){
    foreach ($cats as $key => $value) {
      if ($id == $value["id"]) {
        return $key;
      }
    }
  }

?>
