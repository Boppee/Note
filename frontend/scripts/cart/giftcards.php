<?php
  header('Content-Type: application/json');

  //$cardnr = strip_tags($_POST["nr"]);

  $cardnr = "12345";
  $cardsecret = "1337";

  $connection = connectGiftCards("giftcards", "");

  $date = date("Y-m-d", strtotime("today"));

  $products = $connection->prepare("SELECT * FROM `cards` WHERE `cardnr` = :card AND `valid` >= :day");
  $products->bindParam(':card', $cardnr);
  $products->bindParam(':day', $date);
  $products->execute();
  $cardInfo = $products->fetchAll(PDO::FETCH_ASSOC);

  $echo["status"] = "bad";
  $echo["id"] = strip_tags($_POST["id"]);

  if (isset($cardInfo[0])) {
    if (password_verify($cardsecret, $cardInfo[0]["cardsecret"])) {
      $echo["card"] = $cardInfo[0]["funds"];
      $echo["status"] = "ok";
      echo json_encode($echo);
    }else {
      echo json_encode($echo);
    }
  }else {
    echo json_encode($echo);
  }

  function connectGiftCards($db, $host){

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
