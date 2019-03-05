<?php
session_start();
header('Content-type: application/json');
require_once '../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  $session = new session();
  if ($session->checkPrem("modify", "accounts")) {

    $index = strip_tags($_POST["index"]);
    $perm = strip_tags($_POST["name"]);
    $state = strip_tags($_POST["state"]);
    $uid = strip_tags($_POST["uid"]);

    if (isset($index) && isset($perm) && isset($state) && isset($uid)) {
      $userdata = grabUserData($uid);
      $permArray = json_decode($userdata["new_permsys"]);
      unset($userdata);
      $perms = count($permArray);

      for ($i=4; $i < $perms; $i++) {
        if ($permArray[$i][0] == $index) {
          $indexKey = $i;
        }
      }

      if (isset($indexKey)) {
        $key = array_search($perm, $permArray[$indexKey]);
        if ($state == 1) {
          if (!$key) {
            array_push($permArray[$indexKey], $perm);
          }
        }elseif ($state == 0) {
          array_splice($permArray[$indexKey], $key, 1);
        }
      }else {
        $indexKey = $perms;
        if ($state == 1) {
          $permArray[$indexKey][0] = $index;
          array_push($permArray[$indexKey], $perm);
        }
      }

      $items = array("modify", "delete", "reset password");

      if ($perm == "list") {
        if ($state == 0) {
          foreach ($items as $key => $value) {
            if (array_search($value, $permArray[$indexKey])) {
              unset($permArray[$indexKey][array_search($value, $permArray[$indexKey])]);
            }
          }
          $permArray[$indexKey] = array_values(array_filter($permArray[$indexKey]));
        }
      }else {
        if (!array_search("list", $permArray[$indexKey])) {
          if ($perm != "create") {
            array_push($permArray[$indexKey], "list");
          }
        }
      }

      if (count($permArray[$indexKey]) == 1) {
        unset($permArray[$indexKey]);
      }

      $post = json_encode($permArray);

      $enc = new encoder("rev");

      $uid = $enc->revEncode($uid, "");

      $connect = new connect();
      $connection = $connect->newConnectionPre("UpdateAccount", "");

      $sth = $connection->prepare("UPDATE `accounts` SET `new_permsys`= :array WHERE `username` = :uid");
      $sth->bindParam(':array', $post);
      $sth->bindParam(':uid', $uid);
      $sth->execute();

      echo $post;
    }else {
      http_response_code(406);
    }
  }else {
    http_response_code(401);
  }
}else {
  http_response_code(401);
}
?>
