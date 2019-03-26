<?php

  @$nr = strip_tags($_POST["nr"]);

  $nr = "70-631 80 6";

  $url = 'https://api.phonebooth.se/validate/'.$nr.'/';

  $ch = curl_init($url);
  curl_setopt_array($ch, array(
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => $url
  ));
  $response = curl_exec($ch);
  curl_close($ch);

  $json = json_decode($response, true);

  if ($json["active"] == 1 && $json["valid"] == 1) {
    echo "pass";
  }else {
    echo "invalid nr";
  }

?>
