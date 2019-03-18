<?php

function connect($db, $host){

  $uid = "root";
  $pwd = "";

  if ($host == "") {
    $host = "localhost";
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
