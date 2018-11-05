<?php

  session_start();

  $privateKey = "6LcxQXIUAAAAAFyS69TQkWljRnY2myS-26Y7fjIZ";

  $captcha = $_POST["key"];

  $response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$privateKey."&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
  if($response['success'] == true){
    $_SESSION["logincaptcha"] = array('pass' => true, 'time' => date("h:i"));
    echo "pass";
  }else {
    echo "error";
  }
?>
