<?php

  session_start();
  header('Content-type: application/json');
  require_once '../../../php/load.php';

  if (isset($_SESSION["signedIn"]) && $_SESSION["signedIn"]) {

    $limit = "10";//$_POST["limit"];
    $offset = "0";//$_POST["offset"];

    $session = new session();

    if ($session->verify()) {
      if ($session->checkPrem("manageAccounts")) {

        $salt = new salt();
        $enc = new encoder("rev");

        $connect = new connect();
        $connection = $connect->newConnectionPre("FetchFromAccounts");

        $sth = $connection->prepare("SELECT `active`, `username`, `lastlogon`, `json_page`, `json_perms` FROM `accounts`");
        //$sth->bindParam(':accountlimit', $limit, PDO::PARAM_INT);
        $sth->execute();

        $test["accounts"] = $sth->fetchAll(PDO::FETCH_ASSOC);

        foreach ($test["accounts"] as $key => $value) {
          $test["accounts"][$key]["username"] = $enc->revDecode($value["username"]);
          $test["accounts"][$key]["json_page"] = json_decode($value["json_page"]);
          $test["accounts"][$key]["json_perms"] = json_decode($value["json_perms"]);
        }
        $sth = $connection->prepare("SELECT COUNT(1) as total FROM accounts");
        $sth->execute();

        $test["rows"] = $sth->fetchAll(PDO::FETCH_ASSOC);
        $test["rows"] = $test["rows"][0];
        echo json_encode($test);

      }
    }
  }

?>
