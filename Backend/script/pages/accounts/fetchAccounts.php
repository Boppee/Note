<?php

  session_start();
  header('Content-type: application/json');
  require_once '../../../php/load.php';

  if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

    $session = new session();

    if ($session->verify()) {
      if ($session->checkPrem("manageAccounts")) {

        $salt = new salt();
        $enc = new encoder("rev");

        $connect = new connect();
        $connection = $connect->newConnectionPre("FetchFromAccounts");

        $sth = $connection->prepare("SELECT `active`, `username`, `img`, `lastlogon`, `json_page`, `json_perms` FROM `accounts` LIMIT 10");
        $sth->execute();

        $test = $sth->fetchAll(PDO::FETCH_ASSOC);

        foreach ($test as $key => $value) {
          $test[$key]["username"] = $enc->revDecode($value["username"]);
          $test[$key]["json_page"] = json_decode($value["json_page"]);
          $test[$key]["json_perms"] = json_decode($value["json_perms"]);
        }
        echo json_encode($test);

      }
    }
  }

?>
