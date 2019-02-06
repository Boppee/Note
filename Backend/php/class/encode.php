<?php
  class encoder {

    private $publicKey = "70b49e76bb62a4e8c0d8fea9ffb290ae61cf83a2b2970737e79ff2f37706ddc4"; //For session encode
    private $privateKey = "170add26503b738053e5b76532b65ed190319e32c5eec8018ab80d8983bd7c0b"; //for databas encode
    private $revKey = "bc3535ae57725853f20ce76e25da9189f043ecf73c608c01acde61b17fc4b997";

    private $currentKey;
    private $keyName;

    function __construct($ppr){
      if (!$this->setKey($ppr)) {
        return false;
      }
    }

    public function setKey($ppr){
      $this->keyName = $ppr;
      if ($ppr == "public") {
        $this->currentKey = $this->publicKey;
        return true;
      }else if($ppr == "private") {
        $this->currentKey = $this->publicKey;
        return true;
      }else if($ppr == "rev"){
        $this->currentKey = $this->revKey;
        return true;
      }else {
        return false;
      }
    }

    public function encode($name, $iv){
      $encryption_key = hex2bin($this->currentKey);
      $iv_size = 16;
      $length = $iv_size - strlen($name) % $iv_size;
      $name = $name . str_repeat(chr($length), $length);
      return openssl_encrypt($name, 'AES-256-CBC', $encryption_key, 0, hex2bin($iv));
    }
    public function decode($enc_name, $iv){
      $encryption_key = hex2bin($this->currentKey);
      $enc_name = openssl_decrypt($enc_name, 'AES-256-CBC', $encryption_key, 0, hex2bin($iv));
      return substr($enc_name, 0, -ord($enc_name[strlen($enc_name) - 1]));
    }

    public function revEncode($name, $keyChange){

      $tempKeyname = $this->keyName;

      if (strlen($keyChange) > 0) {
        $this->setKey($keyChange);
        $encryption_key = hex2bin($this->currentKey);
        $this->setKey($tempKeyname);
      }else {
        $encryption_key = hex2bin($this->revKey);
      }

      $iv_size = 16;

      $length = $iv_size - strlen($name) % $iv_size;
      $name = $name . str_repeat(chr($length), $length);

      return @openssl_encrypt($name, 'AES-256-CBC', $encryption_key);
    }
    public function revDecode($name){
      $encryption_key = hex2bin($this->currentKey);

      $name = openssl_decrypt($name, 'AES-256-CBC', $encryption_key);

      return substr($name, 0, -ord($name[strlen($name) - 1]));
    }

    public function generatIv() {
      $iv_size = 16;
      return bin2hex(openssl_random_pseudo_bytes($iv_size, $strong));
    }
  }
?>
