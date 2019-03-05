<?php

session_start();
require_once '../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  $enc = new encoder("rev");

  $session = new session();
  if ($session->checkPrem("list", "accounts")) {

    $account = grabUserData(strip_tags($_REQUEST["uid"]));

    if (!$account) {
      http_response_code(200);
    }else {
      http_response_code(404);
    }

  }else {
    http_response_code(401);
  }
}else {
  http_response_code(401);
}
?>
