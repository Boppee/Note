<?php
session_start();
header('Content-type: application/json');
require_once '../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  $session = new session();
  if ($session->checkPrem("mod", "accounts")) {

    $enc = new encoder("rev");
    $uid = $enc->revEncode($_POST["uid"], "");

    $ud = grabUserData($_POST["uid"]);
    $permArray = json_decode($ud["new_permsys"], true);
    $pl = count($permArray);
    unset($ud);

    $removeArray;
    $addArray;

    for ($i=4; $i < $pl; $i++) {
      if ($_POST["index"] == $permArray[$i][0]) {
        $pp = $i;
        $tempArray = $permArray[$i];
        unset($permArray[$i]);
      }
    }
    if (!isset($pp)) {
      $newArray = array($_POST["index"], $_POST["name"]);
      if ($_POST["name"] != "list" && $_POST["name"] != "create") {
        if (!array_search("list", $newArray)) {
          array_push($newArray, "list");
        }
      }
      array_push($permArray, $newArray);
    }elseif ($_POST["state"] == 0){
      $key = array_search($_POST["name"], $tempArray);
      if (isset($key)) {
        array_splice($tempArray, $key, 1);
        $key = array_search($_POST["name"], $tempArray);
        if ($_POST["name"] == "list") {
          for ($i=count($tempArray)-1; $i > 0; $i--) {
            if ($i != $key && $tempArray[$i] != "create") {
              array_splice($tempArray, $i, 1);
            }
          }
        }
        if (count($tempArray)-1 != 0) {
          $permArray[$pp] = $tempArray;
        }
      }
    }elseif ($_POST["state"] == 1){
      if (!array_search($_POST["name"], $tempArray)) {
        array_push($tempArray, $_POST["name"]);
      }
      if ($_POST["name"] != "list" || $_POST["name"] != "create") {
        if (!array_search("list", $tempArray)) {
          array_push($tempArray, "list");
        }
      }
      $permArray[$pp] = $tempArray;
    }

    $permArray = json_encode(array_values($permArray));

    $connect = new connect();
    $connection = $connect->newConnectionPre("UpdateAccount");
    $sth = $connection->prepare("UPDATE `accounts` SET `new_permsys`= :array WHERE `username` = :uid");
    $sth->bindParam(':array', $permArray);
    $sth->bindParam(':uid', $uid);
    $sth->execute();

    echo $permArray;
  }
}
?>
