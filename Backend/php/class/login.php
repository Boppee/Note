<?php
require 'encode.php';
require 'connect.php';
class login {

  private $password;
  private $username;
  private $email;
  private $iv;
  private $enc;
  private $connection;

  function __construct($pwd, $uid){
    $this->enc = new encoder("private");
    $this->connection = new connect();

    $this->setUsername($uid);
    $this->setPassword($pwd);

    $this->grabUserData();
  }

  public function setUsername($uid){
    $this->username = $this->enc->revEncode($uid);
  }
  public function setPassword($pwd){
    $this->password = $pwd;
  }
  public function grabUserData(){
    $this->connection->newConnectionPre("FetchFromAccounts");


  }
}
?>
