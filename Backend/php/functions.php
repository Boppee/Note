<?php
  function grabUserData($uid){
    $connect = new connect();

    $enc = new encoder("rev");

    $uid = $enc->revEncode($uid, "");

    $connection = $connect->newConnectionPre("FetchFromAccounts", "");

    $sth = $connection->prepare("SELECT * FROM `accounts` WHERE `username` = :uid");
    $sth->bindParam(':uid', $uid);
    $sth->execute();
    $a = $sth->fetch(PDO::FETCH_ASSOC);
    if (isset($a)) {
      return $a;
    }else {
      http_response_code(404);
    }
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
    $connection = $connect->newConnectionCred("root", "", "admin", "https://mrboppe.se");

    $enc = new encoder("rev");

    $uid = $enc->revEncode($uid, "");
    $date = date("Y-m-d H:i:s");

    $sth = $connection->prepare("UPDATE `accounts` SET `lastlogon`= :stime WHERE `username` = :uid");
    $sth->bindParam(':uid', $uid);
    $sth->bindParam(':stime', $date);
    $sth->execute();
  }
  function checkIfFileName($fileType){
    $a = 0;
    $error = false;
    while ($a < 1) {
      $tempString = generateRandomString(10);
      if (file_exists("../../../img/accounts/".$tempString.".".$fileType)) {
        $error = true;
      }
      if (!$error) {
        $a++;
      }
    }
    return $tempString;
  }
  function utf8_converter($array) {
    array_walk_recursive($array, function(&$item, $key) {
        if (!mb_detect_encoding($item, 'utf-8', true)) {
            $item = utf8_encode($item);
        }
    });

    return $array;
  }
?>
