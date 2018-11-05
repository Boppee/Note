<?php
function gIv($size){
  $iv_size = $size;
  return bin2hex(openssl_random_pseudo_bytes($iv_size, $strong));
}

function eIv($name, $iv){
  $encryption_key = hex2bin('6454b07728258da5b3f4693be09eea2d3a19dc1f79cad2b4553d0669a39e20b9096f20ca344ae751ac9ca09cf650dde9a6897472d5a032bc255de72eb959a6604ccc88508da5e8edaac5ac7f50314330094bba43c1e08e58074bd80f9a0355067aa1be66340e09c297d2f62143c901b6260d2b7a19a7ce3432f9beca9b4cfb9a9e4f49ccc63251e4d019ff54028e87141cb94aebc1577fb9cd523aa2386af6d9c0fa8c33b4b9fe19d590e95e40ab5e550d03a27b1d97d3955b2ba0ce4328d5be18a1f7b71785cfb1dad0f3f9e393aa6ecd22f6e0aa09ec2f50fd539c5c54d29aae4cd85bcd0608cb35e79a85e508949470d84a121b994f02cd792c545fc2574d');
  $iv_size = 16;
  if(!$iv){
    $iv = generatIv($iv_size);
    $length = $iv_size - strlen($name) % $iv_size;
    $name = $name . str_repeat(chr($length), $length);
    return array('enc' => openssl_encrypt($name, 'AES-256-CBC', $encryption_key, 0, hex2bin($iv)), 'iv' => $iv);
  }else {
    $length = $iv_size - strlen($name) % $iv_size;
    $name = $name . str_repeat(chr($length), $length);
    return openssl_encrypt($name, 'AES-256-CBC', $encryption_key, 0, hex2bin($iv));
  }

}
function dIv($enc_name, $iv){
  $encryption_key = hex2bin('6454b07728258da5b3f4693be09eea2d3a19dc1f79cad2b4553d0669a39e20b9096f20ca344ae751ac9ca09cf650dde9a6897472d5a032bc255de72eb959a6604ccc88508da5e8edaac5ac7f50314330094bba43c1e08e58074bd80f9a0355067aa1be66340e09c297d2f62143c901b6260d2b7a19a7ce3432f9beca9b4cfb9a9e4f49ccc63251e4d019ff54028e87141cb94aebc1577fb9cd523aa2386af6d9c0fa8c33b4b9fe19d590e95e40ab5e550d03a27b1d97d3955b2ba0ce4328d5be18a1f7b71785cfb1dad0f3f9e393aa6ecd22f6e0aa09ec2f50fd539c5c54d29aae4cd85bcd0608cb35e79a85e508949470d84a121b994f02cd792c545fc2574d');

  $enc_name = openssl_decrypt($enc_name, 'AES-256-CBC', $encryption_key, 0, hex2bin($iv));

  return substr($enc_name, 0, -ord($enc_name[strlen($enc_name) - 1]));
}

function eId($name){

  $encryption_key = hex2bin('593652356d6434685743776e65526e4a477536724b366877676e51534d4343674c47595059463975616b4a6a6a35344b4d66774276745339684675644451676635764767664a456d6772523533575a47463375416154777959684e7a4a777a394b6a6d37786a72784e6547334d79556d6d47456668334e4b7759546379587963');

  $iv_size = 16;

  $length = $iv_size - strlen($name) % $iv_size;
  $name = $name . str_repeat(chr($length), $length);

  return @openssl_encrypt($name, 'AES-256-CBC', $encryption_key);
}
function dId($name){
    $encryption_key = hex2bin('593652356d6434685743776e65526e4a477536724b366877676e51534d4343674c47595059463975616b4a6a6a35344b4d66774276745339684675644451676635764767664a456d6772523533575a47463375416154777959684e7a4a777a394b6a6d37786a72784e6547334d79556d6d47456668334e4b7759546379587963');

    $name = openssl_decrypt($name, 'AES-256-CBC', $encryption_key);

    return substr($name, 0, -ord($name[strlen($name) - 1]));
}
function eP($name, $iv){
  $encryption_key = hex2bin('6454b07728258da5b3f4693be09eea2d3a19dc1f79cad2b4553d0669a39e20b9096f20ca344ae751ac9ca09cf650dde9a6897472d5a032bc255de72eb959a6604ccc88508da5e8edaac5ac7f50314330094bba43c1e08e58074bd80f9a0355067aa1be66340e09c297d2f62143c901b6260d2b7a19a7ce3432f9beca9b4cfb9a9e4f49ccc63251e4d019ff54028e87141cb94aebc1577fb9cd523aa2386af6d9c0fa8c33b4b9fe19d590e95e40ab5e550d03a27b1d97d3955b2ba0ce4328d5be18a1f7b71785cfb1dad0f3f9e393aa6ecd22f6e0aa09ec2f50fd539c5c54d29aae4cd85bcd0608cb35e79a85e508949470d84a121b994f02cd792c545fc2574d');
  $iv_size = 16;
  if(!$iv){
    $iv = generatIv($iv_size);
    $length = $iv_size - strlen($name) % $iv_size;
    $name = $name . str_repeat(chr($length), $length);
    return array('enc' => openssl_encrypt($name, 'AES-256-CBC', $encryption_key, 0, hex2bin($iv)), 'iv' => $iv);
  }else {
    $length = $iv_size - strlen($name) % $iv_size;
    $name = $name . str_repeat(chr($length), $length);
    return openssl_encrypt($name, 'AES-256-CBC', $encryption_key, 0, hex2bin($iv));
  }

}
function dP($enc_name, $iv){
  $encryption_key = hex2bin('6454b07728258da5b3f4693be09eea2d3a19dc1f79cad2b4553d0669a39e20b9096f20ca344ae751ac9ca09cf650dde9a6897472d5a032bc255de72eb959a6604ccc88508da5e8edaac5ac7f50314330094bba43c1e08e58074bd80f9a0355067aa1be66340e09c297d2f62143c901b6260d2b7a19a7ce3432f9beca9b4cfb9a9e4f49ccc63251e4d019ff54028e87141cb94aebc1577fb9cd523aa2386af6d9c0fa8c33b4b9fe19d590e95e40ab5e550d03a27b1d97d3955b2ba0ce4328d5be18a1f7b71785cfb1dad0f3f9e393aa6ecd22f6e0aa09ec2f50fd539c5c54d29aae4cd85bcd0608cb35e79a85e508949470d84a121b994f02cd792c545fc2574d');

  $enc_name = openssl_decrypt($enc_name, 'AES-256-CBC', $encryption_key, 0, hex2bin($iv));

  return substr($enc_name, 0, -ord($enc_name[strlen($enc_name) - 1]));
}
?>
