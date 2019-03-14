<?php
session_start();
header('Content-Type: application/json');
require_once '../../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {


  $session = new session();
  if ($session->checkPrem("modify", "products")) {

    $userid = $_POST["userid"];

    $connect = new connect();
    $connection = $connect->newConnectionPre("FetchFromProducts", "");
    $sth = $connection->prepare("SELECT `imgs` FROM `1` WHERE product_id = :id");
    $sth->bindParam(':id', $userid, PDO::PARAM_INT);
    $sth->execute();
    $imgarray = json_decode($sth->fetchAll(PDO::FETCH_ASSOC)[0]["imgs"], true);

    $imgname = $_POST["id"];

    foreach ($imgarray as $key => $value) {
      if ($value["name"] == $imgname) {
      if (unlink("../../../../img/p/".$userid."/".$imgname.".".$value["imgtype"])) {
          array_splice($imgarray, $key, 1);

          $updateArray = json_encode($imgarray);

          $connect->newConnectionPre("UpdateProducts", "");
          $sth = $connection->prepare("UPDATE `1` SET `imgs`= :array WHERE product_id = :id");
          $sth->bindParam(':id', $userid, PDO::PARAM_INT);
          $sth->bindParam(':array', $updateArray);
          if ($sth->execute()) {
            echo "success";
          }
        }
      }
    }

  }else {
    http_response_code(401);
  }
}else {
  http_response_code(401);
}
?>
