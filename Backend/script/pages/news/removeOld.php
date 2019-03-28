<?php
session_start();
header('Content-Type: application/json');
require_once '../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  $connect = new connect();
  $connection = $connect->newConnectionPre("previewNews", "");

  $datetime = new DateTime('today');
  $datetime->modify('+2 day');

  $sth = $connection->prepare("SELECT `latestUpdate`, `id`, `imgs`, `uniquepage`, `document`, `css` FROM `previewnews` WHERE `latestUpdate` < (NOW() + INTERVAL 2 DAYS)");
  $sth->execute();
  $newsArray = $sth->fetchAll(PDO::FETCH_ASSOC);

}else {
  http_response_code(401);
}
?>
