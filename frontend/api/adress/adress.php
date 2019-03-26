<?php

$token  = 'e5fced0d68e863e87ebe933d42bb8e4ea362eeaa';
//$adress = str_replace(' ', '+', strip_tags($_POST["street"]));
//$zip = str_replace(' ', '+', strip_tags($_POST["zip"]));
//$nr = strip_tags($_POST["nr"]);
//$city = str_replace(' ', '+', strip_tags($_POST["zip"]));

$adress = "postvägen";
$zip = "266+52";
$nr = "13";
$city = "Vejbystrand";

$url    = 'https://papapi.se/json/?v='.$adress.'|'.$nr.'|'.$zip.'|'.$city.'&token='.$token;

echo $url;

$ch = curl_init($url);
curl_setopt_array($ch, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $url
));
$response = curl_exec($ch);
curl_close($ch);

$json = json_decode($response, true);

if ($json['result']['status']) {
  print_r($json);
} else {
  echo 'Inget resultat!';
}

?>
