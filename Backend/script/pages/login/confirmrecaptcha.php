<?php

  session_start();

  $privateKey = "6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe";

  $captcha = strip_tags($_POST["key"]);
  //send request to google
  $response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$privateKey."&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
  //check response
  if($response['success'] == true){
    $_SESSION["logincaptcha"] = true;
    echo "pass";
  }else {
    echo "error";
  }
?>
