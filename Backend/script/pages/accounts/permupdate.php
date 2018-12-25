<?php
session_start();
require_once '../../../php/load.php';

if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

  $session = new session();
  if ($session->checkPrem("mod", "accounts")) {

    $ud = grabUserData($_REQUEST["uid"]);
    $permArray = json_decode($ud["new_permsys"]);
    unset($ud);

  }
}
?>
