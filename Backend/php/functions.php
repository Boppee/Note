<?php
  function grabUserData($uid){
    $connect = new connect();

    $enc = new encoder("rev");

    $uid = $enc->revEncode($uid, "");

    //echo $uid;

    $connection = $connect->newConnectionPre("FetchFromAccounts");

    $sth = $connection->prepare("SELECT * FROM `accounts` WHERE `username` = :uid");
    $sth->bindParam(':uid', $uid);
    $sth->execute();
    return $sth->fetch(PDO::FETCH_ASSOC);
  }

  function goToPage($url){
    header('Location: '.$url);
    exit;
  }

  function generateRandomString($length) {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
  }
  function updateLogon($uid){

    date_default_timezone_set('Europe/Stockholm');

    $connect = new connect();
    $connection = $connect->newConnectionCred("root", "", "admin", "localhost");

    $enc = new encoder("rev");

    $uid = $enc->revEncode($uid, "");
    $date = date("Y-m-d H:i:s");

    $sth = $connection->prepare("UPDATE `accounts` SET `lastlogon`= :stime WHERE `username` = :uid");
    $sth->bindParam(':uid', $uid);
    $sth->bindParam(':stime', $date);
    $sth->execute();
  }
?>
