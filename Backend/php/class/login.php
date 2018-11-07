<?php
require_once 'encode.php';
require_once 'connect.php';
require_once 'email.php';
require_once 'vars.php';

class login {

  private $password;
  private $username;
  private $email;
  private $iv;
  private $emailCode;
  private $enc;
  private $connection;

  function __construct($pwd, $uid){

    session_start();

    $this->enc = new encoder("private");
    $this->connection = new connect();

    $this->setUsername($uid);
    $this->setPassword($pwd);

    $userData = $this->grabUserData();

    //validateing password
    if ($this->Username == $userData["uid"] && password_verify($this->password, $userData["pwd"])) {
      $this->setIV($userData["iv"]);
      $email = $this->enc-decode($userData["email"], $this->iv);
      $this->setEmail($email);

      $this->sendVerifyEmail();
      //seting session vars so i can use the when validating email
      $_SESSION["loginAttempt"] = array(
        'username' => $uid,
        'password' => $pwd,
        'time' => date(),
        'salt' => uniqid(mt_rand(), true)
      );

      echo "pass";

    }else {
      echo "fail";
    }
  }

  public function setUsername($uid){
    $this->username = $this->enc->revEncode($uid);
  }
  public function setPassword($pwd){
    $this->password = $pwd;
  }
  public function setEmail($email){
    $this->email = $email;
  }
  public function setIV($iv){
    $this->iv = $iv;
  }
  public function grabuserData(){

    $this->connection->newConnectionPre("FetchFromAccounts");

    $sth = $this->connection->prepare("SELECT * FROM `accounts` WHERE `uid` = :uid");
    $sth->bindParam(':uid', $this->uid);
    $sth->execute();
    return $sth->fetch(PDO::FETCH_LAZY);
  }
  public function sendVerifyEmail(){
    $company = new company();
    $mail->Subject = "Email verification from ".$company->companyName;
    $mail->AddAddress($this->email);

    $this->emailCode = uniqid(mt_rand(), true);

    $_SESSION["emailCode"] = $this->enc->encode($this->emailCode, $this->iv);

    $mail->Body = $this->emailCode;

    $mail->Send();
  }
}
?>
