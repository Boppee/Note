<?php
session_start();
header('Content-Type: application/json');
require_once '../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  $connect = new connect();
  $connection = $connect->newConnectionPre("previewNews", "");

  $datetime = new DateTime('today');
  $datetime->modify('+2 day');

  $sth = $connection->prepare("SELECT * FROM `previewnews` WHERE `latestUpdate` < ADDDATE(NOW(), INTERVAL -24 HOUR)");
  $sth->execute();
  $newsArray = $sth->fetchAll(PDO::FETCH_ASSOC);



  foreach ($newsArray as $key => $value) {
    @$scanned_directory = array("");
    @$dir = '../../../../frontend/pages/news/imgs/preview/'.$value["id"];
    @$scanned_directory = array_diff(scandir($dir), array('..', '.'));
    foreach ($scanned_directory as $file) {
      @unlink($dir."/".$file);
    }
    @rmdir($dir);

    $sth = $connection->prepare("DELETE FROM `previewnews` WHERE `previewnews`.`id` = :id");
    $sth->bindParam(':id', $value["id"]);
    $sth->execute();
  }

}else {
  http_response_code(401);
}
?>
