<?php
session_start();
header('Content-type: application/json');
require_once '../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  $session = new session();
  if ($session->checkPrem("mod", "accounts")) {

    echo $permArray;
  }
}
?>
