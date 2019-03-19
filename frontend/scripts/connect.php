<?php

function connect($db, $host){

  $uid = "per90";
  $pwd = "";

  if ($host == "") {
    $host = "155.4.124.14";
  }
  if ($db != "") {
    try {
      $dbh = new PDO('mysql:host='.$host.';dbname='.$db,$uid,$pwd);
    } catch(PDOException $e){
      http_response_code(401);
      die();
    }
    if (isset($dbh)) {
      return $dbh;
    }
  }else {
    http_response_code(401);
    die();
  }
}

?>
